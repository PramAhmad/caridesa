<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the category products.
     */
    public function index()
    {
        $categories = CategoryProduct::withCount('products')->latest()->get();
        return view('tenant.category-products.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category product.
     */
    public function create()
    {
        return view('tenant.category-products.create');
    }

    /**
     * Store a newly created category product.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:category_products,name',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active') ? true : false;

        CategoryProduct::create($validated);

        return redirect()->route('category-products.index')
                        ->with('success', 'Kategori produk berhasil dibuat!');
    }

    /**
     * Display the specified category product.
     */
    public function show(CategoryProduct $categoryProduct)
    {
        $categoryProduct->load(['products' => function($query) {
            $query->latest()->take(10);
        }]);
        
        return view('tenant.category-products.show', compact('categoryProduct'));
    }

    /**
     * Show the form for editing the specified category product.
     */
    public function edit(CategoryProduct $categoryProduct)
    {
        return view('tenant.category-products.edit', compact('categoryProduct'));
    }

    /**
     * Update the specified category product.
     */
    public function update(Request $request, CategoryProduct $categoryProduct)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:category_products,name,' . $categoryProduct->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active') ? true : false;

        $categoryProduct->update($validated);

        return redirect()->route('category-products.index')
                        ->with('success', 'Kategori produk berhasil diperbarui!');
    }

    /**
     * Remove the specified category product.
     */
    public function destroy(CategoryProduct $categoryProduct)
    {
        // Check if category has products
        if ($categoryProduct->products()->exists()) {
            return back()->with('error', 'Tidak dapat menghapus kategori yang masih memiliki produk!');
        }

        $categoryProduct->delete();

        return back()->with('success', 'Kategori produk berhasil dihapus!');
    }
}