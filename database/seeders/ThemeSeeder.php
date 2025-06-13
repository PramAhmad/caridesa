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
                'is_active' => true
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
                'description' => 'Theme dengan desain artistik dan kreatif'
            ]
        ];

        foreach ($themes as $themeData) {
            $theme = Theme::create($themeData);
            
            // Create default content for each theme
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
                ]
            ];

            foreach ($contents as $index => $contentData) {
                ThemeContent::create([
                    'theme_id' => $theme->id,
                    'section' => $contentData['section'],
                    'title' => $contentData['title'],
                    'content' => $contentData['content'],
                    'order' => $index + 1,
                    'is_active' => true
                ]);
            }
        }
    }
}