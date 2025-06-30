<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use App\Models\ThemeContent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

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
            'preview_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'config' => 'nullable|array',
        ]);

        $data = $request->only(['name', 'description', 'config']);
        $data['slug'] = Str::slug($request->name);

        // Handle preview image upload
        if ($request->hasFile('preview_image')) {
            $file = $request->file('preview_image');
            $uploadPath = public_path("image/themes");
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $data['preview_image'] = $filename;
        }
        $theme = Theme::create($data);
        $this->createDefaultContent($theme);

        return redirect('/admin/themes')
                        ->with('success', 'Theme berhasil dibuat!');
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
            'preview_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'config' => 'nullable|array',
        ]);

        $data = $request->only(['name', 'description', 'config']);
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('preview_image')) {
            $file = $request->file('preview_image');
            if ($theme->preview_image) {
                $oldImagePath = public_path("image/themes/{$theme->preview_image}");
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            $uploadPath = public_path("image/themes");
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            
            $data['preview_image'] = $filename;
        }

        $theme->update($data);

        return redirect('/admin/themes')
                        ->with('success', 'Theme berhasil diupdate!');
    }

    public function destroy(Theme $theme)
    {
        if ($theme->is_active) {
            return back()->with('error', 'Tidak dapat menghapus theme yang sedang aktif!');
        }

        // Delete theme image if exists
        if ($theme->preview_image) {
            $imagePath = public_path("image/themes/{$theme->preview_image}");
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $theme->delete();

        return back()->with('success', 'Theme berhasil dihapus!');
    }

    public function activate(Theme $theme)
    {
        Theme::query()->update(['is_active' => false]);
        $theme->update(['is_active' => true]);
        return back()->with('success', 'Theme berhasil diaktifkan!');
    }

    public function editContent(Theme $theme)
    {
        $contents = $theme->contents;
        
        return view('tenant.admin.themes.edit-content', compact('theme', 'contents'));
    }

    public function updateContent(Request $request, Theme $theme)
    {
        $request->validate([
            'contents' => 'required|array',
            'contents.*.section' => 'required|string',
            'contents.*.title' => 'nullable|string',
            'contents.*.content' => 'nullable|string',
            'contents.*.is_active' => 'boolean',
            'contents.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        foreach ($request->contents as $id => $contentData) {
            // Handle image upload for content
            if ($request->hasFile("contents.{$id}.image")) {
                $file = $request->file("contents.{$id}.image");
                if (is_numeric($id)) {
                    $existingContent = ThemeContent::find($id);
                    if ($existingContent && $existingContent->image) {
                        $oldImagePath = public_path("image/themes/{$existingContent->image}");
                        if (File::exists($oldImagePath)) {
                            File::delete($oldImagePath);
                        }
                    }
                }
                $uploadPath = public_path("image/themes");
                if (!File::exists($uploadPath)) {
                    File::makeDirectory($uploadPath, 0755, true);
                }
                $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $file->move($uploadPath, $filename);
                $contentData['image'] = $filename;
            }

            if (is_numeric($id)) {
                ThemeContent::where('id', $id)->update($contentData);
            } else {
                $contentData['theme_id'] = $theme->id;
                ThemeContent::create($contentData);
            }
        }

        return back()->with('success', 'Konten theme berhasil diupdate!');
    }

    private function createDefaultContent(Theme $theme)
    {
        $defaultSections = [
            [
                'section' => 'hero',
                'title' => 'Selamat Datang di Portal Desa Kami',
                'content' => 'Temukan informasi lengkap tentang desa, layanan publik, dan produk UMKM lokal yang berkualitas.',
                'order' => 1,
            ],
            [
                'section' => 'about',
                'title' => 'Tentang Desa Kami',
                'content' => 'Desa yang kaya akan budaya dan tradisi, dengan masyarakat yang gotong royong dalam membangun kemajuan bersama.',
                'order' => 2,
            ],
            [
                'section' => 'services',
                'title' => 'Layanan Desa',
                'content' => 'Berbagai layanan administrasi dan publik yang dapat diakses secara online untuk kemudahan warga.',
                'order' => 3,
            ],
            [
                'section' => 'contact',
                'title' => 'Hubungi Kami',
                'content' => 'Jangan ragu untuk menghubungi aparatur desa jika membutuhkan informasi atau bantuan layanan.',
                'order' => 4,
            ],
        ];

        foreach ($defaultSections as $section) {
            $section['theme_id'] = $theme->id;
            $section['is_active'] = true;
            ThemeContent::create($section);
        }
    }
}