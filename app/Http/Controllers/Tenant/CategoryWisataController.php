<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\CategoryWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryWisataController extends Controller
{
    /**
     * Display a listing of the category wisatas.
     */
    public function index()
    {
        $categories = CategoryWisata::withCount('wisatas')->latest()->get();
        return view('tenant.category-wisatas.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category wisata.
     */
    public function create()
    {
        return view('tenant.category-wisatas.create');
    }

    /**
     * Store a newly created category wisata.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:category_wisatas,name',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ], [
            'name.required' => 'Nama kategori wisata wajib diisi.',
            'name.unique' => 'Nama kategori wisata sudah digunakan.',
            'name.max' => 'Nama kategori wisata maksimal 255 karakter.',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active') ? true : false;

        CategoryWisata::create($validated);

        return redirect()->route('category-wisatas.index')
                        ->with('success', 'Kategori wisata berhasil dibuat!');
    }

    /**
     * Display the specified category wisata.
     */
    public function show(CategoryWisata $categoryWisata)
    {
        $categoryWisata->load(['wisatas' => function($query) {
            $query->latest()->take(10);
        }]);
        
        return view('tenant.category-wisatas.show', compact('categoryWisata'));
    }

    /**
     * Show the form for editing the specified category wisata.
     */
    public function edit(CategoryWisata $categoryWisata)
    {
        return view('tenant.category-wisatas.edit', compact('categoryWisata'));
    }

    /**
     * Update the specified category wisata.
     */
    public function update(Request $request, CategoryWisata $categoryWisata)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:category_wisatas,name,' . $categoryWisata->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ], [
            'name.required' => 'Nama kategori wisata wajib diisi.',
            'name.unique' => 'Nama kategori wisata sudah digunakan.',
            'name.max' => 'Nama kategori wisata maksimal 255 karakter.',
        ]);

        // Only update slug if name changed
        if ($categoryWisata->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']);
        }
        
        $validated['is_active'] = $request->has('is_active') ? true : false;

        $categoryWisata->update($validated);

        return redirect()->route('category-wisatas.index')
                        ->with('success', 'Kategori wisata berhasil diperbarui!');
    }

    /**
     * Remove the specified category wisata.
     */
    public function destroy(CategoryWisata $categoryWisata)
    {
        // Check if category has wisatas
        if ($categoryWisata->wisatas()->exists()) {
            return back()->with('error', 'Tidak dapat menghapus kategori yang masih memiliki destinasi wisata!');
        }

        $categoryWisata->delete();

        return back()->with('success', 'Kategori wisata berhasil dihapus!');
    }
}