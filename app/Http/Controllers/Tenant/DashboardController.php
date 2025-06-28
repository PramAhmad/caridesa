<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Get statistics for all tables
            $stats = $this->getTableStatistics();
            
            // Get recent activities
            $recentActivities = $this->getRecentActivities();
            
            // Get chart data
            $chartData = $this->getChartData();
            
            return view('tenant.dashboard.index', compact('stats', 'recentActivities', 'chartData'));
            
        } catch (\Exception $e) {
            \Log::error('Dashboard error: ' . $e->getMessage());
            
            // Fallback data if there's an error
            $stats = $this->getFallbackStats();
            $recentActivities = [];
            $chartData = $this->getFallbackChartData();
            
            return view('tenant.dashboard.index', compact('stats', 'recentActivities', 'chartData'));
        }
    }

    private function getTableStatistics()
    {
        $tables = [
            'users' => 'Users',
            'products' => 'Products', 
            'category_products' => 'Product Categories',
            'wisatas' => 'Wisata',
            'category_wisatas' => 'Wisata Categories',
            'homestays' => 'Homestays',
            'events' => 'Events',
            'guides' => 'Guides',
        ];

        $stats = [];
        
        foreach ($tables as $table => $label) {
            try {
                $count = DB::table($table)->count();
                $stats[] = [
                    'table' => $table,
                    'label' => $label,
                    'count' => $count,
                    'icon' => $this->getTableIcon($table),
                    'color' => $this->getTableColor($table),
                ];
            } catch (\Exception $e) {
                // Table might not exist, skip it
                continue;
            }
        }

        return $stats;
    }

    private function getRecentActivities()
    {
        $activities = [];
        
        try {
            // Get recent users
            $recentUsers = DB::table('users')
                ->select('name', 'email', 'created_at')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
            
            foreach ($recentUsers as $user) {
                $activities[] = [
                    'type' => 'user',
                    'title' => 'New user registered',
                    'description' => $user->name . ' (' . $user->email . ')',
                    'date' => $user->created_at,
                    'icon' => 'user-plus',
                    'color' => 'blue'
                ];
            }

            // Get recent products
            if (DB::getSchemaBuilder()->hasTable('products')) {
                $recentProducts = DB::table('products')
                    ->select('name', 'created_at')
                    ->orderBy('created_at', 'desc')
                    ->limit(3)
                    ->get();
                
                foreach ($recentProducts as $product) {
                    $activities[] = [
                        'type' => 'product',
                        'title' => 'New product added',
                        'description' => $product->name,
                        'date' => $product->created_at,
                        'icon' => 'package',
                        'color' => 'green'
                    ];
                }
            }

            // Get recent wisata
            if (DB::getSchemaBuilder()->hasTable('wisatas')) {
                $recentWisata = DB::table('wisatas')
                    ->select('name', 'created_at')
                    ->orderBy('created_at', 'desc')
                    ->limit(3)
                    ->get();
                
                foreach ($recentWisata as $wisata) {
                    $activities[] = [
                        'type' => 'wisata',
                        'title' => 'New wisata added',
                        'description' => $wisata->name,
                        'date' => $wisata->created_at,
                        'icon' => 'map-pin',
                        'color' => 'purple'
                    ];
                }
            }

            // Sort by date
            usort($activities, function($a, $b) {
                return strtotime($b['date']) - strtotime($a['date']);
            });

            return array_slice($activities, 0, 10);
            
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getChartData()
    {
        try {
            $chartData = [];
            
            // Users growth chart
            $userGrowth = DB::table('users')
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
                ->where('created_at', '>=', now()->subDays(30))
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            $chartData['users'] = [
                'labels' => $userGrowth->pluck('date')->toArray(),
                'data' => $userGrowth->pluck('count')->toArray(),
            ];

            // Products by category
            if (DB::getSchemaBuilder()->hasTable('products') && DB::getSchemaBuilder()->hasTable('category_products')) {
                $productsByCategory = DB::table('products')
                    ->join('category_products', 'products.category_product_id', '=', 'category_products.id')
                    ->select('category_products.name', DB::raw('COUNT(*) as count'))
                    ->groupBy('category_products.id', 'category_products.name')
                    ->get();

                $chartData['productsByCategory'] = [
                    'labels' => $productsByCategory->pluck('name')->toArray(),
                    'data' => $productsByCategory->pluck('count')->toArray(),
                ];
            }

            return $chartData;
            
        } catch (\Exception $e) {
            return $this->getFallbackChartData();
        }
    }

    private function getTableIcon($table)
    {
        $icons = [
            'users' => 'users',
            'products' => 'package',
            'category_products' => 'tag',
            'wisatas' => 'map-pin',
            'category_wisatas' => 'bookmark',
            'homestays' => 'home',
            'events' => 'calendar',
            'guides' => 'user-check',
        ];

        return $icons[$table] ?? 'database';
    }

    private function getTableColor($table)
    {
        $colors = [
            'users' => 'blue',
            'products' => 'green',
            'category_products' => 'yellow',
            'wisatas' => 'purple',
            'category_wisatas' => 'pink',
            'homestays' => 'indigo',
            'events' => 'red',
            'guides' => 'gray',
        ];

        return $colors[$table] ?? 'gray';
    }

    private function getFallbackStats()
    {
        return [
            [
                'table' => 'users',
                'label' => 'Users',
                'count' => 0,
                'icon' => 'users',
                'color' => 'blue',
            ]
        ];
    }

    private function getFallbackChartData()
    {
        return [
            'users' => [
                'labels' => [],
                'data' => [],
            ],
            'productsByCategory' => [
                'labels' => [],
                'data' => [],
            ]
        ];
    }

    public function quickStats()
    {
        try {
            $stats = [
                'total_users' => DB::table('users')->count(),
                'total_products' => DB::getSchemaBuilder()->hasTable('products') ? DB::table('products')->count() : 0,
                'total_wisata' => DB::getSchemaBuilder()->hasTable('wisatas') ? DB::table('wisatas')->count() : 0,
                'total_events' => DB::getSchemaBuilder()->hasTable('events') ? DB::table('events')->count() : 0,
            ];

            return response()->json($stats);
            
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch stats'], 500);
        }
    }
}