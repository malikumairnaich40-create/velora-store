<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Language;
use App\Models\Product;
use App\Models\ProductAttributeValue;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $languages = Language::where('active', 1)->get();

            $sizeAttr = Attribute::firstOrCreate(['name' => 'Size']);
            $colorAttr = Attribute::firstOrCreate(['name' => 'Color']);

            $sizes = ['Small', 'Medium', 'Large', 'XL'];
            $colors = ['Classic Black', 'Pure White', 'Emerald Green', 'Royal Navy', 'Champagne Gold'];

            foreach ($sizes as $size) {
                $attrValue = AttributeValue::firstOrCreate([
                    'attribute_id' => $sizeAttr->id,
                    'value' => $size,
                ]);

                foreach ($languages as $lang) {
                    $attrValue->translations()->firstOrCreate([
                        'language_code' => $lang->code,
                    ], [
                        'translated_value' => $size,
                    ]);
                }
            }

            foreach ($colors as $color) {
                $attrValue = AttributeValue::firstOrCreate([
                    'attribute_id' => $colorAttr->id,
                    'value' => $color,
                ]);

                foreach ($languages as $lang) {
                    $attrValue->translations()->firstOrCreate([
                        'language_code' => $lang->code,
                    ], [
                        'translated_value' => $color,
                    ]);
                }
            }

            $vendor = Vendor::first();
            $brands = Brand::all();
            $categories = Category::all();

            $products = [
                [
                    'name' => 'Velora Silk Evening Gown',
                    'slug' => 'velora-silk-evening-gown',
                    'category_slug' => 'womens-luxury',
                    'price' => 280,
                    'discount_price' => 195,
                    'image' => 'https://images.unsplash.com/photo-1539109136881-3be0616acf4b?auto=format&fit=crop&w=800&q=80',
                    'description' => 'A breathtaking floor-length silk evening gown tailored for red carpets and high-society galas. Features delicate hand-pleated detailing and a flattering modern silhouette.',
                ],
                [
                    'name' => 'Italian Tailored Slim Fit Suit',
                    'slug' => 'italian-tailored-suit',
                    'category_slug' => 'mens-couture',
                    'price' => 450,
                    'discount_price' => 320,
                    'image' => 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?auto=format&fit=crop&w=800&q=80',
                    'description' => 'Exquisitely crafted in Biella, Italy using Super 130s virgin wool. Features notched lapels, horn buttons, and a tapered slim silhouette that commands authority.',
                ],
                [
                    'name' => 'Artisan Leather Chelsea Boots',
                    'slug' => 'leather-chelsea-boots',
                    'category_slug' => 'footwear-shoes',
                    'price' => 180,
                    'discount_price' => 135,
                    'image' => 'https://images.unsplash.com/photo-1638247025967-b4e38f787b76?auto=format&fit=crop&w=800&q=80',
                    'description' => 'Handcrafted Goodyear-welted Chelsea boots in rich burnished calfskin leather with elasticated side gussets and stacked leather heels.',
                ],
                [
                    'name' => 'Imperial Chronograph Gold Watch',
                    'slug' => 'chronograph-gold-watch',
                    'category_slug' => 'watches-jewelry',
                    'price' => 620,
                    'discount_price' => 480,
                    'image' => 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=800&q=80',
                    'description' => 'Swiss-movement luxury chronograph featuring a 42mm 18K gold-plated case, sapphire crystal glass, and a genuine alligator leather strap.',
                ],
                [
                    'name' => 'Atelier French Leather Tote Bag',
                    'slug' => 'artisan-leather-tote',
                    'category_slug' => 'bags-leather',
                    'price' => 240,
                    'discount_price' => 179,
                    'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?auto=format&fit=crop&w=800&q=80',
                    'description' => 'A spacious everyday tote crafted from supple full-grain pebbled leather with gold-tone hardware, interior zip compartments, and comfortable shoulder drop.',
                ],
                [
                    'name' => 'Milano Polarized Aviator Sunglasses',
                    'slug' => 'polarized-aviator-sunglasses',
                    'category_slug' => 'accessories-eyewear',
                    'price' => 120,
                    'discount_price' => 89,
                    'image' => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=800&q=80',
                    'description' => 'Iconic double-bridge aviator sunglasses engineered with ultra-lightweight titanium frames and Category 3 100% UV400 polarized gradient lenses.',
                ],
                [
                    'name' => 'Bespoke Cashmere Wool Overcoat',
                    'slug' => 'cashmere-wool-overcoat',
                    'category_slug' => 'mens-couture',
                    'price' => 390,
                    'discount_price' => 299,
                    'image' => 'https://images.unsplash.com/photo-1544441893-675973e31985?auto=format&fit=crop&w=800&q=80',
                    'description' => 'Luxuriously soft double-breasted overcoat woven with 80% virgin wool and 20% Mongolian cashmere. Designed to keep you warm with refined sartorial flair.',
                ],
                [
                    'name' => 'Parisian Chiffon Floral Maxi Dress',
                    'slug' => 'parisian-floral-dress',
                    'category_slug' => 'womens-luxury',
                    'price' => 165,
                    'discount_price' => 119,
                    'image' => 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?auto=format&fit=crop&w=800&q=80',
                    'description' => 'Romantic tiered floral maxi dress crafted from breathable lightweight silk-chiffon with a cinched waistband and gentle flutter sleeves.',
                ],
                [
                    'name' => 'Monaco Midnight Velvet Blazer',
                    'slug' => 'classic-velvet-blazer',
                    'category_slug' => 'mens-couture',
                    'price' => 260,
                    'discount_price' => 185,
                    'image' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=800&q=80',
                    'description' => 'A statement dinner jacket tailored in plush midnight blue velvet with satin shawl lapels and a full silk-blend lining.',
                ],
                [
                    'name' => 'Hand-Stitched Suede Derby Loafers',
                    'slug' => 'suede-derby-loafers',
                    'category_slug' => 'footwear-shoes',
                    'price' => 195,
                    'discount_price' => 145,
                    'image' => 'https://images.unsplash.com/photo-1533867617858-e7b97e060509?auto=format&fit=crop&w=800&q=80',
                    'description' => 'Slip-on penny loafers in water-resistant Italian calf suede with cushioned memory-foam footbeds and flexible rubber-injected soles.',
                ],
                [
                    'name' => 'Pavé Diamond Rose Gold Bracelet',
                    'slug' => 'diamond-rose-gold-bracelet',
                    'category_slug' => 'watches-jewelry',
                    'price' => 350,
                    'discount_price' => 265,
                    'image' => 'https://images.unsplash.com/photo-1639065643006-e217c4fee12e?auto=format&fit=crop&w=800&q=80',
                    'description' => 'An opulent 18K rose gold bangle encrusted with micro-pavé conflict-free lab diamonds and a secure concealed push-clasp.',
                ],
                [
                    'name' => 'VELORA Signature Heavyweight Hoodie',
                    'slug' => 'urban-minimalist-hoodie',
                    'category_slug' => 'mens-couture',
                    'price' => 110,
                    'discount_price' => 79,
                    'image' => 'https://images.unsplash.com/photo-1556905055-8f358a7a47b2?auto=format&fit=crop&w=800&q=80',
                    'description' => 'Ultra-dense 480 GSM French terry cotton hoodie featuring drop shoulders, tonal embossed VELORA logo, and double-layered thermal hood.',
                ],
            ];

            foreach ($products as $idx => $item) {
                $category = $categories->firstWhere('slug', $item['category_slug']) ?? $categories->first();
                $brand = $brands->random() ?? $brands->first();

                $product = Product::create([
                    'shop_id' => 1,
                    'vendor_id' => $vendor->id,
                    'slug' => $item['slug'],
                    'category_id' => $category ? $category->id : 1,
                    'brand_id' => $brand ? $brand->id : null,
                    'product_type' => 'variable',
                    'status' => 1,
                ]);

                foreach ($languages as $lang) {
                    $product->translations()->create([
                        'language_code' => $lang->code,
                        'name' => $item['name'],
                        'description' => $item['description'],
                    ]);
                }

                // Main Thumbnail and Gallery Image
                $product->images()->create([
                    'name' => $item['slug'],
                    'image_url' => $item['image'],
                    'type' => 'thumb',
                ]);

                // Create primary variant
                $primaryVariant = $product->variants()->create([
                    'variant_slug' => Str::slug($item['name']).'-primary-'.uniqid(),
                    'price' => $item['price'],
                    'discount_price' => $item['discount_price'],
                    'stock' => 150,
                    'SKU' => 'VEL-'.strtoupper(substr($item['slug'], 0, 4)).'-'.rand(100, 999),
                    'barcode' => null,
                    'weight' => '0.5',
                    'dimensions' => '15x15x5 cm',
                    'is_primary' => 1,
                ]);

                foreach ($languages as $lang) {
                    $primaryVariant->translations()->create([
                        'language_code' => $lang->code,
                        'name' => "Standard Edition",
                    ]);
                }

                // Add size and color options
                $selectedSizes = AttributeValue::where('attribute_id', $sizeAttr->id)->take(3)->get();
                $selectedColors = AttributeValue::where('attribute_id', $colorAttr->id)->take(3)->get();

                foreach ($selectedSizes as $size) {
                    foreach ($selectedColors as $color) {
                        ProductAttributeValue::firstOrCreate([
                            'product_id' => $product->id,
                            'attribute_value_id' => $size->id,
                        ]);
                        ProductAttributeValue::firstOrCreate([
                            'product_id' => $product->id,
                            'attribute_value_id' => $color->id,
                        ]);

                        DB::table('product_variant_attribute_values')->insert([
                            'product_id' => $product->id,
                            'product_variant_id' => $primaryVariant->id,
                            'attribute_value_id' => $size->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        });
    }
}
