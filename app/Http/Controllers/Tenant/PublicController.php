<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\CategoryProduct;
use App\Models\Wisata;
use App\Models\CategoryWisata;
use App\Models\HomeStay;
use App\Models\Event;
use App\Models\Guide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class PublicController extends Controller
{
    /**
     * Display products listing page
     */
    public function products(Request $request)
    {
        try {
            $query = Product::where('is_active', true)->with(['category']);
            
            // Filter by category
            if ($request->filled('category') && $request->category !== 'all') {
                $query->where('category_product_id', $request->category);
            }
            
            // Search functionality
            if ($request->filled('search')) {
                $searchTerm = $request->search;
                $query->where(function($q) use ($searchTerm) {
                    $q->where('name', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('description', 'LIKE', "%{$searchTerm}%");
                });
            }
            
            // Price range filter
            if ($request->filled('min_price')) {
                $query->where('price', '>=', $request->min_price);
            }
            
            if ($request->filled('max_price')) {
                $query->where('price', '<=', $request->max_price);
            }
            
            // Sorting
            $sortBy = $request->get('sort', 'latest');
            switch ($sortBy) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name':
                    $query->orderBy('name', 'asc');
                    break;
                default:
                    $query->latest();
                    break;
            }
            
            // Pagination with 12 items per page
            $products = $query->paginate(12)->withQueryString();
            $categories = CategoryProduct::where('is_active', true)->get();
            
            // Price range for filter
            $priceRange = Product::where('is_active', true)->selectRaw('MIN(price) as min_price, MAX(price) as max_price')->first();
            
            return view('tenant.public.products.index', compact(
                'products', 
                'categories', 
                'priceRange'
            ));
            
        } catch (Exception $e) {
            Log::error('Error loading products page: ' . $e->getMessage());
            return back()->with('error', 'Gagal memuat halaman produk. Silakan coba lagi.');
        }
    }
    
    /**
     * Display product detail page by model binding
     */
    public function productDetail(Product $product)
    {
        try {
            // Check if product is active
            if (!$product->is_active) {
                return redirect()->route('public.products')->with('error', 'Produk tidak tersedia.');
            }
            

            
            $product->load(['category']);
            
            // Related products from same category
            $relatedProducts = Product::where('is_active', true)
                ->where('category_product_id', $product->category_product_id)
                ->where('id', '!=', $product->id)
                ->take(4)
                ->get();
            
            // Popular products if no related products
            if ($relatedProducts->count() < 4) {
                $additionalProducts = Product::where('is_active', true)
                    ->where('id', '!=', $product->id)
                    ->whereNotIn('id', $relatedProducts->pluck('id'))
                    ->take(4 - $relatedProducts->count())
                    ->get();
                
                $relatedProducts = $relatedProducts->merge($additionalProducts);
            }
            
            return view('tenant.public.products.detail', compact('product', 'relatedProducts'));
            
        } catch (Exception $e) {
            Log::error("Error loading product detail: ID {$product->id}, Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memuat detail produk.');
        }
    }
    
    /**
     * Display product detail page by slug (alternative route for compatibility)
     */
    public function productDetailBySlug($slug)
    {
        try {
            $product = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();
            return $this->productDetail($product);
        } catch (Exception $e) {
            Log::error("Error loading product detail by slug: {$slug}, Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Produk tidak ditemukan atau tidak tersedia.');
        }
    }
    
    /**
     * Display wisata listing page
     */
    public function wisata(Request $request)
    {
        try {
            $query = Wisata::with(['category', 'images']);
            
            // Filter by category
            if ($request->filled('category') && $request->category !== 'all') {
                $query->where('category_wisata_id', $request->category);
            }
            
            // Search functionality
            if ($request->filled('search')) {
                $searchTerm = $request->search;
                $query->where(function($q) use ($searchTerm) {
                    $q->where('name', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('description', 'LIKE', "%{$searchTerm}%");
                });
            }
            
            // Location filter (search in description for location keywords)
            if ($request->filled('location')) {
                $query->where('description', 'LIKE', "%{$request->location}%");
            }
            
            // Sorting
            $sortBy = $request->get('sort', 'latest');
            switch ($sortBy) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'oldest':
                    $query->oldest();
                    break;
                default:
                    $query->latest();
                    break;
            }
            
            // Pagination with 12 items per page
            $wisatas = $query->paginate(12)->withQueryString();
            $categories = CategoryWisata::all();
            
            return view('tenant.public.wisata.index', compact(
                'wisatas', 
                'categories'
            ));
            
        } catch (Exception $e) {
            Log::error('Error loading wisata page: ' . $e->getMessage());
            return back()->with('error', 'Gagal memuat halaman wisata. Silakan coba lagi.');
        }
    }
    
    /**
     * Display wisata detail page
     */
    public function wisataDetail(Wisata $wisata)
    {
        try {
            $wisata->load(['category', 'images']);
            
            // Debug: Log image information for troubleshooting
            Log::info("Wisata Detail - ID: {$wisata->id}, Name: {$wisata->name}");
            Log::info("Images count: " . $wisata->images->count());
            if ($wisata->images->count() > 0) {
                foreach ($wisata->images as $image) {
                    Log::info("Image: {$image->name}");
                }
            }
            Log::info("Main Image URL: " . $wisata->main_image_url);
            
            // Related wisata from same category
            $relatedWisatas = Wisata::where('category_wisata_id', $wisata->category_wisata_id)
                ->where('id', '!=', $wisata->id)
                ->with(['category', 'images'])
                ->take(4)
                ->get();
            
            // Popular wisata if no related wisata
            if ($relatedWisatas->count() < 4) {
                $additionalWisatas = Wisata::where('id', '!=', $wisata->id)
                    ->whereNotIn('id', $relatedWisatas->pluck('id'))
                    ->with(['category', 'images'])
                    ->take(4 - $relatedWisatas->count())
                    ->get();
                
                $relatedWisatas = $relatedWisatas->merge($additionalWisatas);
            }
            
            return view('tenant.public.wisata.detail', compact('wisata', 'relatedWisatas'));
            
        } catch (Exception $e) {
            Log::error("Error loading wisata detail: Slug/ID {$wisata->slug}, Error: " . $e->getMessage());
            return back()->with('error', 'Gagal memuat detail wisata.');
        }
    }
    
    /**
     * Display homestay listing page
     */
    public function homestay(Request $request)
    {
        try {
            $query = HomeStay::with(['images']);
            
            // Search functionality
            if ($request->filled('search')) {
                $searchTerm = $request->search;
                $query->where(function($q) use ($searchTerm) {
                    $q->where('name', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('address', 'LIKE', "%{$searchTerm}%");
                });
            }
            
            // Location filter
            if ($request->filled('location')) {
                $query->where('address', 'LIKE', "%{$request->location}%");
            }
            
            // Price range filter
            if ($request->filled('min_price')) {
                $query->where('price', '>=', $request->min_price);
            }
            
            if ($request->filled('max_price')) {
                $query->where('price', '<=', $request->max_price);
            }
            
            // Discount filter
            if ($request->filled('discount') && $request->discount === '1') {
                $query->where('discount_percent', '>', 0);
            }
            
            // Sorting
            $sortBy = $request->get('sort', 'latest');
            switch ($sortBy) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'oldest':
                    $query->oldest();
                    break;
                default:
                    $query->latest();
                    break;
            }
            
            // Pagination with 12 items per page
            $homestays = $query->paginate(12)->withQueryString();
            
        
            
            return view('tenant.public.homestay.index', compact('homestays'));
            
        } catch (Exception $e) {
            Log::error('Error loading homestay page: ' . $e->getMessage());
            return back()->with('error', 'Gagal memuat halaman homestay. Silakan coba lagi.');
        }
    }
    
    /**
     * Display homestay detail page
     */
    public function homestayDetail(HomeStay $homestay)
    {
        try {
        
            
            $homestay->load(['images']);

            $relatedHomestays = HomeStay::where('id', '!=', $homestay->id)
                ->with(['images'])
                ->take(4)
                ->get();
            
            if ($relatedHomestays->count() < 4) {
                $additionalHomestays = HomeStay::where('id', '!=', $homestay->id)
                    ->whereNotIn('id', $relatedHomestays->pluck('id'))
                    ->with(['images'])
                    ->take(4 - $relatedHomestays->count())
                    ->get();
                
                $relatedHomestays = $relatedHomestays->merge($additionalHomestays);
            }
            
            return view('tenant.public.homestay.detail', compact('homestay', 'relatedHomestays'));
            
        } catch (Exception $e) {
            Log::error("Error loading homestay detail: ID {$homestay->id}, Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memuat detail homestay.');
        }
    }
    
    /**
     * Display events listing page
     */
    public function events(Request $request)
    {
        try {
            $query = Event::where('is_active', true);
            
            // Search functionality
            if ($request->filled('search')) {
                $searchTerm = $request->search;
                $query->where(function($q) use ($searchTerm) {
                    $q->where('name', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('location', 'LIKE', "%{$searchTerm}%");
                });
            }
            
            // Filter by date
            if ($request->filled('date_filter')) {
                $dateFilter = $request->date_filter;
                $now = now();
                
                switch ($dateFilter) {
                    case 'upcoming':
                        $query->where('start_date', '>', $now);
                        break;
                    case 'ongoing':
                        $query->where('start_date', '<=', $now)
                              ->where('end_date', '>=', $now);
                        break;
                    case 'past':
                        $query->where('end_date', '<', $now);
                        break;
                }
            }
            
            $events = $query->latest()->paginate(12)->withQueryString();
            
            return view('tenant.public.events.index', compact('events'));
            
        } catch (Exception $e) {
            Log::error('Error loading events page: ' . $e->getMessage());
            return back()->with('error', 'Gagal memuat halaman acara. Silakan coba lagi.');
        }
    }
    
    /**
     * Display event detail page
     */
    public function eventDetail(Event $event)
    {
        try {
            if (!$event->is_active) {
                return redirect()->route('public.events')->with('error', 'Acara tidak tersedia.');
            }
            
            // Related events
            $relatedEvents = Event::where('is_active', true)
                ->where('id', '!=', $event->id)
                ->take(4)
                ->get();
            
            return view('tenant.public.events.detail', compact('event', 'relatedEvents'));
            
        } catch (Exception $e) {
            Log::error("Error loading event detail: ID {$event->id}, Error: " . $e->getMessage());
            return redirect()->route('public.events')->with('error', 'Gagal memuat detail acara.');
        }
    }
    
    /**
     * Display guides listing page
     */
    public function guides(Request $request)
    {
        try {
            $query = Guide::where('is_active', true);
            
            // Search functionality
            if ($request->filled('search')) {
                $searchTerm = $request->search;
                $query->where(function($q) use ($searchTerm) {
                    $q->where('name', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('specialization', 'LIKE', "%{$searchTerm}%");
                });
            }
            
            // Price range filter
            if ($request->filled('min_price')) {
                $query->where('price_per_day', '>=', $request->min_price);
            }
            
            if ($request->filled('max_price')) {
                $query->where('price_per_day', '<=', $request->max_price);
            }
            
            $guides = $query->latest()->paginate(12)->withQueryString();
            
            return view('tenant.public.guides.index', compact('guides'));
            
        } catch (Exception $e) {
            Log::error('Error loading guides page: ' . $e->getMessage());
            return back()->with('error', 'Gagal memuat halaman pemandu. Silakan coba lagi.');
        }
    }
    
    /**
     * Display guide detail page
     */
    public function guideDetail(Guide $guide)
    {
        try {
            // Pastikan guide aktif
            if (!$guide->is_active) {
                return redirect()->route('public.guides')->with('error', 'Guide tidak tersedia.');
            }
            
            // Load relasi images jika ada
            $guide->load(['images']);
            
            // Debug log untuk troubleshooting
            Log::info("Guide Detail Access - ID: {$guide->id}, Name: {$guide->name}, Slug: {$guide->slug}");
            
            // Related guides
            $relatedGuides = Guide::where('is_active', true)
                ->where('id', '!=', $guide->id)
                ->with(['images'])
                ->take(4)
                ->get();
            
            return view('tenant.public.guides.detail', compact('guide', 'relatedGuides'));
            
        } catch (Exception $e) {
            Log::error("Error loading guide detail: Slug {$guide->slug}, Error: " . $e->getMessage());
            return redirect()->route('public.guides')->with('error', 'Gagal memuat detail guide.');
        }
    }
}