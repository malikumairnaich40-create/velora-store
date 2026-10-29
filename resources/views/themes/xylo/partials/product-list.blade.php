@php 
    $currency = activeCurrency(); 
    $symbol = $currency ? $currency->symbol : '$';
@endphp

@forelse($products as $product)
@php
    $thumb = media_url(optional($product->thumbnail)->image_url);
    $price = optional($product->primaryVariant)->converted_price ?? 'N/A';
    $discount = optional($product->primaryVariant)->converted_discount_price;
    $discPct = ($discount && is_numeric($price) && $price > 0) ? round((($price - $discount) / $price) * 100) : null;
@endphp
<div class="col-6 col-md-4 mb-4">
    <div class="group relative bg-white dark:bg-gray-800/90 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700/60 flex flex-col justify-between h-full">
        
        <!-- Product Thumbnail & Overlays -->
        <div class="relative aspect-[3/4] overflow-hidden bg-gray-100 dark:bg-gray-900">
            <img src="{{ $thumb }}" alt="{{ $product->translation->name ?? 'Product' }}" 
                 class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700">
            
            @if($discount)
                <span class="absolute top-3 left-3 bg-red-600 text-white text-[10px] font-black px-2 py-0.5 rounded-full shadow-md">
                    {{ $discPct ? "-{$discPct}%" : "SALE" }}
                </span>
            @endif

            <!-- Floating Action Icons -->
            <div class="absolute top-3 right-3 flex flex-col gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                <button type="button" onclick="toggleWishlist({{ $product->id }}, this)" 
                        class="w-8 h-8 rounded-full bg-white/95 dark:bg-gray-800/95 text-gray-700 dark:text-gray-200 shadow-md hover:bg-red-500 hover:text-white flex items-center justify-center transition-colors"
                        title="Add to Wishlist">
                    <i class="fa-regular fa-heart text-xs"></i>
                </button>
                <button type="button" onclick="openQuickView({{ $product->id }})" 
                        class="w-8 h-8 rounded-full bg-white/95 dark:bg-gray-800/95 text-gray-700 dark:text-gray-200 shadow-md hover:bg-amber-600 hover:text-white flex items-center justify-center transition-colors"
                        title="Quick View">
                    <i class="fa-regular fa-eye text-xs"></i>
                </button>
            </div>
        </div>

        <!-- Info Area -->
        <div class="p-3.5 sm:p-4 flex-1 flex flex-col justify-between space-y-3">
            <div>
                <div class="flex items-center justify-between text-[10px] text-gray-400 mb-1">
                    <span class="text-amber-600 dark:text-amber-400 font-bold uppercase tracking-wider truncate">
                        {{ optional($product->brand)->translation->name ?? 'VELORA' }}
                    </span>
                    <div class="flex items-center gap-1 text-amber-400">
                        <i class="fa-solid fa-star text-[9px]"></i>
                        <span class="text-gray-500 dark:text-gray-400 text-[10px]">4.9</span>
                    </div>
                </div>

                <h3 class="text-xs sm:text-sm font-semibold text-gray-900 dark:text-white line-clamp-2 leading-snug">
                    <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-inherit hover:text-amber-600 transition-colors">
                        {{ $product->translation->name ?? 'Luxury Fashion Piece' }}
                    </a>
                </h3>

                <!-- Price -->
                <div class="flex items-baseline gap-2 mt-2">
                    <span class="text-sm md:text-base font-bold text-gray-900 dark:text-white">
                        {{ $symbol }}{{ $discount ? $discount : $price }}
                    </span>
                    @if($discount)
                        <span class="text-xs text-gray-400 line-through">
                            {{ $symbol }}{{ $price }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Add to Cart -->
            <button type="button" onclick="addToCart({{ $product->id }})" 
                    class="w-full py-2 px-3 rounded-xl bg-gray-900 hover:bg-amber-600 dark:bg-gray-700 dark:hover:bg-amber-600 text-white text-xs font-semibold flex items-center justify-center gap-1.5 transition-colors shadow-sm">
                <i class="fa fa-shopping-bag text-xs"></i> Add to Bag
            </button>
        </div>

    </div>
</div>
@empty
<div class="col-12 py-16 text-center text-gray-400">
    <i class="fa-solid fa-magnifying-glass text-4xl mb-3 opacity-30"></i>
    <p class="text-sm">No products found matching your luxury filters.</p>
</div>
@endforelse
