<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Theme;
use App\Models\ThemeContent;

class ThemeSeeder extends Seeder
{
    public function run()
    {
        $themes = [
            [
                'name' => 'Soft Theme',
                'slug' => 'soft',
                'description' => 'Theme dengan desain lembut dan gradasi warna',
            ],
            [
                'name' => 'Modern Theme',
                'slug' => 'modern',
                'description' => 'Theme dengan desain modern dan minimalis'
            ],
            [
                'name' => 'Light Theme',
                'slug' => 'light',
                'description' => 'Theme dengan desain terang dan bersih'
            ],
            [
                'name' => 'Art Theme',
                'slug' => 'art',
                'description' => 'Theme dengan desain artistik dan kreatif',
                'is_active' => true
            ]
        ];

        foreach ($themes as $themeData) {
            // Check if theme already exists by slug
            $existingTheme = Theme::where('slug', $themeData['slug'])->first();
            
            if ($existingTheme) {
                // Theme already exists, skip creation
                $this->command->info("Theme '{$themeData['name']}' already exists, skipping...");
                continue;
            }

            // Create new theme
            $theme = Theme::create($themeData);
            $this->command->info("Created theme: {$theme->name}");
            
            // Create default content for the new theme
            $contents = [
                [
                    'section' => 'hero',
                    'title' => 'Selamat Datang di Website Kami',
                    'content' => 'Kami menyediakan layanan terbaik untuk kebutuhan Anda dengan teknologi terdepan dan tim profesional.'
                ],
                [
                    'section' => 'about',
                    'title' => 'Tentang Kami',
                    'content' => 'Perusahaan yang bergerak di bidang teknologi informasi dengan pengalaman lebih dari 10 tahun.'
                ],
                [
                    'section' => 'services',
                    'title' => 'Layanan Kami',
                    'content' => 'Kami menyediakan berbagai layanan teknologi untuk membantu bisnis Anda berkembang.'
                ],
                [
                    'section' => 'products',
                    'title' => 'Produk Kami',
                    'content' => 'Berbagai produk unggulan yang telah terbukti kualitasnya dan dipercaya oleh banyak pelanggan.'
                ],
                [
                    'section' => 'contact',
                    'title' => 'Hubungi Kami',
                    'content' => 'Tim kami siap membantu Anda 24/7. Jangan ragu untuk menghubungi kami kapan saja.'
                ]
            ];

            foreach ($contents as $index => $contentData) {
                // Check if content already exists for this theme and section
                $existingContent = ThemeContent::where('theme_id', $theme->id)
                    ->where('section', $contentData['section'])
                    ->first();

                if (!$existingContent) {
                    ThemeContent::create([
                        'theme_id' => $theme->id,
                        'section' => $contentData['section'],
                        'title' => $contentData['title'],
                        'content' => $contentData['content'],
                        'order' => $index + 1,
                        'is_active' => true
                    ]);
                    $this->command->info("  - Created content: {$contentData['section']}");
                } else {
                    $this->command->info("  - Content '{$contentData['section']}' already exists, skipping...");
                }
            }
        }

        // Ensure only one theme is active at a time
        $this->ensureOnlyOneActiveTheme();
    }

    /**
     * Ensure only one theme is active
     */
    private function ensureOnlyOneActiveTheme()
    {
        $activeThemes = Theme::where('is_active', true)->get();
        
        if ($activeThemes->count() > 1) {
            // Deactivate all themes first
            Theme::query()->update(['is_active' => false]);
            
            // Activate the first one (or you can set logic to activate a specific one)
            $activeThemes->first()->update(['is_active' => true]);
            
            $this->command->info("Multiple active themes found. Set '{$activeThemes->first()->name}' as the only active theme.");
        } elseif ($activeThemes->count() === 0) {
            // No active theme, activate the first available theme
            $firstTheme = Theme::first();
            if ($firstTheme) {
                $firstTheme->update(['is_active' => true]);
                $this->command->info("No active theme found. Activated '{$firstTheme->name}' as default.");
            }
        }
    }
}