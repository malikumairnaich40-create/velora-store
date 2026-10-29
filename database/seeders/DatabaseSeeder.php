<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            VendorSeeder::class,
            LanguageSeeder::class,
            CurrencySeeder::class,
            MenuSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            BannerSeeder::class,
            PaymentGatewaySeeder::class,
            OrderSeeder::class,
            PaymentSeeder::class,
            RefundSeeder::class,
        ]);
    }
}
