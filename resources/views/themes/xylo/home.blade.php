@extends('themes.xylo.layouts.master')

@section('content')
@php 
    $currency = activeCurrency(); 
    $symbol = $currency ? $currency->symbol : '$';
@endphp

<!-- 1. HERO SLIDER & DARAZ-STYLE PROMO BANNER TRIO -->
<section class="pt-4 pb-8 bg-gray-100/60 dark:bg-[#0b0f19] transition-colors">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-stretch">
            
            <!-- Left 8 Cols: Main HD Fashion Hero Slider -->
            <div class="lg:col-span-8 overflow-hidden rounded-2xl shadow-xl border border-gray-200/50 dark:border-gray-800">
                <div class="hero-fashion-slider relative h-full">
                    @forelse ($banners as $banner)
                        @php
                            $imgUrl = media_url(optional($banner->translation)->image_url ?? $banner->image_url ?? 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?auto=format&fit=crop&w=1600&q=80');
                            $bTitle = $banner->translation->title ?? $banner->title ?? 'VELORA Haute Couture';
                            $bDesc = $banner->translation->description ?? 'Experience modern luxury tailored to perfection. Discover our exclusive runway collection.';
                        @endphp
                        <div class="relative h-[340px] sm:h-[420px] md:h-[480px] bg-gray-900 group">
                            <img src="{{ $imgUrl }}" alt="{{ $bTitle }}" 
                                 class="w-full h-full object-cover object-center transform group-hover:scale-105 transition-transform duration-700">
                            
                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent flex items-center">
                                <div class="max-w-lg p-6 md:p-12 text-white space-y-4">
                                    <span class="inline-block px-3 py-1 rounded-full bg-amber-500/30 backdrop-blur-md text-amber-300 font-bold uppercase text-[11px] tracking-widest border border-amber-400/40">
                                        RUNWAY COLLECTION 2026
                                    </span>
                                    <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl font-black leading-tight tracking-tight text-white drop-shadow-md">
                                        {{ $bTitle }}
                                    </h1>
                                    <p class="text-xs sm:text-sm text-gray-200/90 line-clamp-3 leading-relaxed drop-shadow">
                                        {{ $bDesc }}
                                    </p>
                                    <div class="pt-2 flex items-center gap-3">
                                        <a href="{{ route('shop.index') }}" 
                                           class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-600 to-amber-500 hover:from-amber-700 hover:to-amber-600 text-white font-bold text-xs sm:text-sm px-6 py-3 rounded-full transition-all shadow-lg shadow-amber-500/30 text-decoration-none">
                                            Shop Runway <i class="fa-solid fa-arrow-right text-xs"></i>
                                        </a>
                                        <a href="{{ route('shop.index', ['category[]' => 1]) }}" 
                                           class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 backdrop-blur-md text-white font-semibold text-xs sm:text-sm px-5 py-3 rounded-full transition-all border border-white/30 text-decoration-none">
                                            Discover Lookbook
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="relative h-[440px] bg-gray-900 flex items-center justify-center text-white">
                            <h2 class="font-serif text-3xl">VELORA Haute Couture 2026</h2>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Right 4 Cols: Daraz-Style Stacked Promo Feature Cards -->
            <div class="lg:col-span-4 flex flex-col gap-4">
                
                <!-- Promo Card 1: Flash Deals -->
                <div class="relative flex-1 rounded-2xl overflow-hidden shadow-lg border border-gray-200/50 dark:border-gray-800 group min-h-[200px]">
                    <img src="https://images.unsplash.com/photo-1543163521-1bf539c55dd2?auto=format&fit=crop&w=600&q=80" 
                         alt="Flash Sale Shoes" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-900/60 to-transparent flex flex-col justify-end p-5 text-white">
                        <div class="flex items-center gap-1.5 text-xs text-amber-400 font-bold uppercase tracking-wider mb-1">
                            <i class="fa-solid fa-bolt text-amber-400 animate-bounce"></i> Limited Time Offer
                        </div>
                        <h3 class="font-serif text-xl font-bold leading-snug">Extra 25% Off Luxury Shoes & Handbags</h3>
                        <p class="text-xs text-gray-300 mt-1">Italian calfskin boots & designer accessories.</p>
                        <a href="{{ route('shop.index', ['category[]' => 3]) }}" class="mt-3 inline-flex items-center gap-1.5 text-xs font-bold text-amber-400 hover:text-amber-300 text-decoration-none">
                            Shop Deals Now <i class="fa-solid fa-angle-right text-[10px]"></i>
                        </a>
                    </div>
                </div>

                <!-- Promo Card 2: VELORA Mall Official Guarantee -->
                <div class="relative flex-1 rounded-2xl overflow-hidden shadow-lg border border-gray-200/50 dark:border-gray-800 group min-h-[200px]">
                    <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=600&q=80" 
                         alt="Velora Mall" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-900/60 to-transparent flex flex-col justify-end p-5 text-white">
                        <span class="inline-block px-2.5 py-0.5 rounded bg-blue-600/80 text-white font-bold text-[10px] uppercase tracking-wider w-max mb-1">
                            VELORA MALL
                        </span>
                        <h3 class="font-serif text-xl font-bold leading-snug">100% Authentic Ateliers Only</h3>
                        <p class="text-xs text-gray-300 mt-1">Direct from European fashion houses with verification.</p>
                        <a href="{{ route('shop.index') }}" class="mt-3 inline-flex items-center gap-1.5 text-xs font-bold text-amber-400 hover:text-amber-300 text-decoration-none">
                            Explore Official Brands <i class="fa-solid fa-angle-right text-[10px]"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- 2. DARAZ 4-FEATURE TRUST RIBBON -->
<section class="py-6 bg-white dark:bg-[#0f172a] border-y border-gray-200/60 dark:border-gray-800/60 transition-colors">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            
            <div class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                <div class="w-12 h-12 rounded-2xl bg-amber-500/10 dark:bg-amber-500/20 text-amber-600 dark:text-amber-400 flex items-center justify-center text-xl flex-shrink-0">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <h4 class="text-xs md:text-sm font-bold text-gray-900 dark:text-white">100% Authentic</h4>
                    <p class="text-[11px] text-gray-500 dark:text-gray-400">Guaranteed designer original</p>
                </div>
            </div>

            <div class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                <div class="w-12 h-12 rounded-2xl bg-amber-500/10 dark:bg-amber-500/20 text-amber-600 dark:text-amber-400 flex items-center justify-center text-xl flex-shrink-0">
                    <i class="fa-solid fa-plane-departure"></i>
                </div>
                <div>
                    <h4 class="text-xs md:text-sm font-bold text-gray-900 dark:text-white">Express Delivery</h4>
                    <p class="text-[11px] text-gray-500 dark:text-gray-400">Free global dispatch > $150</p>
                </div>
            </div>

            <div class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                <div class="w-12 h-12 rounded-2xl bg-amber-500/10 dark:bg-amber-500/20 text-amber-600 dark:text-amber-400 flex items-center justify-center text-xl flex-shrink-0">
                    <i class="fa-solid fa-rotate-left"></i>
                </div>
                <div>
                    <h4 class="text-xs md:text-sm font-bold text-gray-900 dark:text-white">30-Day Returns</h4>
                    <p class="text-[11px] text-gray-500 dark:text-gray-400">Complimentary doorstep return</p>
                </div>
            </div>

            <div class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                <div class="w-12 h-12 rounded-2xl bg-amber-500/10 dark:bg-amber-500/20 text-amber-600 dark:text-amber-400 flex items-center justify-center text-xl flex-shrink-0">
                    <i class="fa-solid fa-crown"></i>
                </div>
                <div>
                    <h4 class="text-xs md:text-sm font-bold text-gray-900 dark:text-white">VIP Concierge</h4>
                    <p class="text-[11px] text-gray-500 dark:text-gray-400">24/7 Personal style advisor</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 3. DARAZ-STYLE FLASH SALE WITH LIVE COUNTDOWN -->
<section class="py-10 bg-gradient-to-b from-orange-50/50 to-transparent dark:from-gray-900/40 dark:to-transparent">
    <div class="container mx-auto px-4">
        
        <!-- Flash Sale Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between pb-6 gap-4 border-b border-gray-200 dark:border-gray-800">
            <div class="flex items-center gap-4 flex-wrap">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-red-500 animate-ping"></span>
                    <h2 class="text-2xl md:text-3xl font-black font-serif text-gray-900 dark:text-white flex items-center gap-2">
                        <i class="fa-solid fa-bolt text-red-500"></i> FLASH SALE
                    </h2>
                </div>
                <div class="flex items-center gap-1.5 bg-red-500/10 dark:bg-red-500/20 text-red-600 dark:text-red-400 px-3 py-1 rounded-full text-xs font-bold">
                    <span>Ending in:</span>
                    <span id="flash-timer" class="font-mono bg-red-600 text-white px-2 py-0.5 rounded text-[11px] tracking-wider">08:42:19</span>
                </div>
            </div>

            <a href="{{ route('shop.index') }}" class="text-xs font-bold text-amber-600 dark:text-amber-400 hover:text-amber-700 flex items-center gap-1 text-decoration-none uppercase tracking-wider">
                Shop All Deals <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
        </div>

        <!-- Flash Sale Product Carousel / Grid -->
        <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @foreach ($products->take(4) as $flashProd)
                @php
                    $fThumb = media_url(optional($flashProd->thumbnail)->image_url);
                    $fPrice = optional($flashProd->primaryVariant)->converted_price ?? 100;
                    $fDisc = optional($flashProd->primaryVariant)->converted_discount_price;
                    $discountPct = $fDisc ? round((($fPrice - $fDisc) / $fPrice) * 100) : 30;
                @endphp
                <div class="group relative bg-white dark:bg-gray-800/90 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700/60 flex flex-col">
                    
                    <!-- Image & Action Badges -->
                    <div class="relative aspect-square overflow-hidden bg-gray-50 dark:bg-gray-900">
                        <img src="{{ $fThumb }}" alt="{{ $flashProd->translation->name ?? 'Product' }}" 
                             class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-500">
                        
                        <!-- Discount Badge -->
                        <span class="absolute top-2.5 left-2.5 bg-red-600 text-white text-[10px] font-black px-2 py-0.5 rounded-full shadow-md">
                            -{{ $discountPct }}%
                        </span>

                        <!-- Action Icons Floating -->
                        <div class="absolute top-2.5 right-2.5 flex flex-col gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <button type="button" onclick="toggleWishlist({{ $flashProd->id }}, this)" 
                                    class="w-8 h-8 rounded-full bg-white/90 dark:bg-gray-800/90 text-gray-700 dark:text-gray-200 shadow-md hover:bg-red-500 hover:text-white flex items-center justify-center transition-colors"
                                    title="Add to Wishlist">
                                <i class="fa-regular fa-heart text-xs"></i>
                            </button>
                            <button type="button" onclick="openQuickView({{ $flashProd->id }})" 
                                    class="w-8 h-8 rounded-full bg-white/90 dark:bg-gray-800/90 text-gray-700 dark:text-gray-200 shadow-md hover:bg-amber-600 hover:text-white flex items-center justify-center transition-colors"
                                    title="Quick View">
                                <i class="fa-regular fa-eye text-xs"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="p-4 flex-1 flex flex-col justify-between space-y-3">
                        <div>
                            <span class="text-[10px] text-amber-600 dark:text-amber-400 font-bold uppercase tracking-wider block truncate">
                                {{ optional($flashProd->category)->translation->name ?? 'VELORA Luxury' }}
                            </span>
                            <h3 class="text-xs md:text-sm font-semibold text-gray-900 dark:text-white line-clamp-1 mt-0.5 hover:text-amber-600 transition-colors">
                                <a href="{{ route('product.show', $flashProd->slug) }}" class="text-decoration-none text-inherit">
                                    {{ $flashProd->translation->name ?? 'Luxury Fashion Piece' }}
                                </a>
                            </h3>
                            
                            <!-- Price Row -->
                            <div class="flex items-baseline gap-2 mt-1.5">
                                <span class="text-sm md:text-base font-bold text-red-600 dark:text-red-400">
                                    {{ $symbol }}{{ $fDisc ? $fDisc : $fPrice }}
                                </span>
                                @if($fDisc)
                                    <span class="text-xs text-gray-400 line-through">
                                        {{ $symbol }}{{ $fPrice }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Progress Bar (Daraz Style) -->
                        <div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-gradient-to-r from-red-500 to-amber-500 h-1.5 rounded-full" style="width: 78%"></div>
                            </div>
                            <span class="text-[10px] text-gray-400 block mt-1">18 sold • 6 left in stock</span>

                            <!-- Add to Cart Button -->
                            <button type="button" onclick="addToCart({{ $flashProd->id }})" 
                                    class="w-full mt-2.5 py-2 px-3 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-semibold flex items-center justify-center gap-1.5 transition-colors shadow-sm">
                                <i class="fa fa-shopping-bag text-xs"></i> Add to Bag
                            </button>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</section>

<!-- 4. DARAZ CIRCLE / CARD POPULAR CATEGORIES -->
<section class="py-10 bg-white dark:bg-[#0f172a] border-y border-gray-200/60 dark:border-gray-800/60 transition-colors">
    <div class="container mx-auto px-4">
        
        <div class="flex items-center justify-between pb-6">
            <div>
                <span class="text-xs text-amber-600 dark:text-amber-400 font-bold uppercase tracking-wider">Couture Departments</span>
                <h2 class="text-2xl md:text-3xl font-black font-serif text-gray-900 dark:text-white">Shop by Category</h2>
            </div>
            <a href="{{ route('shop.index') }}" class="text-xs font-bold text-amber-600 dark:text-amber-400 hover:text-amber-700 flex items-center gap-1 text-decoration-none">
                All Categories <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach ($categories as $cat)
                @php
                    $catImg = media_url(optional($cat->translation)->image_url);
                    $catName = $cat->translation->name ?? $cat->slug;
                @endphp
                <a href="{{ route('category.show', $cat->slug) }}" 
                   class="group flex flex-col items-center p-4 rounded-2xl bg-gray-50 dark:bg-gray-800/50 hover:bg-amber-50 dark:hover:bg-gray-800 transition-all border border-gray-100 dark:border-gray-800 text-decoration-none shadow-sm hover:shadow-md text-center">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full overflow-hidden mb-3 ring-2 ring-amber-500/20 group-hover:ring-amber-500 transition-all shadow-md">
                        <img src="{{ $catImg }}" alt="{{ $catName }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h3 class="text-xs sm:text-sm font-bold text-gray-900 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors line-clamp-1">
                        {{ $catName }}
                    </h3>
                    <span class="text-[11px] text-gray-400 mt-0.5">Explore Line</span>
                </a>
            @endforeach
        </div>

    </div>
</section>

<!-- 5. JUST FOR YOU / TRENDING LUXURY PRODUCT GRID (DARAZ STYLE) -->
<section class="py-12 bg-gray-50/50 dark:bg-[#0b0f19] transition-colors">
    <div class="container mx-auto px-4">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between pb-8 gap-4">
            <div>
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-0.5 rounded-full bg-amber-500/10 text-amber-600 dark:text-amber-400 text-xs font-bold uppercase tracking-wider">
                        Curated Showcase
                    </span>
                </div>
                <h2 class="text-2xl md:text-3xl font-black font-serif text-gray-900 dark:text-white mt-1">
                    Trending Runway & Bespoke Collections
                </h2>
                <p class="text-xs md:text-sm text-gray-500 dark:text-gray-400 mt-1 max-w-xl">
                    Discover handpicked Italian suits, silk evening wear, Swiss timepieces, and artisan footwear.
                </p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('shop.index') }}" class="px-5 py-2.5 rounded-xl bg-gray-900 text-white dark:bg-white dark:text-gray-900 font-bold text-xs hover:bg-amber-600 dark:hover:bg-amber-500 transition-colors text-decoration-none shadow">
                    View Complete Catalog ({{ $products->count() }}+ Items)
                </a>
            </div>
        </div>

        <!-- 12-Product Responsive Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            @foreach ($products as $product)
                @php
                    $prodThumb = media_url(optional($product->thumbnail)->image_url);
                    $prodPrice = optional($product->primaryVariant)->converted_price ?? 'N/A';
                    $prodDisc = optional($product->primaryVariant)->converted_discount_price;
                @endphp
                <div class="group relative bg-white dark:bg-gray-800/90 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700/60 flex flex-col justify-between">
                    
                    <!-- Product Image & Overlays -->
                    <div class="relative aspect-[3/4] overflow-hidden bg-gray-100 dark:bg-gray-900">
                        <img src="{{ $prodThumb }}" alt="{{ $product->translation->name ?? 'Product' }}" 
                             class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700">
                        
                        @if($prodDisc)
                            <span class="absolute top-3 left-3 bg-red-600 text-white text-[10px] font-black px-2 py-0.5 rounded-full shadow-md">
                                SALE
                            </span>
                        @endif

                        <!-- Action Icons on Hover -->
                        <div class="absolute top-3 right-3 flex flex-col gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <!-- Wishlist Toggle -->
                            <button type="button" onclick="toggleWishlist({{ $product->id }}, this)" 
                                    class="w-9 h-9 rounded-full bg-white/90 dark:bg-gray-800/90 text-gray-700 dark:text-gray-200 shadow-md hover:bg-red-500 hover:text-white flex items-center justify-center transition-colors"
                                    title="Save to Wishlist">
                                <i class="fa-regular fa-heart text-sm"></i>
                            </button>
                            <!-- Quick View Modal Opener -->
                            <button type="button" onclick="openQuickView({{ $product->id }})" 
                                    class="w-9 h-9 rounded-full bg-white/90 dark:bg-gray-800/90 text-gray-700 dark:text-gray-200 shadow-md hover:bg-amber-600 hover:text-white flex items-center justify-center transition-colors"
                                    title="Quick Preview">
                                <i class="fa-regular fa-eye text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Details Area -->
                    <div class="p-4 flex-1 flex flex-col justify-between space-y-3">
                        <div>
                            <div class="flex items-center justify-between text-[11px] text-gray-400 mb-1">
                                <span class="text-amber-600 dark:text-amber-400 font-bold uppercase tracking-wider truncate">
                                    {{ optional($product->brand)->translation->name ?? 'VELORA' }}
                                </span>
                                <div class="flex items-center gap-1 text-amber-400">
                                    <i class="fa-solid fa-star text-[10px]"></i>
                                    <span class="text-gray-500 dark:text-gray-400 text-[10px]">4.9</span>
                                </div>
                            </div>

                            <h3 class="text-xs sm:text-sm font-semibold text-gray-900 dark:text-white line-clamp-2 leading-snug">
                                <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-inherit hover:text-amber-600 transition-colors">
                                    {{ $product->translation->name ?? 'Luxury Masterpiece' }}
                                </a>
                            </h3>

                            <!-- Price -->
                            <div class="flex items-baseline gap-2 mt-2">
                                <span class="text-sm md:text-base font-bold text-gray-900 dark:text-white">
                                    {{ $symbol }}{{ $prodDisc ? $prodDisc : $prodPrice }}
                                </span>
                                @if($prodDisc)
                                    <span class="text-xs text-gray-400 line-through">
                                        {{ $symbol }}{{ $prodPrice }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Add to Cart Button -->
                        <button type="button" onclick="addToCart({{ $product->id }})" 
                                class="w-full py-2.5 px-3 rounded-xl bg-gray-900 hover:bg-amber-600 dark:bg-gray-700 dark:hover:bg-amber-600 text-white text-xs font-semibold flex items-center justify-center gap-2 transition-colors shadow-sm">
                            <i class="fa fa-shopping-bag text-xs"></i> Add to Bag
                        </button>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</section>

<!-- 6. HIGH-FASHION EDITORIAL CAMPAIGN BANNER -->
<section class="py-12 bg-white dark:bg-[#0f172a] transition-colors">
    <div class="container mx-auto px-4">
        <div class="relative rounded-3xl overflow-hidden shadow-2xl bg-gray-900 border border-gray-800">
            <div class="grid grid-cols-1 lg:grid-cols-2 items-center">
                
                <!-- Text / Manifesto -->
                <div class="p-8 md:p-14 lg:p-16 space-y-5 text-white z-10">
                    <span class="inline-block px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 font-bold uppercase text-[11px] tracking-widest border border-amber-500/30">
                        Atelier Craftsmanship
                    </span>
                    <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-black leading-tight">
                        The Art of Timeless Tailoring
                    </h2>
                    <p class="text-sm text-gray-300 leading-relaxed max-w-lg">
                        "Elegance is not about being noticed, it's about being remembered." Every piece in the VELORA collection is woven from responsibly sourced natural fibers, hand-finished by master artisans, and made to last generations.
                    </p>
                    <div class="pt-2 flex items-center gap-4">
                        <a href="{{ route('shop.index') }}" class="bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs sm:text-sm px-7 py-3 rounded-full transition-all shadow-lg shadow-amber-500/30 text-decoration-none">
                            Discover The Collection
                        </a>
                    </div>
                </div>

                <!-- Model Image -->
                <div class="h-72 sm:h-96 lg:h-[460px] relative">
                    <img src="https://images.unsplash.com/photo-1509631179647-0177331693ae?auto=format&fit=crop&w=1200&q=80" 
                         alt="VELORA Atelier" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t lg:bg-gradient-to-r from-gray-900 via-transparent to-transparent"></div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- 7. OFFICIAL LUXURY BRANDS (DARAZ MALL STYLE) -->
<section class="py-10 bg-gray-50 dark:bg-[#0b0f19] border-t border-gray-200/60 dark:border-gray-800/60 transition-colors">
    <div class="container mx-auto px-4">
        
        <div class="flex items-center justify-between pb-6">
            <div>
                <span class="text-xs text-amber-600 dark:text-amber-400 font-bold uppercase tracking-wider">Certified Ateliers</span>
                <h2 class="text-xl md:text-2xl font-bold font-serif text-gray-900 dark:text-white">Official Brand Partners</h2>
            </div>
            <span class="text-xs text-gray-400">100% Guaranteed Official</span>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="p-5 rounded-2xl bg-white dark:bg-gray-800/80 border border-gray-200/50 dark:border-gray-700 flex flex-col items-center justify-center text-center shadow-sm">
                <span class="font-serif font-black text-xl tracking-widest text-amber-600">VELORA</span>
                <span class="text-[11px] text-gray-400 mt-1">Couture Flagship</span>
            </div>
            <div class="p-5 rounded-2xl bg-white dark:bg-gray-800/80 border border-gray-200/50 dark:border-gray-700 flex flex-col items-center justify-center text-center shadow-sm">
                <span class="font-serif font-bold text-lg tracking-wider text-gray-900 dark:text-white">MILANO TAILORS</span>
                <span class="text-[11px] text-gray-400 mt-1">Italian Bespoke Suiting</span>
            </div>
            <div class="p-5 rounded-2xl bg-white dark:bg-gray-800/80 border border-gray-200/50 dark:border-gray-700 flex flex-col items-center justify-center text-center shadow-sm">
                <span class="font-serif font-bold text-lg tracking-wider text-gray-900 dark:text-white">GENÈVE HORLOGERIE</span>
                <span class="text-[11px] text-gray-400 mt-1">Swiss Precision Time</span>
            </div>
            <div class="p-5 rounded-2xl bg-white dark:bg-gray-800/80 border border-gray-200/50 dark:border-gray-700 flex flex-col items-center justify-center text-center shadow-sm">
                <span class="font-serif font-bold text-lg tracking-wider text-gray-900 dark:text-white">ATELIER PARIS</span>
                <span class="text-[11px] text-gray-400 mt-1">Handcrafted Leather</span>
            </div>
        </div>

    </div>
</section>

@endsection

@section('js')
<script>
    // Hero Slider Initialization with Slick
    $(document).ready(function () {
        if ($('.hero-fashion-slider').length) {
            $('.hero-fashion-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 4500,
                fade: true,
                speed: 700,
                cssEase: 'cubic-bezier(0.16, 1, 0.3, 1)',
                arrows: false,
                dots: true,
            });
        }

        // Live Flash Sale Countdown Timer
        let totalSeconds = 8 * 3600 + 42 * 60 + 19;
        setInterval(() => {
            if (totalSeconds > 0) {
                totalSeconds--;
                let h = Math.floor(totalSeconds / 3600);
                let m = Math.floor((totalSeconds % 3600) / 60);
                let s = totalSeconds % 60;
                let fmt = `${String(h).padStart(2, '0')}:${String(m).padStart(2, '0')}:${String(s).padStart(2, '0')}`;
                $('#flash-timer').text(fmt);
            }
        }, 1000);
    });
</script>
@endsection
