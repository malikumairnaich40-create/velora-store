<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $languages = Language::where('active', 1)->get();

        $brands = [
            [
                'slug' => 'velora-couture',
                'name' => 'VELORA Couture',
                'description' => 'Flagship luxury collection defined by timeless elegance and bespoke tailoring.',
                'logo_url' => 'https://images.unsplash.com/photo-1544441893-675973e31985?auto=format&fit=crop&w=300&q=80',
            ],
            [
                'slug' => 'milan-tailoring',
                'name' => 'Milano Tailors',
                'description' => 'Fine Italian suits and handcrafted formal outerwear.',
                'logo_url' => 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?auto=format&fit=crop&w=300&q=80',
            ],
            [
                'slug' => 'geneva-time',
                'name' => 'Genève Horlogerie',
                'description' => 'Swiss precision chronographs and luxury diamond timepieces.',
                'logo_url' => 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=300&q=80',
            ],
            [
                'slug' => 'parisian-leather',
                'name' => 'Atelier Paris',
                'description' => 'Handcrafted full-grain leather bags and artisan footwear.',
                'logo_url' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?auto=format&fit=crop&w=300&q=80',
            ],
        ];

        foreach ($brands as $brand) {
            $brandId = DB::table('brands')->insertGetId([
                'slug' => $brand['slug'],
                'logo_url' => $brand['logo_url'],
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($languages as $lang) {
                DB::table('brand_translations')->insert([
                    'brand_id' => $brandId,
                    'locale' => $lang->code,
                    'name' => $brand['name'],
                    'description' => $brand['description'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
