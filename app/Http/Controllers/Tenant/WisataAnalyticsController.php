<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use App\Models\CategoryWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WisataAnalyticsController extends Controller
{
    /**
     * Display analytics dashboard for wisata
     */
    public function index(Request $request)
    {
        $period = $request->get('period', '30'); // Default 30 days
        $categoryId = $request->get('category_id');
        
        $startDate = Carbon::now()->subDays((int)$period);
        $endDate = Carbon::now();
        $wisataQuery = Wisata::with(['category', 'images']);
        
        if ($categoryId) {
            $wisataQuery->where('category_wisata_id', $categoryId);
        }
        
        // Overall statistics
        $totalWisata = $wisataQuery->count();
        $wisataWithImages = $wisataQuery->has('images')->count();
        $wisataWithoutImages = $totalWisata - $wisataWithImages;
        
        // Category distribution
        $categoryStats = CategoryWisata::withCount('wisatas')
            ->orderByDesc('wisatas_count')
            ->get();
        
        // Recent wisata (last 30 days)
        $recentWisata = Wisata::where('created_at', '>=', $startDate)
            ->with(['category'])
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();
        
        // Monthly growth data (last 12 months)
        $monthlyData = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $count = Wisata::whereYear('created_at', $month->year)
                          ->whereMonth('created_at', $month->month)
                          ->count();
            
            $monthlyData[] = [
                'month' => $month->format('M Y'),
                'count' => $count,
                'month_short' => $month->format('M'),
            ];
        }
        
        // Location-based statistics (top provinces/cities based on coordinates)
        $locationStats = $this->getLocationStats();
        
        // Image statistics
        $imageStats = [
            'total_images' => DB::table('wisata_images')->count(),
            'avg_images_per_wisata' => $totalWisata > 0 ? 
                round(DB::table('wisata_images')->count() / $totalWisata, 1) : 0,
            'wisata_with_multiple_images' => Wisata::has('images', '>', 1)->count(),
        ];
        
        // Top categories by wisata count
        $topCategories = CategoryWisata::withCount('wisatas')
            ->having('wisatas_count', '>', 0)
            ->orderByDesc('wisatas_count')
            ->limit(5)
            ->get();
        
        // Performance metrics
        $performanceMetrics = [
            'completion_rate' => $totalWisata > 0 ? 
                round(($wisataWithImages / $totalWisata) * 100, 1) : 0,
            'avg_description_length' => Wisata::avg(DB::raw('LENGTH(description)')) ?? 0,
            'wisata_this_month' => Wisata::whereMonth('created_at', Carbon::now()->month)
                                        ->whereYear('created_at', Carbon::now()->year)
                                        ->count(),
            'wisata_last_month' => Wisata::whereMonth('created_at', Carbon::now()->subMonth()->month)
                                        ->whereYear('created_at', Carbon::now()->subMonth()->year)
                                        ->count(),
        ];
        
        // Calculate growth percentage
        $growthPercentage = 0;
        if ($performanceMetrics['wisata_last_month'] > 0) {
            $growthPercentage = round(
                (($performanceMetrics['wisata_this_month'] - $performanceMetrics['wisata_last_month']) / 
                 $performanceMetrics['wisata_last_month']) * 100, 
                1
            );
        }
        
        $categories = CategoryWisata::where('is_active', true)->orderBy('name')->get();
        
        return view('tenant.wisatas.analytics', compact(
            'totalWisata',
            'wisataWithImages', 
            'wisataWithoutImages',
            'categoryStats',
            'recentWisata',
            'monthlyData',
            'locationStats',
            'imageStats',
            'topCategories',
            'performanceMetrics',
            'growthPercentage',
            'categories',
            'period',
            'categoryId'
        ));
    }
    
    /**
     * Get location-based statistics
     */
    private function getLocationStats()
    {
        return [
            'total_locations' => Wisata::distinct(['latitude', 'longitude'])->count(),
            'coordinates_coverage' => [
                'min_lat' => Wisata::min('latitude'),
                'max_lat' => Wisata::max('latitude'),
                'min_lng' => Wisata::min('longitude'),
                'max_lng' => Wisata::max('longitude'),
            ]
        ];
    }
    
    /**
     * Export analytics data
     */
    public function export(Request $request)
    {
        $format = $request->get('format', 'csv');
        
        $wisatas = Wisata::with(['category', 'images'])
            ->get()
            ->map(function ($wisata) {
                return [
                    'ID' => $wisata->id,
                    'Nama' => $wisata->name,
                    'Slug' => $wisata->slug,
                    'Kategori' => $wisata->category?->name ?? 'Tidak ada',
                    'Latitude' => $wisata->latitude,
                    'Longitude' => $wisata->longitude,
                    'Jumlah Gambar' => $wisata->images->count(),
                    'Panjang Deskripsi' => strlen($wisata->description),
                    'Tanggal Dibuat' => $wisata->created_at->format('Y-m-d H:i:s'),
                    'Terakhir Diperbarui' => $wisata->updated_at->format('Y-m-d H:i:s'),
                ];
            });
        
        if ($format === 'csv') {
            $filename = 'wisata-analytics-' . date('Y-m-d') . '.csv';
            
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];
            
            $callback = function() use ($wisatas) {
                $file = fopen('php://output', 'w');
                
                fputcsv($file, array_keys($wisatas->first() ?? []));
                
                foreach ($wisatas as $wisata) {
                    fputcsv($file, array_values($wisata));
                }
                
                fclose($file);
            };
            
            return response()->stream($callback, 200, $headers);
        }
        
        // JSON export
        return response()->json($wisatas);
    }
}