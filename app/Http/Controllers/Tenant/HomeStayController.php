<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\HomeStay;
use App\Models\HomeStayImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Database\QueryException; 
use Illuminate\Validation\ValidationException; 

class HomeStayController extends Controller
{
    /**
     * Display a listing of the homestays.
     */
    public function index()
    {
        try {
            $homestays = HomeStay::with('images')->latest()->get();
            return view('tenant.homestays.index', compact('homestays'));
        } catch (Exception $e) {
            Log::error('Error fetching homestays: ' . $e->getMessage());
            return back()->with('error', 'Gagal memuat daftar homestay. Silakan coba lagi.');
        }
    }

    /**
     * Show the form for creating a new homestay.
     */
    public function create()
    {
        try {
            return view('tenant.homestays.create');
        } catch (Exception $e) {
            Log::error('Error loading create homestay form: ' . $e->getMessage());
            return redirect('/admin/homestays')->with('error', 'Gagal memuat halaman tambah homestay.');
        }
    }

    /**
     * Store a newly created homestay.
     */
    public function store(Request $request)
    {
        $request->merge([
            'is_active' => $request->has('is_active') == 'on' ? true : false,
        ]);
        DB::beginTransaction();
        
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:home_stays,name',
                'address' => 'required|string|max:500',
                'phone' => 'required|string|max:20',
                'email' => 'nullable|email|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'discount_percent' => 'nullable|numeric|min:0|max:100',
                'is_active' => 'boolean',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'name.required' => 'Nama homestay wajib diisi.',
                'name.unique' => 'Nama homestay sudah digunakan.',
                'name.max' => 'Nama homestay maksimal 255 karakter.',
                'address.required' => 'Alamat homestay wajib diisi.',
                'address.max' => 'Alamat maksimal 500 karakter.',
                'phone.required' => 'Nomor telepon wajib diisi.',
                'phone.max' => 'Nomor telepon maksimal 20 karakter.',
                'email.email' => 'Format email tidak valid.',
                'email.max' => 'Email maksimal 255 karakter.',
                'description.required' => 'Deskripsi homestay wajib diisi.',
                'price.required' => 'Harga homestay wajib diisi.',
                'price.numeric' => 'Harga harus berupa angka.',
                'price.min' => 'Harga tidak boleh kurang dari 0.',
                'discount_percent.numeric' => 'Diskon harus berupa angka.',
                'discount_percent.min' => 'Diskon tidak boleh kurang dari 0%.',
                'discount_percent.max' => 'Diskon tidak boleh lebih dari 100%.',
                'images.*.image' => 'File harus berupa gambar.',
                'images.*.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
                'images.*.max' => 'Ukuran gambar maksimal 2MB.',
            ]);

            $validated['is_active'] = $request->has('is_active') ? true : false;
            $validated['discount_percent'] = $validated['discount_percent'] ?? 0;
            $homestay = HomeStay::create($validated);
            
            if (!$homestay) {
                throw new Exception('Gagal menyimpan data homestay ke database.');
            }

            // Handle image uploads
            if ($request->hasFile('images')) {
                $this->handleImageUpload($request->file('images'), $homestay->id);
            }

            DB::commit();
            
            Log::info("Homestay created successfully: ID {$homestay->id}, Name: {$homestay->name}");
            
            return redirect('/admin/homestays')
                            ->with('success', 'Homestay berhasil dibuat!');

        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning('Validation failed for homestay creation: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
            
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error('Database error creating homestay: ' . $e->getMessage());
            
            // Check for specific database errors
            if (str_contains($e->getMessage(), 'Duplicate entry')) {
                return back()->with('error', 'Nama homestay sudah digunakan. Silakan gunakan nama lain.')->withInput();
            }
            
            return back()->with('error', 'Gagal menyimpan homestay ke database. Silakan coba lagi.')->withInput();
            
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating homestay: ' . $e->getMessage(), [
                'stack_trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['images'])
            ]);
            
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified homestay.
     */
    public function show(HomeStay $homestay)
    {
        try {
            $homestay->load('images');
            return view('tenant.homestays.show', compact('homestay'));
        } catch (Exception $e) {
            Log::error("Error loading homestay details: ID {$homestay->id}, Error: " . $e->getMessage());
            return redirect('/admin/homestays')->with('error', 'Gagal memuat detail homestay.');
        }
    }

    /**
     * Show the form for editing the specified homestay.
     */
    public function edit(HomeStay $homestay)
    {
        try {
            $homestay->load('images');
            return view('tenant.homestays.edit', compact('homestay'));
        } catch (Exception $e) {
            Log::error("Error loading edit homestay form: ID {$homestay->id}, Error: " . $e->getMessage());
            return redirect('/admin/homestays')->with('error', 'Gagal memuat halaman edit homestay.');
        }
    }

    /**
     * Update the specified homestay.
     */
    public function update(Request $request, HomeStay $homestay)
    {
        DB::beginTransaction();
        
        try {
            // Validation
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:home_stays,name,' . $homestay->id,
                'address' => 'required|string|max:500',
                'phone' => 'required|string|max:20',
                'email' => 'nullable|email|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'discount_percent' => 'nullable|numeric|min:0|max:100',
                'is_active' => 'boolean',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'name.required' => 'Nama homestay wajib diisi.',
                'name.unique' => 'Nama homestay sudah digunakan.',
                'name.max' => 'Nama homestay maksimal 255 karakter.',
                'address.required' => 'Alamat homestay wajib diisi.',
                'address.max' => 'Alamat maksimal 500 karakter.',
                'phone.required' => 'Nomor telepon wajib diisi.',
                'phone.max' => 'Nomor telepon maksimal 20 karakter.',
                'email.email' => 'Format email tidak valid.',
                'email.max' => 'Email maksimal 255 karakter.',
                'description.required' => 'Deskripsi homestay wajib diisi.',
                'price.required' => 'Harga homestay wajib diisi.',
                'price.numeric' => 'Harga harus berupa angka.',
                'price.min' => 'Harga tidak boleh kurang dari 0.',
                'discount_percent.numeric' => 'Diskon harus berupa angka.',
                'discount_percent.min' => 'Diskon tidak boleh kurang dari 0%.',
                'discount_percent.max' => 'Diskon tidak boleh lebih dari 100%.',
                'images.*.image' => 'File harus berupa gambar.',
                'images.*.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
                'images.*.max' => 'Ukuran gambar maksimal 2MB.',
            ]);

            $validated['is_active'] = $request->has('is_active') ? true : false;
            $validated['discount_percent'] = $validated['discount_percent'] ?? 0;
            $updated = $homestay->update($validated);
            if (!$updated) {
                throw new Exception('Gagal memperbarui data homestay.');
            }

            // Handle new image uploads
            if ($request->hasFile('images')) {
                $this->handleImageUpload($request->file('images'), $homestay->id);
            }

            DB::commit();
            
            Log::info("Homestay updated successfully: ID {$homestay->id}, Name: {$homestay->name}");
            
            return redirect('/admin/homestays')
                            ->with('success', 'Homestay berhasil diperbarui!');

        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning("Validation failed for homestay update: ID {$homestay->id}, Errors: " . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
            
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error("Database error updating homestay: ID {$homestay->id}, Error: " . $e->getMessage());
            
            if (str_contains($e->getMessage(), 'Duplicate entry')) {
                return back()->with('error', 'Nama homestay sudah digunakan. Silakan gunakan nama lain.')->withInput();
            }
            
            return back()->with('error', 'Gagal memperbarui homestay ke database. Silakan coba lagi.')->withInput();
            
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error updating homestay: ID {$homestay->id}, Error: " . $e->getMessage(), [
                'stack_trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['images'])
            ]);
            
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified homestay.
     */
    public function destroy(HomeStay $homestay)
    {
        DB::beginTransaction();
        
        try {
            $homestayName = $homestay->name;
            $homestayId = $homestay->id;
            
            // Delete associated images from filesystem and database
            foreach ($homestay->images as $image) {
                $this->deleteImageFile($image);
                $image->delete();
            }

            // Delete homestay
            $deleted = $homestay->delete();
            
            if (!$deleted) {
                throw new Exception('Gagal menghapus homestay dari database.');
            }

            DB::commit();
            
            Log::info("Homestay deleted successfully: ID {$homestayId}, Name: {$homestayName}");
            
            return back()->with('success', 'Homestay berhasil dihapus!');

        } catch (QueryException $e) {
            DB::rollBack();
            Log::error("Database error deleting homestay: ID {$homestay->id}, Error: " . $e->getMessage());
            if (str_contains($e->getMessage(), 'foreign key constraint')) {
                return back()->with('error', 'Tidak dapat menghapus homestay karena masih terkait dengan data lain.');
            }
            
            return back()->with('error', 'Gagal menghapus homestay dari database. Silakan coba lagi.');
            
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error deleting homestay: ID {$homestay->id}, Error: " . $e->getMessage(), [
                'stack_trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Terjadi kesalahan saat menghapus homestay: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified image from homestay.
     */
    public function deleteImage(HomeStayImage $image)
    {
        DB::beginTransaction();
        
        try {
            $imageName = $image->name;
            $homestayId = $image->home_stay_id;
            $this->deleteImageFile($image);
            $deleted = $image->delete();
            
            if (!$deleted) {
                throw new Exception('Gagal menghapus record gambar dari database.');
            }

            DB::commit();
            
            Log::info("Homestay image deleted successfully: Image {$imageName}, Homestay ID {$homestayId}");
            
            return back()->with('success', 'Gambar berhasil dihapus!');

        } catch (QueryException $e) {
            DB::rollBack();
            Log::error("Database error deleting homestay image: ID {$image->id}, Error: " . $e->getMessage());
            return back()->with('error', 'Gagal menghapus gambar dari database. Silakan coba lagi.');
            
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error deleting homestay image: ID {$image->id}, Error: " . $e->getMessage(), [
                'stack_trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Terjadi kesalahan saat menghapus gambar: ' . $e->getMessage());
        }
    }

    /**
     * Toggle active status of homestay.
     */
    public function toggleActive(HomeStay $homestay)
    {
        try {
            $oldStatus = $homestay->is_active;
            $homestay->is_active = !$homestay->is_active;
            $saved = $homestay->save();
            
            if (!$saved) {
                throw new Exception('Gagal menyimpan perubahan status.');
            }

            $status = $homestay->is_active ? 'diaktifkan' : 'dinonaktifkan';
            
            Log::info("Homestay status toggled: ID {$homestay->id}, From {$oldStatus} to {$homestay->is_active}");
            
            return back()->with('success', "Homestay berhasil {$status}!");

        } catch (QueryException $e) {
            Log::error("Database error toggling homestay status: ID {$homestay->id}, Error: " . $e->getMessage());
            return back()->with('error', 'Gagal mengubah status homestay di database. Silakan coba lagi.');
            
        } catch (Exception $e) {
            Log::error("Error toggling homestay status: ID {$homestay->id}, Error: " . $e->getMessage(), [
                'stack_trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Terjadi kesalahan saat mengubah status: ' . $e->getMessage());
        }
    }

    /**
     * Handle image upload process
     */
    private function handleImageUpload($images, $homestayId)
    {
        try {
            $uploadPath = public_path("image/homestays");
            
            // Create directory if not exists
            if (!File::exists($uploadPath)) {
                $created = File::makeDirectory($uploadPath, 0755, true);
                if (!$created) {
                    throw new Exception('Gagal membuat direktori upload: ' . $uploadPath);
                }
            }
            
            if (!is_writable($uploadPath)) {
                throw new Exception('Direktori upload tidak dapat ditulis: ' . $uploadPath);
            }
            
            foreach ($images as $image) {
                $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $fullPath = $uploadPath . '/' . $filename;
                $moved = $image->move($uploadPath, $filename);
                
                if (!$moved) {
                    throw new Exception("Gagal memindahkan file gambar: {$image->getClientOriginalName()}");
                }
                if (!File::exists($fullPath)) {
                    throw new Exception("File gambar tidak ditemukan setelah upload: {$filename}");
                }
                $imageRecord = HomeStayImage::create([
                    'name' => '/image/homestays/' . $filename,
                    'home_stay_id' => $homestayId,
                ]);
                
                if (!$imageRecord) {
                    File::delete($fullPath);
                    throw new Exception("Gagal menyimpan record gambar ke database: {$filename}");
                }
                
                Log::info("Image uploaded successfully: {$filename} for homestay ID {$homestayId}");
            }
            
        } catch (Exception $e) {
            Log::error("Error uploading homestay images: " . $e->getMessage(), [
                'homestay_id' => $homestayId,
                'upload_path' => $uploadPath ?? 'undefined'
            ]);
            throw $e;
        }
    }

    /**
     * Delete image file from filesystem
     */
    private function deleteImageFile(HomeStayImage $image)
    {
        try {
            $imagePath = public_path( $image->name);
            
            if (File::exists($imagePath)) {
                $deleted = File::delete($imagePath);
                if (!$deleted) {
                    Log::warning("Failed to delete image file: {$imagePath}");
                } else {
                    Log::info("Image file deleted successfully: {$imagePath}");
                }
            } else {
                Log::warning("Image file not found for deletion: {$imagePath}");
            }
            
        } catch (Exception $e) {
            Log::error("Error deleting image file: " . $e->getMessage(), [
                'image_id' => $image->id,
                'image_path' => $imagePath ?? 'undefined'
            ]);
        }
    }
}