<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use App\Models\ThemeContent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::with('contents')->get();
        $activeTheme = Theme::where('is_active', true)->first();
        
        return view('tenant.admin.themes.index', compact('themes', 'activeTheme'));
    }

    public function create()
    {
        return view('tenant.admin.themes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'preview_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'config' => 'nullable|array',
        ]);

        try {
            $data = $request->only(['name', 'description', 'config']);
            $data['slug'] = Str::slug($request->name);

            // Handle preview image upload dengan error handling
            if ($request->hasFile('preview_image')) {
                $data['preview_image'] = $this->handleImageUpload($request->file('preview_image'));
            }

            $theme = Theme::create($data);
            $this->createDefaultContent($theme);

            return redirect('/admin/themes')
                            ->with('success', 'Theme berhasil dibuat!');
        } catch (\Exception $e) {
            Log::error('Theme creation error: ' . $e->getMessage());
            return back()->with('error', 'Gagal membuat theme: ' . $e->getMessage());
        }
    }

    public function edit(Theme $theme)
    {
        return view('tenant.admin.themes.edit', compact('theme'));
    }

    public function update(Request $request, Theme $theme)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'preview_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'config' => 'nullable|array',
        ]);

        try {
            $data = $request->only(['name', 'description', 'config']);
            $data['slug'] = Str::slug($request->name);

            // Handle preview image update
            if ($request->hasFile('preview_image')) {
                // Delete old image first
                if ($theme->preview_image) {
                    $this->deleteImage($theme->preview_image);
                }
                
                // Upload new image
                $data['preview_image'] = $this->handleImageUpload($request->file('preview_image'));
            }

            $theme->update($data);

            return redirect('/admin/themes')
                            ->with('success', 'Theme berhasil diupdate!');
        } catch (\Exception $e) {
            Log::error('Theme update error: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengupdate theme: ' . $e->getMessage());
        }
    }

    public function destroy(Theme $theme)
    {
        if ($theme->is_active) {
            return back()->with('error', 'Tidak dapat menghapus theme yang sedang aktif!');
        }

        try {
            // Delete theme image if exists
            if ($theme->preview_image) {
                $this->deleteImage($theme->preview_image);
            }

            // Delete all content images
            foreach ($theme->contents as $content) {
                if ($content->image) {
                    $this->deleteImage($content->image);
                }
            }

            $theme->delete();

            return back()->with('success', 'Theme berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Theme deletion error: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghapus theme: ' . $e->getMessage());
        }
    }

    public function activate(Theme $theme)
    {
        try {
            Theme::query()->update(['is_active' => false]);
            $theme->update(['is_active' => true]);
            
            return back()->with('success', 'Theme berhasil diaktifkan!');
        } catch (\Exception $e) {
            Log::error('Theme activation error: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengaktifkan theme: ' . $e->getMessage());
        }
    }

    public function editContent(Theme $theme)
    {
        $contents = $theme->contents()->orderBy('order')->get();
        
        return view('tenant.admin.themes.edit-content', compact('theme', 'contents'));
    }

    public function updateContent(Request $request, Theme $theme)
    {
        $request->validate([
            'contents' => 'required|array',
            'contents.*.section' => 'required|string',
            'contents.*.title' => 'nullable|string|max:255',
            'contents.*.content' => 'nullable|string',
            'contents.*.is_active' => 'boolean',
            'contents.*.order' => 'nullable|integer',
        ]);

        // Validate image files separately
        foreach ($request->file('contents', []) as $id => $files) {
            if (isset($files['image'])) {
                $request->validate([
                    "contents.{$id}.image" => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
                ]);
            }
        }

        try {
            foreach ($request->contents as $id => $contentData) {
                // Handle boolean conversion for is_active
                $contentData['is_active'] = isset($contentData['is_active']) ? true : false;
                
                // Handle image upload for content
                if ($request->hasFile("contents.{$id}.image")) {
                    $file = $request->file("contents.{$id}.image");
                    
                    // Delete old image if updating existing content
                    if (is_numeric($id)) {
                        $existingContent = ThemeContent::find($id);
                        if ($existingContent && $existingContent->image) {
                            $this->deleteImage($existingContent->image);
                        }
                    }
                    
                    // Upload new image
                    $contentData['image'] = $this->handleImageUpload($file, 'content');
                }
                
                // Update or create content
                if (is_numeric($id) && $id > 0) {
                    // Update existing content
                    $content = ThemeContent::find($id);
                    if ($content) {
                        $content->update($contentData);
                    }
                } else {
                    // Create new content
                    $contentData['theme_id'] = $theme->id;
                    $contentData['order'] = $contentData['order'] ?? 999;
                    ThemeContent::create($contentData);
                }
            }

            return back()->with('success', 'Konten theme berhasil diupdate!');
        } catch (\Exception $e) {
            Log::error('Theme content update error: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengupdate konten: ' . $e->getMessage());
        }
    }

    /**
     * Handle image upload with proper error handling
     */
    private function handleImageUpload($file, $prefix = 'theme')
    {
        try {
            // Validate file
            if (!$file->isValid()) {
                throw new \Exception('File tidak valid');
            }

            // Create upload directory if it doesn't exist
            $uploadPath = public_path('image/themes');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            // Generate unique filename
            $filename = $prefix . '_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            
            // Move file
            if (!$file->move($uploadPath, $filename)) {
                throw new \Exception('Gagal memindahkan file');
            }

            return $filename;
        } catch (\Exception $e) {
            Log::error('Image upload error: ' . $e->getMessage());
            throw new \Exception('Gagal mengupload gambar: ' . $e->getMessage());
        }
    }

    /**
     * Delete image file safely
     */
    private function deleteImage($filename)
    {
        try {
            if ($filename) {
                $imagePath = public_path("image/themes/{$filename}");
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
        } catch (\Exception $e) {
            Log::error('Image deletion error: ' . $e->getMessage());
            // Don't throw exception for deletion errors, just log them
        }
    }

    /**
     * Create default content sections for new theme
     */
    private function createDefaultContent(Theme $theme)
    {
        $defaultSections = [
            [
                'section' => 'hero',
                'title' => 'Selamat Datang di Portal Desa Kami',
                'content' => 'Temukan informasi lengkap tentang desa, layanan publik, dan produk UMKM lokal yang berkualitas.',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'section' => 'about',
                'title' => 'Tentang Desa Kami',
                'content' => 'Desa yang kaya akan budaya dan tradisi, dengan masyarakat yang gotong royong dalam membangun kemajuan bersama.',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'section' => 'services',
                'title' => 'Layanan Desa',
                'content' => 'Berbagai layanan administrasi dan publik yang dapat diakses secara online untuk kemudahan warga.',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'section' => 'products',
                'title' => 'Produk UMKM',
                'content' => 'Produk unggulan dari UMKM desa yang berkualitas dan berdaya saing tinggi.',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'section' => 'tourism',
                'title' => 'Wisata Desa',
                'content' => 'Destinasi wisata menarik yang menjadi kebanggaan desa kami.',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'section' => 'contact',
                'title' => 'Hubungi Kami',
                'content' => 'Jangan ragu untuk menghubungi aparatur desa jika membutuhkan informasi atau bantuan layanan.',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($defaultSections as $section) {
            $section['theme_id'] = $theme->id;
            ThemeContent::create($section);
        }
    }

    /**
     * Remove unused content
     */
    public function removeContent(Request $request, Theme $theme, ThemeContent $content)
    {
        try {
            // Delete content image if exists
            if ($content->image) {
                $this->deleteImage($content->image);
            }

            $content->delete();

            return response()->json([
                'success' => true,
                'message' => 'Konten berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            Log::error('Content removal error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus konten: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Duplicate theme
     */
    public function duplicate(Theme $theme)
    {
        try {
            $newTheme = $theme->replicate();
            $newTheme->name = $theme->name . ' (Copy)';
            $newTheme->slug = Str::slug($newTheme->name);
            $newTheme->is_active = false;
            
            // Duplicate preview image if exists
            if ($theme->preview_image) {
                $newTheme->preview_image = $this->duplicateImage($theme->preview_image);
            }
            
            $newTheme->save();

            // Duplicate contents
            foreach ($theme->contents as $content) {
                $newContent = $content->replicate();
                $newContent->theme_id = $newTheme->id;
                
                // Duplicate content image if exists
                if ($content->image) {
                    $newContent->image = $this->duplicateImage($content->image);
                }
                
                $newContent->save();
            }

            return back()->with('success', 'Theme berhasil diduplikasi!');
        } catch (\Exception $e) {
            Log::error('Theme duplication error: ' . $e->getMessage());
            return back()->with('error', 'Gagal menduplikasi theme: ' . $e->getMessage());
        }
    }

    /**
     * Duplicate image file
     */
    private function duplicateImage($originalFilename)
    {
        try {
            $originalPath = public_path("image/themes/{$originalFilename}");
            
            if (File::exists($originalPath)) {
                $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);
                $newFilename = 'copy_' . time() . '_' . Str::random(10) . '.' . $extension;
                $newPath = public_path("image/themes/{$newFilename}");
                
                if (File::copy($originalPath, $newPath)) {
                    return $newFilename;
                }
            }
            
            return null;
        } catch (\Exception $e) {
            Log::error('Image duplication error: ' . $e->getMessage());
            return null;
        }
    }
}