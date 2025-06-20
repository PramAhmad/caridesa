<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use App\Models\GuideImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class GuideController extends Controller
{
    /**
     * Display a listing of the guides.
     */
    public function index(Request $request)
    {
        try {
            $query = Guide::with(['images']);
            
            // Search functionality
            if ($request->filled('search')) {
                $search = $request->get('search');
                $query->where(function($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('description', 'LIKE', "%{$search}%")
                      ->orWhere('address', 'LIKE', "%{$search}%")
                      ->orWhere('phone', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%");
                });
            }
            
            // Filter by status
            if ($request->filled('status')) {
                $status = $request->get('status');
                if ($status === 'active') {
                    $query->where('is_active', true);
                } elseif ($status === 'inactive') {
                    $query->where('is_active', false);
                }
            }
            
            // Filter by price range
            if ($request->filled('min_price')) {
                $query->where('price', '>=', $request->get('min_price'));
            }
            
            if ($request->filled('max_price')) {
                $query->where('price', '<=', $request->get('max_price'));
            }
            
            // Filter by discount
            if ($request->filled('has_discount')) {
                if ($request->get('has_discount') === '1') {
                    $query->where('discount_percent', '>', 0);
                } else {
                    $query->where(function($q) {
                        $q->where('discount_percent', 0)->orWhereNull('discount_percent');
                    });
                }
            }
            
            // Order by
            $orderBy = $request->get('order_by', 'created_at');
            $orderDirection = $request->get('order_direction', 'desc');
            
            $query->orderBy($orderBy, $orderDirection);
            
            $guides = $query->paginate(12);
            
            return view('tenant.guides.index', compact('guides'));
            
        } catch (Exception $e) {
            Log::error('Error fetching guides: ' . $e->getMessage());
            return back()->with('error', 'Gagal memuat daftar pemandu. Silakan coba lagi.');
        }
    }

    /**
     * Show the form for creating a new guide.
     */
    public function create()
    {
        try {
            return view('tenant.guides.create');
        } catch (Exception $e) {
            Log::error('Error loading create guide form: ' . $e->getMessage());
            return redirect('/admin/guides')->with('error', 'Gagal memuat halaman tambah pemandu.');
        }
    }

    /**
     * Store a newly created guide.
     */
    public function store(Request $request)
    {
        $request->merge(['is_active' => $request->has('is_active')]);
        DB::beginTransaction();
        
        try {
            // Validation
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:guides,name',
                'address' => 'required|string',
                'phone' => 'required|string|max:20',
                'email' => 'nullable|email|max:255|unique:guides,email',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0|max:999999999.99',
                'discount_percent' => 'nullable|numeric|min:0|max:100',
                'is_active' => 'boolean',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'name.required' => 'Nama pemandu wajib diisi.',
                'name.unique' => 'Nama pemandu sudah digunakan.',
                'name.max' => 'Nama pemandu maksimal 255 karakter.',
                'address.required' => 'Alamat wajib diisi.',
                'phone.required' => 'Nomor telepon wajib diisi.',
                'phone.max' => 'Nomor telepon maksimal 20 karakter.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
                'email.max' => 'Email maksimal 255 karakter.',
                'description.required' => 'Deskripsi wajib diisi.',
                'price.required' => 'Harga wajib diisi.',
                'price.numeric' => 'Harga harus berupa angka.',
                'price.min' => 'Harga tidak boleh negatif.',
                'price.max' => 'Harga terlalu besar.',
                'discount_percent.numeric' => 'Diskon harus berupa angka.',
                'discount_percent.min' => 'Diskon tidak boleh negatif.',
                'discount_percent.max' => 'Diskon maksimal 100%.',
                'images.*.image' => 'File harus berupa gambar.',
                'images.*.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
                'images.*.max' => 'Ukuran gambar maksimal 2MB.',
            ]);

            $validated['is_active'] = $request->has('is_active');
            $validated['slug'] = Str::slug($validated['name']);

            // Create guide
            $guide = Guide::create($validated);
            
            if (!$guide) {
                throw new Exception('Gagal menyimpan data pemandu ke database.');
            }

            // Handle image uploads
            if ($request->hasFile('images')) {
                $this->handleImageUpload($request->file('images'), $guide->id);
            }

            DB::commit();
            
            Log::info("Guide created successfully: ID {$guide->id}, Name: {$guide->name}");

            return redirect('/admin/guides')
                            ->with('success', 'Pemandu berhasil dibuat!');

        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning('Validation failed for guide creation: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
            
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error('Database error creating guide: ' . $e->getMessage());
            
            if (str_contains($e->getMessage(), 'Duplicate entry')) {
                if (str_contains($e->getMessage(), 'guides_name_unique')) {
                    return back()->with('error', 'Nama pemandu sudah digunakan. Silakan gunakan nama lain.')->withInput();
                } elseif (str_contains($e->getMessage(), 'guides_email_unique')) {
                    return back()->with('error', 'Email sudah digunakan. Silakan gunakan email lain.')->withInput();
                }
            }
            
            return back()->with('error', 'Gagal menyimpan pemandu ke database. Silakan coba lagi.')->withInput();
            
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating guide: ' . $e->getMessage(), [
                'stack_trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['images'])
            ]);
            
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified guide.
     */
    public function show(Guide $guide)
    {
        try {
            $guide->load(['images']);
            return view('tenant.guides.show', compact('guide'));
        } catch (Exception $e) {
            Log::error("Error loading guide details: ID {$guide->id}, Error: " . $e->getMessage());
            return redirect('/admin/guides')->with('error', 'Gagal memuat detail pemandu.');
        }
    }

    /**
     * Show the form for editing the specified guide.
     */
    public function edit(Guide $guide)
    {
        try {
            $guide->load(['images']);
            return view('tenant.guides.edit', compact('guide'));
        } catch (Exception $e) {
            Log::error("Error loading edit guide form: ID {$guide->id}, Error: " . $e->getMessage());
            return redirect('/admin/guides')->with('error', 'Gagal memuat halaman edit pemandu.');
        }
    }

    /**
     * Update the specified guide.
     */
    public function update(Request $request, Guide $guide)
    {
        $request->merge(['is_active' => $request->has('is_active')]);
        DB::beginTransaction();
        
        try {
            // Validation
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:guides,name,' . $guide->id,
                'address' => 'required|string',
                'phone' => 'required|string|max:20',
                'email' => 'nullable|email|max:255|unique:guides,email,' . $guide->id,
                'description' => 'required|string',
                'price' => 'required|numeric|min:0|max:999999999.99',
                'discount_percent' => 'nullable|numeric|min:0|max:100',
                'is_active' => 'boolean',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'name.required' => 'Nama pemandu wajib diisi.',
                'name.unique' => 'Nama pemandu sudah digunakan.',
                'name.max' => 'Nama pemandu maksimal 255 karakter.',
                'address.required' => 'Alamat wajib diisi.',
                'phone.required' => 'Nomor telepon wajib diisi.',
                'phone.max' => 'Nomor telepon maksimal 20 karakter.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
                'email.max' => 'Email maksimal 255 karakter.',
                'description.required' => 'Deskripsi wajib diisi.',
                'price.required' => 'Harga wajib diisi.',
                'price.numeric' => 'Harga harus berupa angka.',
                'price.min' => 'Harga tidak boleh negatif.',
                'price.max' => 'Harga terlalu besar.',
                'discount_percent.numeric' => 'Diskon harus berupa angka.',
                'discount_percent.min' => 'Diskon tidak boleh negatif.',
                'discount_percent.max' => 'Diskon maksimal 100%.',
                'images.*.image' => 'File harus berupa gambar.',
                'images.*.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
                'images.*.max' => 'Ukuran gambar maksimal 2MB.',
            ]);

            $validated['is_active'] = $request->has('is_active');

            // Only update slug if name changed
            if ($guide->name !== $validated['name']) {
                $validated['slug'] = Str::slug($validated['name']);
            }

            // Update guide
            $updated = $guide->update($validated);
            
            if (!$updated) {
                throw new Exception('Gagal memperbarui data pemandu.');
            }

            // Handle new image uploads
            if ($request->hasFile('images')) {
                $this->handleImageUpload($request->file('images'), $guide->id);
            }

            DB::commit();
            
            Log::info("Guide updated successfully: ID {$guide->id}, Name: {$guide->name}");

            return redirect('/admin/guides')
                            ->with('success', 'Pemandu berhasil diperbarui!');

        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning("Validation failed for guide update: ID {$guide->id}, Errors: " . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
            
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error("Database error updating guide: ID {$guide->id}, Error: " . $e->getMessage());
            
            if (str_contains($e->getMessage(), 'Duplicate entry')) {
                if (str_contains($e->getMessage(), 'guides_name_unique')) {
                    return back()->with('error', 'Nama pemandu sudah digunakan. Silakan gunakan nama lain.')->withInput();
                } elseif (str_contains($e->getMessage(), 'guides_email_unique')) {
                    return back()->with('error', 'Email sudah digunakan. Silakan gunakan email lain.')->withInput();
                }
            }
            
            return back()->with('error', 'Gagal memperbarui pemandu ke database. Silakan coba lagi.')->withInput();
            
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error updating guide: ID {$guide->id}, Error: " . $e->getMessage(), [
                'stack_trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['images'])
            ]);
            
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified guide.
     */
    public function destroy(Guide $guide)
    {
        DB::beginTransaction();
        
        try {
            $guideName = $guide->name;
            $guideId = $guide->id;
            
            // Delete associated images from filesystem and database
            foreach ($guide->images as $image) {
                $this->deleteImageFile($image);
                $image->delete();
            }

            // Delete guide
            $deleted = $guide->delete();
            
            if (!$deleted) {
                throw new Exception('Gagal menghapus pemandu dari database.');
            }

            DB::commit();
            
            Log::info("Guide deleted successfully: ID {$guideId}, Name: {$guideName}");

            return back()->with('success', 'Pemandu berhasil dihapus!');

        } catch (QueryException $e) {
            DB::rollBack();
            Log::error("Database error deleting guide: ID {$guide->id}, Error: " . $e->getMessage());
            
            if (str_contains($e->getMessage(), 'foreign key constraint')) {
                return back()->with('error', 'Tidak dapat menghapus pemandu karena masih terkait dengan data lain.');
            }
            
            return back()->with('error', 'Gagal menghapus pemandu dari database. Silakan coba lagi.');
            
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error deleting guide: ID {$guide->id}, Error: " . $e->getMessage(), [
                'stack_trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Terjadi kesalahan saat menghapus pemandu: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified image from guide.
     */
    public function deleteImage(GuideImage $image)
    {
        DB::beginTransaction();
        
        try {
            $imageName = $image->name;
            $guideId = $image->guide_id;
            
            // Delete image file from filesystem
            $this->deleteImageFile($image);
            
            // Delete image record from database
            $deleted = $image->delete();
            
            if (!$deleted) {
                throw new Exception('Gagal menghapus record gambar dari database.');
            }

            DB::commit();
            
            Log::info("Guide image deleted successfully: Image {$imageName}, Guide ID {$guideId}");

            return back()->with('success', 'Gambar berhasil dihapus!');

        } catch (QueryException $e) {
            DB::rollBack();
            Log::error("Database error deleting guide image: ID {$image->id}, Error: " . $e->getMessage());
            return back()->with('error', 'Gagal menghapus gambar dari database. Silakan coba lagi.');
            
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error deleting guide image: ID {$image->id}, Error: " . $e->getMessage(), [
                'stack_trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Terjadi kesalahan saat menghapus gambar: ' . $e->getMessage());
        }
    }

    /**
     * Get active guides
     */
    public function getActiveGuides()
    {
        try {
            $activeGuides = Guide::where('is_active', true)
                                 ->with(['images'])
                                 ->orderBy('name', 'asc')
                                 ->get();
                                 
            return response()->json([
                'success' => true,
                'data' => $activeGuides
            ]);
            
        } catch (Exception $e) {
            Log::error('Error fetching active guides: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat daftar pemandu aktif.'
            ], 500);
        }
    }

    /**
     * Get guides by price range
     */
    public function getGuidesByPriceRange(Request $request)
    {
        try {
            $minPrice = $request->get('min_price', 0);
            $maxPrice = $request->get('max_price', 999999999);
            
            $guides = Guide::where('is_active', true)
                          ->whereBetween('price', [$minPrice, $maxPrice])
                          ->with(['images'])
                          ->orderBy('price', 'asc')
                          ->get();
                          
            return response()->json([
                'success' => true,
                'data' => $guides
            ]);
            
        } catch (Exception $e) {
            Log::error('Error fetching guides by price range: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat pemandu berdasarkan rentang harga.'
            ], 500);
        }
    }

    /**
     * Toggle guide status (active/inactive)
     */
    public function toggleStatus(Guide $guide)
    {
        DB::beginTransaction();
        
        try {
            $guide->is_active = !$guide->is_active;
            $updated = $guide->save();
            
            if (!$updated) {
                throw new Exception('Gagal mengubah status pemandu.');
            }
            
            DB::commit();
            
            $status = $guide->is_active ? 'diaktifkan' : 'dinonaktifkan';
            Log::info("Guide status toggled: ID {$guide->id}, Status: {$status}");
            
            return back()->with('success', "Pemandu berhasil {$status}!");
            
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error toggling guide status: ID {$guide->id}, Error: " . $e->getMessage());
            
            return back()->with('error', 'Gagal mengubah status pemandu: ' . $e->getMessage());
        }
    }

    /**
     * Handle image upload process
     */
    private function handleImageUpload($images, $guideId)
    {
        try {
            $uploadPath = public_path("tenancy/assets/image/guides");
            
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
                $imageRecord = GuideImage::create([
                    'name' => '/image/guides/' . $filename,
                    'guide_id' => $guideId,
                ]);
                
                if (!$imageRecord) {
                    // Delete uploaded file if database insert failed
                    File::delete($fullPath);
                    throw new Exception("Gagal menyimpan record gambar ke database: {$filename}");
                }
                
                Log::info("Guide image uploaded successfully: {$filename} for guide ID {$guideId}");
            }
            
        } catch (Exception $e) {
            Log::error("Error uploading guide images: " . $e->getMessage(), [
                'guide_id' => $guideId,
                'upload_path' => $uploadPath ?? 'undefined'
            ]);
            throw $e;
        }
    }

    /**
     * Delete image file from filesystem
     */
    private function deleteImageFile(GuideImage $image)
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
        }
    }
}