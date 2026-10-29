<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /*public function show($slug)
    {
        $product = Product::where('slug', $slug)
        ->with(['translation', 'thumbnail', 'reviews'])
        ->withCount('reviews')
        ->withAvg('reviews', 'rating')
        ->firstOrFail();
        return view('themes.xylo.product-detail', compact('product'));
    }*/

    public function show($slug)
    {
        $product = Product::with([
            'attributeValues.attribute',
            'attributeValues.translations',
            'translations',
            'reviews',
            'primaryVariant',
            'variants.attributeValues',
            'images',
            'category.translation',
            'category.parent.translation',
        ])->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->where('slug', $slug)
            ->firstOrFail();

        $primaryVariant = $product->variants()->where('is_primary', true)->first();
        $inStock = $primaryVariant && $primaryVariant->stock > 0;

        $variantMap = $product->variants->map(function ($variant) {
            return [
                'id' => $variant->id,
                'attributes' => $variant->attributeValues->pluck('id')->sort()->values()->toArray(),
            ];
        });

        $breadcrumbs = [];
        $category = $product->category;

        while ($category) {
            $breadcrumbs[] = $category;
            $category = $category->parent;
        }

        $breadcrumbs = array_reverse($breadcrumbs);

        return view('themes.xylo.product-detail', compact('product', 'inStock', 'variantMap', 'breadcrumbs'));
    }

    public function getVariantPrice(Request $request)
    {
        $variantId = $request->input('variant_id');
        $productId = $request->input('product_id');
        $variant = ProductVariant::with('product')
            ->where('id', $variantId)
            ->where('product_id', $productId)
            ->first();

        if ($variant) {
            $stockStatus = $variant->stock > 0 ? __('store.product_detail.in_stock') : 'OUT OF STOCK';
            $isOutOfStock = $variant->stock <= 0;

            return response()->json([
                'success' => true,
                'price' => number_format($variant->converted_price, 2),
                'stock' => $stockStatus,
                'is_out_of_stock' => $isOutOfStock,
                'currency_symbol' => activeCurrency()->symbol,
            ]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function quickView($id)
    {
        $product = Product::with([
            'translation',
            'translations',
            'attributeValues.attribute',
            'attributeValues.translations',
            'primaryVariant',
            'variants.attributeValues',
            'images',
            'category.translation',
            'brand.translation',
            'thumbnail'
        ])->withAvg('reviews', 'rating')
          ->withCount('reviews')
          ->findOrFail($id);

        $currency = activeCurrency();
        $primaryImg = media_url(optional($product->thumbnail)->image_url);

        return response()->json([
            'id' => $product->id,
            'name' => $product->translation->name ?? 'VELORA Luxury Item',
            'slug' => $product->slug,
            'description' => strip_tags($product->translation->description ?? ''),
            'category' => $product->category->translation->name ?? 'Fashion',
            'brand' => $product->brand->translation->name ?? 'VELORA',
            'image' => $primaryImg,
            'images' => $product->images->isNotEmpty() ? $product->images->map(fn($img) => media_url($img->image_url)) : [$primaryImg],
            'price' => optional($product->primaryVariant)->converted_price ?? '0.00',
            'discount_price' => optional($product->primaryVariant)->converted_discount_price,
            'currency_symbol' => $currency ? $currency->symbol : '$',
            'rating' => round($product->reviews_avg_rating ?? 5, 1),
            'reviews_count' => $product->reviews_count ?? 0,
            'in_stock' => (optional($product->primaryVariant)->stock ?? 1) > 0,
            'attributes' => $product->attributeValues->groupBy(function($item) {
                return $item->attribute->name ?? 'Option';
            })->map(function($group) {
                return $group->map(function($av) {
                    return [
                        'id' => $av->id,
                        'value' => $av->translated_value ?? $av->value,
                    ];
                });
            }),
        ]);
    }
}
