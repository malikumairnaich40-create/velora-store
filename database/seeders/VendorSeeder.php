<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\StoreSetting;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        $seller = Vendor::firstOrCreate(
            ['email' => 'seller@example.com'],
            [
                'name' => 'Seller',
                'email' => 'seller@example.com',
                'password' => Hash::make('abc123'),
                'phone' => '+923001234567',
                'profile_image' => 'https://i.postimg.cc/FHxQs4Br/images-10.jpg',
            ]
        );

        Shop::firstOrCreate(
            ['name' => 'Soft Shoes'],
            [
                'vendor_id' => $seller->id,
                'name' => 'Soft Shoes',
                'logo' => 'N/A',
                'description' => 'Luxurious comfort in every step. Crafted with premium materials for a soft, stylish, and effortless walking experience.',
            ]
        );

        $storeSettings = [
            ['key' => 'default_currency', 'value' => 'USD'],
            ['key' => 'meta_title', 'value' => 'Welcome to Velstore - Your Laravel eCommerce Journey Begins!'],
            ['key' => 'meta_description', 'value' => 'Welcome to Velstore! You have successfully installed the ultimate Laravel eCommerce boilerplate. Set up your store, configure settings, and start selling with a powerful multi-vendor, multilingual platform.'],
            ['key' => 'phone_number', 'value' => '+1 234 567 890'],
        ];

        foreach ($storeSettings as $setting) {
            StoreSetting::firstOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
