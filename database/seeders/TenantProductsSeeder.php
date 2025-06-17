<?php

namespace Database\Seeders;

use App\Enum\ProductStockStatus;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantProductsSeeder extends Seeder
{
   public function run(): void
    {
        $this->command->info('Creating sample categories and products...');

        // Create sample categories
        $categories = $this->createSampleCategories();
        $this->command->info('Categories created: ' . $categories->count());

        // Create sample products for each category
        $totalProducts = 0;
        foreach ($categories as $category) {
            $products = $this->createSampleProducts($category);
            $totalProducts += $products->count();
            $this->command->info("Created {$products->count()} products for category: {$category->name}");
        }

        $this->command->info("Total products created: {$totalProducts}");
        $this->command->info('Sample data seeding completed!');
    }

    /**
     * Create sample categories
     */
    private function createSampleCategories()
    {
        $categoriesData = [
    
            [
                'name' => 'Kerajinan Tangan',
                'description' => 'Produk kerajinan tangan buatan warga desa dengan kualitas tinggi dan desain unik.',
                'is_active' => true,
            ],
            [
                'name' => 'Hasil Pertanian',
                'description' => 'Produk segar dari hasil pertanian lokal yang berkualitas dan organik.',
                'is_active' => true,
            ],
            [
                'name' => 'Minuman Herbal',
                'description' => 'Minuman herbal alami dari tanaman obat tradisional untuk kesehatan.',
                'is_active' => true,
            ],
            [
                'name' => 'Tekstil & Batik',
                'description' => 'Produk tekstil dan batik dengan motif khas daerah yang indah dan berkualitas.',
                'is_active' => true,
            ],
            [
                'name' => 'Produk Olahan',
                'description' => 'Berbagai produk olahan makanan dan minuman hasil inovasi warga desa.',
                'is_active' => false, // One inactive category for testing
            ],
        ];

        $categories = collect([]);
        
        foreach ($categoriesData as $categoryData) {
            $category = CategoryProduct::create([
                'name' => $categoryData['name'],
                'slug' => \Str::slug($categoryData['name']),
                'description' => $categoryData['description'],
                'is_active' => $categoryData['is_active'],
            ]);
            
            $categories->push($category);
        }

        return $categories;
    }

    /**
     * Create sample products for a category
     */
    private function createSampleProducts(CategoryProduct $category)
    {
        $productsData = $this->getProductsByCategory($category->slug);
        $products = collect([]);

        foreach ($productsData as $productData) {
            $product = Product::create([
                'name' => $productData['name'],
                'slug' => \Str::slug($productData['name']),
                'category_product_id' => $category->id,
                'description' => $productData['description'],
                'price' => $productData['price'],
                'stock' => ProductStockStatus::from($productData['stock']),
                'discount' => $productData['discount'] ?? 0,
                'is_active' => $productData['is_active'] ?? true,
                'links' => $productData['links'] ?? null,
            ]);

            $products->push($product);
        }

        return $products;
    }

    /**
     * Get products data by category slug
     */
    private function getProductsByCategory(string $categorySlug): array
    {
        $productsMap = [
            'makanan-tradisional' => [
                [
                    'name' => 'Kerupuk Ikan Lele',
                    'description' => 'Kerupuk ikan lele asli buatan rumahan dengan rasa gurih dan renyah. Dibuat dari ikan lele segar pilihan dengan resep turun temurun.',
                    'price' => 15000,
                    'stock' => 'in_stock',
                    'discount' => 10,
                    'links' => [
                        'tokopedia' => 'https://tokopedia.com/kerupuk-lele',
                        'whatsapp' => '6281234567890',
                    ],
                ],
                [
                    'name' => 'Dodol Durian',
                    'description' => 'Dodol durian premium dengan tekstur kenyal dan aroma durian yang khas. Terbuat dari durian lokal pilihan.',
                    'price' => 25000,
                    'stock' => 'in_stock',
                    'discount' => 0,
                    'links' => [
                        'shopee' => 'https://shopee.co.id/dodol-durian',
                        'whatsapp' => '6281234567890',
                    ],
                ],
                [
                    'name' => 'Rendang Daging Sapi',
                    'description' => 'Rendang daging sapi dengan bumbu rempah tradisional. Dimasak dalam waktu lama hingga bumbu meresap sempurna.',
                    'price' => 85000,
                    'stock' => 'low_stock',
                    'discount' => 5,
                    'links' => [
                        'tokopedia' => 'https://tokopedia.com/rendang-sapi',
                        'lazada' => 'https://lazada.co.id/rendang',
                    ],
                ],
                [
                    'name' => 'Abon Ikan Tuna',
                    'description' => 'Abon ikan tuna segar dengan rasa gurih dan tekstur lembut. Cocok untuk lauk nasi atau isian roti.',
                    'price' => 35000,
                    'stock' => 'in_stock',
                    'discount' => 15,
                ],
            ],
            'kerajinan-tangan' => [
                [
                    'name' => 'Tas Anyaman Pandan',
                    'description' => 'Tas cantik dari anyaman daun pandan dengan kualitas premium. Ramah lingkungan dan tahan lama.',
                    'price' => 75000,
                    'stock' => 'in_stock',
                    'discount' => 0,
                    'links' => [
                        'tokopedia' => 'https://tokopedia.com/tas-pandan',
                        'instagram' => 'https://instagram.com/kerajinan-desa',
                    ],
                ],
                [
                    'name' => 'Gelang Manik Tradisional',
                    'description' => 'Gelang manik-manik dengan motif tradisional yang indah. Cocok untuk aksesoris sehari-hari atau souvenir.',
                    'price' => 12000,
                    'stock' => 'in_stock',
                    'discount' => 20,
                ],
                [
                    'name' => 'Lukisan Kain Batik',
                    'description' => 'Lukisan batik tulis dengan motif khas daerah. Karya seni yang memiliki nilai budaya tinggi.',
                    'price' => 150000,
                    'stock' => 'preorder',
                    'discount' => 0,
                    'links' => [
                        'website' => 'https://seni-batik-desa.com',
                        'whatsapp' => '6281234567891',
                    ],
                ],
            ],
            'hasil-pertanian' => [
                [
                    'name' => 'Beras Merah Organik',
                    'description' => 'Beras merah organik berkualitas tinggi dari sawah lokal. Kaya nutrisi dan bebas pestisida.',
                    'price' => 18000,
                    'stock' => 'in_stock',
                    'discount' => 0,
                    'links' => [
                        'tokopedia' => 'https://tokopedia.com/beras-merah',
                        'shopee' => 'https://shopee.co.id/beras-organik',
                    ],
                ],
                [
                    'name' => 'Cabai Rawit Segar',
                    'description' => 'Cabai rawit segar dengan tingkat kepedasan tinggi. Dipetik langsung dari kebun untuk menjaga kesegaran.',
                    'price' => 45000,
                    'stock' => 'in_stock',
                    'discount' => 10,
                ],
                [
                    'name' => 'Jagung Manis',
                    'description' => 'Jagung manis segar dengan biji yang berisi dan rasa yang manis alami. Cocok untuk berbagai olahan.',
                    'price' => 8000,
                    'stock' => 'out_of_stock',
                    'discount' => 0,
                ],
            ],
            'minuman-herbal' => [
                [
                    'name' => 'Teh Daun Sirsak',
                    'description' => 'Teh herbal dari daun sirsak kering dengan khasiat untuk kesehatan. Membantu meningkatkan daya tahan tubuh.',
                    'price' => 20000,
                    'stock' => 'in_stock',
                    'discount' => 0,
                    'links' => [
                        'tokopedia' => 'https://tokopedia.com/teh-sirsak',
                        'whatsapp' => '6281234567892',
                    ],
                ],
                [
                    'name' => 'Jamu Kunyit Asam',
                    'description' => 'Jamu tradisional kunyit asam dengan rasa segar dan khasiat untuk pencernaan. Dibuat dari bahan alami pilihan.',
                    'price' => 15000,
                    'stock' => 'in_stock',
                    'discount' => 5,
                ],
                [
                    'name' => 'Wedang Jahe Instan',
                    'description' => 'Minuman jahe instan dengan rasa hangat dan pedas yang nikmat. Cocok untuk diminum saat cuaca dingin.',
                    'price' => 12000,
                    'stock' => 'low_stock',
                    'discount' => 15,
                ],
            ],
            'tekstil-batik' => [
                [
                    'name' => 'Kain Batik Tulis Premium',
                    'description' => 'Kain batik tulis dengan motif eksklusif dan kualitas premium. Cocok untuk baju formal atau koleksi.',
                    'price' => 250000,
                    'stock' => 'preorder',
                    'discount' => 0,
                    'links' => [
                        'website' => 'https://batik-desa-premium.com',
                        'instagram' => 'https://instagram.com/batik-desa',
                    ],
                ],
                [
                    'name' => 'Selendang Tenun Tradisional',
                    'description' => 'Selendang tenun dengan motif tradisional yang elegan. Hasil karya pengrajin lokal yang terampil.',
                    'price' => 85000,
                    'stock' => 'in_stock',
                    'discount' => 10,
                ],
            ],
        ];

        return $productsMap[$categorySlug] ?? [];
    }
}
