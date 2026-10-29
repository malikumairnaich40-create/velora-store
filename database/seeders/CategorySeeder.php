<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Language;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $languages = Language::where('active', 1)->pluck('code')->toArray();

            $categories = [
                [
                    'slug' => 'womens-luxury',
                    'parent_slug' => null,
                    'name' => "Women's Luxury",
                    'description' => 'Designer gowns, silk dresses, and runway couture.',
                    'image' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=600&q=80',
                ],
                [
                    'slug' => 'mens-couture',
                    'parent_slug' => null,
                    'name' => "Men's Couture",
                    'description' => 'Tailored suits, velvet blazers, and premium streetwear.',
                    'image' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=600&q=80',
                ],
                [
                    'slug' => 'footwear-shoes',
                    'parent_slug' => null,
                    'name' => 'Designer Footwear',
                    'description' => 'Chelsea boots, Italian leather loafers, and stilettos.',
                    'image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?auto=format&fit=crop&w=600&q=80',
                ],
                [
                    'slug' => 'watches-jewelry',
                    'parent_slug' => null,
                    'name' => 'Watches & Jewelry',
                    'description' => 'Swiss chronographs, gold bracelets, and fine gemstones.',
                    'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=600&q=80',
                ],
                [
                    'slug' => 'bags-leather',
                    'parent_slug' => null,
                    'name' => 'Bags & Leather',
                    'description' => 'Handcrafted totes, clutches, and luxury backpacks.',
                    'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?auto=format&fit=crop&w=600&q=80',
                ],
                [
                    'slug' => 'accessories-eyewear',
                    'parent_slug' => null,
                    'name' => 'Accessories & Eyewear',
                    'description' => 'Polarized sunglasses, silk scarves, and leather belts.',
                    'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?auto=format&fit=crop&w=600&q=80',
                ],
            ];

            foreach ($categories as $categoryData) {
                $category = Category::updateOrCreate(
                    ['slug' => $categoryData['slug']],
                    [
                        'parent_category_id' => null,
                        'status' => true,
                    ]
                );

                $imageUrl = $categoryData['image'];

                foreach ($languages as $lang) {
                    $category->translations()->updateOrCreate(
                        ['language_code' => $lang],
                        [
                            'name' => $categoryData['name'],
                            'description' => $categoryData['description'],
                            'image_url' => $imageUrl,
                        ]
                    );
                }
            }
        });
    }
}
