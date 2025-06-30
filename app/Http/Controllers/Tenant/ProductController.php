<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\CategoryProduct;
use App\Enum\ProductStockStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index(Request $request)
    {
        $query = Product::with('category');
        
        // Filter by category if specified
        if ($request->has('category') && $request->category) {
            $query->where('category_product_id', $request->category);
        }
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }
        
        // Filter by stock status
        if ($request->has('stock') && $request->stock) {
            $query->where('stock', $request->stock);
        }
        
        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', (bool)$request->status);
        }
        
        $products = $query->latest()->paginate(15);
        $categories = CategoryProduct::active()->get();
        $stockStatuses = ProductStockStatus::cases();
        
        return view('tenant.products.index', compact('products', 'categories', 'stockStatuses'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(Request $request)
    {
        $categories = CategoryProduct::active()->get();
        $stockStatuses = ProductStockStatus::cases();
        $selectedCategory = $request->get('category');
        
        return view('tenant.products.create', compact('categories', 'stockStatuses', 'selectedCategory'));
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_product_id' => 'required|exists:category_products,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|in:' . implode(',', array_column(ProductStockStatus::cases(), 'value')),
            'discount' => 'nullable|numeric|min:0|max:100',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'links.tokopedia' => 'nullable|url',
            'links.shopee' => 'nullable|url',
            'links.lazada' => 'nullable|url',
            'links.blibli' => 'nullable|url',
            'links.whatsapp' => 'nullable|string',
            'links.website' => 'nullable|url',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active') ? true : false;
        $validated['stock'] = ProductStockStatus::from($validated['stock']);
        
        // Handle links
        if ($request->has('links')) {
            $validated['links'] = array_filter($request->links);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $uploadPath = public_path("image/products");
            
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $validated['image'] = '/image/products/' . $filename;
        }

        Product::create($validated);

        return redirect()->route('products.index')
                        ->with('success', 'Produk berhasil dibuat!');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        $product->load('category');
        return view('tenant.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $categories = CategoryProduct::active()->get();
        $stockStatuses = ProductStockStatus::cases();
        
        return view('tenant.products.edit', compact('product', 'categories', 'stockStatuses'));
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_product_id' => 'required|exists:category_products,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|in:' . implode(',', array_column(ProductStockStatus::cases(), 'value')),
            'discount' => 'nullable|numeric|min:0|max:100',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'links.tokopedia' => 'nullable|url',
            'links.shopee' => 'nullable|url',
            'links.lazada' => 'nullable|url',
            'links.blibli' => 'nullable|url',
            'links.whatsapp' => 'nullable|string',
            'links.website' => 'nullable|url',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active') ? true : false;
        $validated['stock'] = ProductStockStatus::from($validated['stock']);
        
        // Handle links
        if ($request->has('links')) {
            $validated['links'] = array_filter($request->links);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                $oldImagePath = public_path("image/products/{$product->image}");
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            
            $file = $request->file('image');
            $uploadPath = public_path("image/products");
            
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $validated['image'] = '/image/products/' . $filename;
        }

        $product->update($validated);

        return redirect()->route('products.index')
                        ->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified product.
     */
    public function destroy(Product $product)
    {
        // Delete product image if exists
        if ($product->image) {
            $imagePath = public_path("image/products/{$product->image}");
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus!');
    }
}