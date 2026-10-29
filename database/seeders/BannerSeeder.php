<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Language;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $languages = Language::where('active', 1)->get();

            $banners = [
                [
                    'type' => 'promotion',
                    'status' => 1,
                    'title' => 'VELORA Haute Couture 2026',
                    'description' => 'Step into ultimate luxury with our exclusive Paris runway collection. Handcrafted perfection with up to 40% OFF.',
                    'image' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?auto=format&fit=crop&w=1600&q=80',
                ],
                [
                    'type' => 'featured',
                    'status' => 1,
                    'title' => 'Urban Elegance & Bespoke Tailoring',
                    'description' => 'Redefining contemporary style for modern tastemakers. Italian wool blazers, silk tops, and statement silhouettes.',
                    'image' => 'https://images.unsplash.com/photo-1469334031218-e382a71b716b?auto=format&fit=crop&w=1600&q=80',
                ],
                [
                    'type' => 'seasonal',
                    'status' => 1,
                    'title' => 'Signature Timepieces & Fine Jewelry',
                    'description' => 'Swiss precision chronographs and 18K gold accents created to make every moment unforgettable.',
                    'image' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=1600&q=80',
                ],
            ];

            foreach ($banners as $item) {
                $banner = Banner::create([
                    'type' => $item['type'],
                    'status' => $item['status'],
                ]);

                foreach ($languages as $lang) {
                    $banner->translations()->create([
                        'language_code' => $lang->code,
                        'title' => $item['title'],
                        'description' => $item['description'],
                        'image_url' => $item['image'],
                    ]);
                }
            }
        });
    }
}
