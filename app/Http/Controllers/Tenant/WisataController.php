<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use App\Models\CategoryWisata;
use App\Models\WisataImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class WisataController extends Controller
{
    /**
     * Display a listing of the wisatas.
     */
    public function index()
    {
        try {
            $wisatas = Wisata::with(['category', 'images'])->latest()->get();
            return view('tenant.wisatas.index', compact('wisatas'));
        } catch (Exception $e) {
            Log::error('Error fetching wisatas: ' . $e->getMessage());
            return back()->with('error', 'Gagal memuat daftar wisata. Silakan coba lagi.');
        }
    }

    /**
     * Show the form for creating a new wisata.
     */
    public function create()
    {
        try {
            $categories = CategoryWisata::where('is_active', true)->orderBy('name')->get();
            return view('tenant.wisatas.create', compact('categories'));
        } catch (Exception $e) {
            Log::error('Error loading create wisata form: ' . $e->getMessage());
            return redirect('/admin/wisatas')->with('error', 'Gagal memuat halaman tambah wisata.');
        }
    }

    /**
     * Store a newly created wisata.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        
        try {
            // Validation
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:wisatas,name',
                'description' => 'required|string',
                'latitude' => 'required|numeric|between:-90,90',
                'longitude' => 'required|numeric|between:-180,180',
                'category_wisata_id' => 'required|exists:category_wisatas,id',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'name.required' => 'Nama wisata wajib diisi.',
                'name.unique' => 'Nama wisata sudah digunakan.',
                'name.max' => 'Nama wisata maksimal 255 karakter.',
                'description.required' => 'Deskripsi wisata wajib diisi.',
                'latitude.required' => 'Latitude wajib diisi.',
                'latitude.numeric' => 'Latitude harus berupa angka.',
                'latitude.between' => 'Latitude harus antara -90 sampai 90.',
                'longitude.required' => 'Longitude wajib diisi.',
                'longitude.numeric' => 'Longitude harus berupa angka.',
                'longitude.between' => 'Longitude harus antara -180 sampai 180.',
                'category_wisata_id.required' => 'Kategori wisata wajib dipilih.',
                'category_wisata_id.exists' => 'Kategori wisata tidak valid.',
                'images.*.image' => 'File harus berupa gambar.',
                'images.*.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
                'images.*.max' => 'Ukuran gambar maksimal 2MB.',
            ]);

            $validated['slug'] = Str::slug($validated['name']);

            // Create wisata
            $wisata = Wisata::create($validated);
            
            if (!$wisata) {
                throw new Exception('Gagal menyimpan data wisata ke database.');
            }

            // Handle image uploads
            if ($request->hasFile('images')) {
                $this->handleImageUpload($request->file('images'), $wisata->id);
            }

            DB::commit();
            
            Log::info("Wisata created successfully: ID {$wisata->id}, Name: {$wisata->name}");

            return redirect('/admin/wisatas')
                            ->with('success', 'Wisata berhasil dibuat!');

        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning('Validation failed for wisata creation: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
            
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error('Database error creating wisata: ' . $e->getMessage());
            
            // Check for specific database errors
            if (str_contains($e->getMessage(), 'Duplicate entry')) {
                return back()->with('error', 'Nama wisata sudah digunakan. Silakan gunakan nama lain.')->withInput();
            }
            
            return back()->with('error', 'Gagal menyimpan wisata ke database. Silakan coba lagi.')->withInput();
            
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating wisata: ' . $e->getMessage(), [
                'stack_trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['images'])
            ]);
            
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified wisata.
     */
    public function show(Wisata $wisata)
    {
        try {
            $wisata->load(['category', 'images']);
            return view('tenant.wisatas.show', compact('wisata'));
        } catch (Exception $e) {
            Log::error("Error loading wisata details: ID {$wisata->id}, Error: " . $e->getMessage());
            return redirect('/admin/wisatas')->with('error', 'Gagal memuat detail wisata.');
        }
    }

    /**
     * Show the form for editing the specified wisata.
     */
    public function edit(Wisata $wisata)
    {
        try {
            $categories = CategoryWisata::where('is_active', true)->orderBy('name')->get();
            $wisata->load(['category', 'images']);
            return view('tenant.wisatas.edit', compact('wisata', 'categories'));
        } catch (Exception $e) {
            Log::error("Error loading edit wisata form: ID {$wisata->id}, Error: " . $e->getMessage());
            return redirect('/admin/wisatas')->with('error', 'Gagal memuat halaman edit wisata.');
        }
    }

    /**
     * Update the specified wisata.
     */
    public function update(Request $request, Wisata $wisata)
    {
        DB::beginTransaction();
        
        try {
            // Validation
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:wisatas,name,' . $wisata->id,
                'description' => 'required|string',
                'latitude' => 'required|numeric|between:-90,90',
                'longitude' => 'required|numeric|between:-180,180',
                'category_wisata_id' => 'required|exists:category_wisatas,id',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'name.required' => 'Nama wisata wajib diisi.',
                'name.unique' => 'Nama wisata sudah digunakan.',
                'name.max' => 'Nama wisata maksimal 255 karakter.',
                'description.required' => 'Deskripsi wisata wajib diisi.',
                'latitude.required' => 'Latitude wajib diisi.',
                'latitude.numeric' => 'Latitude harus berupa angka.',
                'latitude.between' => 'Latitude harus antara -90 sampai 90.',
                'longitude.required' => 'Longitude wajib diisi.',
                'longitude.numeric' => 'Longitude harus berupa angka.',
                'longitude.between' => 'Longitude harus antara -180 sampai 180.',
                'category_wisata_id.required' => 'Kategori wisata wajib dipilih.',
                'category_wisata_id.exists' => 'Kategori wisata tidak valid.',
                'images.*.image' => 'File harus berupa gambar.',
                'images.*.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
                'images.*.max' => 'Ukuran gambar maksimal 2MB.',
            ]);

            // Only update slug if name changed
            if ($wisata->name !== $validated['name']) {
                $validated['slug'] = Str::slug($validated['name']);
            }

            // Update wisata
            $updated = $wisata->update($validated);
            
            if (!$updated) {
                throw new Exception('Gagal memperbarui data wisata.');
            }

            // Handle new image uploads
            if ($request->hasFile('images')) {
                $this->handleImageUpload($request->file('images'), $wisata->id);
            }

            DB::commit();
            
            Log::info("Wisata updated successfully: ID {$wisata->id}, Name: {$wisata->name}");

            return redirect('/admin/wisatas')
                            ->with('success', 'Wisata berhasil diperbarui!');

        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning("Validation failed for wisata update: ID {$wisata->id}, Errors: " . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
            
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error("Database error updating wisata: ID {$wisata->id}, Error: " . $e->getMessage());
            
            if (str_contains($e->getMessage(), 'Duplicate entry')) {
                return back()->with('error', 'Nama wisata sudah digunakan. Silakan gunakan nama lain.')->withInput();
            }
            
            return back()->with('error', 'Gagal memperbarui wisata ke database. Silakan coba lagi.')->withInput();
            
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error updating wisata: ID {$wisata->id}, Error: " . $e->getMessage(), [
                'stack_trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['images'])
            ]);
            
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified wisata.
     */
    public function destroy(Wisata $wisata)
    {
        DB::beginTransaction();
        
        try {
            $wisataName = $wisata->name;
            $wisataId = $wisata->id;
            
            // Delete associated images from filesystem and database
            foreach ($wisata->images as $image) {
                $this->deleteImageFile($image);
                $image->delete();
            }

            // Delete wisata
            $deleted = $wisata->delete();
            
            if (!$deleted) {
                throw new Exception('Gagal menghapus wisata dari database.');
            }

            DB::commit();
            
            Log::info("Wisata deleted successfully: ID {$wisataId}, Name: {$wisataName}");

            return back()->with('success', 'Wisata berhasil dihapus!');

        } catch (QueryException $e) {
            DB::rollBack();
            Log::error("Database error deleting wisata: ID {$wisata->id}, Error: " . $e->getMessage());
            
            // Check for foreign key constraints
            if (str_contains($e->getMessage(), 'foreign key constraint')) {
                return back()->with('error', 'Tidak dapat menghapus wisata karena masih terkait dengan data lain.');
            }
            
            return back()->with('error', 'Gagal menghapus wisata dari database. Silakan coba lagi.');
            
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error deleting wisata: ID {$wisata->id}, Error: " . $e->getMessage(), [
                'stack_trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Terjadi kesalahan saat menghapus wisata: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified image from wisata.
     */
    public function deleteImage(Wisata $wisata, WisataImage $image)
    {
        DB::beginTransaction();
        
        try {
            // Verify that the image belongs to the wisata
            if ($image->wisata_id !== $wisata->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gambar tidak ditemukan untuk wisata ini.'
                ], 404);
            }
            
            $imageName = $image->name;
            $imageId = $image->id;
            
            // Delete image file from filesystem
            $this->deleteImageFile($image);
            
            // Delete image record from database
            $deleted = $image->delete();
            
            if (!$deleted) {
                throw new Exception('Gagal menghapus record gambar dari database.');
            }

            DB::commit();
            
            Log::info("Wisata image deleted successfully: Image ID {$imageId}, Name {$imageName}, Wisata ID {$wisata->id}");

            // Check if it's an AJAX request
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Gambar berhasil dihapus!'
                ]);
            }

            return back()->with('success', 'Gambar berhasil dihapus!');

        } catch (QueryException $e) {
            DB::rollBack();
            Log::error("Database error deleting wisata image: ID {$image->id}, Error: " . $e->getMessage());
            
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus gambar dari database. Silakan coba lagi.'
                ], 500);
            }
            
            return back()->with('error', 'Gagal menghapus gambar dari database. Silakan coba lagi.');
            
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error deleting wisata image: ID {$image->id}, Error: " . $e->getMessage(), [
                'stack_trace' => $e->getTraceAsString()
            ]);
            
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menghapus gambar: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Terjadi kesalahan saat menghapus gambar: ' . $e->getMessage());
        }
    }

    /**
     * Handle image upload process
     */
    private function handleImageUpload($images, $wisataId)
    {
        try {
            $uploadPath = public_path("tenancy/assets/image/wisatas");
            
            // Create directory if not exists
            if (!File::exists($uploadPath)) {
                $created = File::makeDirectory($uploadPath, 0755, true);
                if (!$created) {
                    throw new Exception('Gagal membuat direktori upload: ' . $uploadPath);
                }
            }
            
            // Check if directory is writable
            if (!is_writable($uploadPath)) {
                throw new Exception('Direktori upload tidak dapat ditulis: ' . $uploadPath);
            }
            
            foreach ($images as $image) {
                // Generate unique filename
                $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $fullPath = $uploadPath . '/' . $filename;
                
                // Move uploaded file
                $moved = $image->move($uploadPath, $filename);
                
                if (!$moved) {
                    throw new Exception("Gagal memindahkan file gambar: {$image->getClientOriginalName()}");
                }
                
                // Verify file was actually created
                if (!File::exists($fullPath)) {
                    throw new Exception("File gambar tidak ditemukan setelah upload: {$filename}");
                }
                
                // Create database record
                $imageRecord = WisataImage::create([
                    'name' => '/image/wisatas/' . $filename,
                    'wisata_id' => $wisataId,
                ]);
                
                if (!$imageRecord) {
                    // Delete uploaded file if database insert failed
                    File::delete($fullPath);
                    throw new Exception("Gagal menyimpan record gambar ke database: {$filename}");
                }
                
                Log::info("Image uploaded successfully: {$filename} for wisata ID {$wisataId}");
            }
            
        } catch (Exception $e) {
            Log::error("Error uploading wisata images: " . $e->getMessage(), [
                'wisata_id' => $wisataId,
                'upload_path' => $uploadPath ?? 'undefined'
            ]);
            throw $e; // Re-throw to be handled by calling method
        }
    }

    /**
     * Delete image file from filesystem
     */
    private function deleteImageFile($image)
    {
        try {
            $imagePath = public_path("tenancy/assets" . $image->name);
            
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
            // Don't throw here as file deletion failure shouldn't stop database operations
        }
    }
}