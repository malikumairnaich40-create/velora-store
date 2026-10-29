@extends('themes.xylo.layouts.master')

@section('content')
@php 
    $currency = activeCurrency(); 
    $symbol = $currency ? $currency->symbol : '$';
@endphp

<!-- Breadcrumb Header -->
<div class="bg-gray-100 dark:bg-gray-900/60 border-b border-gray-200 dark:border-gray-800 py-6 transition-colors">
    <div class="container mx-auto px-4">
        <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 mb-2">
            <a href="{{ route('xylo.home') }}" class="hover:text-amber-600 transition-colors">Home</a>
            <i class="fa-solid fa-angle-right text-[10px]"></i>
            <span class="text-gray-900 dark:text-white font-semibold">Catalog & Collections</span>
        </div>
        <h1 class="font-serif text-3xl font-black text-gray-900 dark:text-white">All Luxury Collections</h1>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Discover handcrafted runway pieces, Italian bespoke suits, and fine accessories.</p>
    </div>
</div>

<section class="py-10 bg-gray-50 dark:bg-[#0b0f19] transition-colors">
    <div class="container mx-auto px-4">
        
        <!-- Mobile Filter Toggle Button -->
        <div class="lg:hidden mb-6 flex justify-between items-center">
            <button type="button" onclick="document.getElementById('filterSidebar').classList.toggle('hidden')" 
                    class="px-4 py-2.5 rounded-xl bg-amber-600 text-white font-bold text-xs flex items-center gap-2 shadow-md">
                <i class="fa-solid fa-sliders"></i> Filter Products
            </button>
            <span class="text-xs text-gray-500">{{ $products->total() }} Products Found</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Filter Sidebar -->
            <aside class="lg:col-span-3 hidden lg:block" id="filterSidebar">
                <div class="bg-white dark:bg-gray-800/90 rounded-2xl p-6 shadow-sm border border-gray-200/60 dark:border-gray-700/60 space-y-6 sticky top-28">
                    
                    <div class="flex items-center justify-between pb-4 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="font-bold text-sm text-gray-900 dark:text-white flex items-center gap-2">
                            <i class="fa-solid fa-filter text-amber-600 text-xs"></i> Filters
                        </h3>
                        <a href="{{ route('shop.index') }}" class="text-[11px] text-amber-600 hover:underline font-semibold">Reset</a>
                    </div>

                    <!-- Categories Filter -->
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-3">Categories</h4>
                        <div class="space-y-2 max-h-48 overflow-y-auto custom-scroll pr-1">
                            @foreach($categories as $category)
                            <label class="flex items-center justify-between text-xs text-gray-700 dark:text-gray-300 hover:text-amber-600 cursor-pointer">
                                <span class="flex items-center gap-2.5">
                                    <input class="filter-input rounded border-gray-300 text-amber-600 focus:ring-amber-500" 
                                           type="checkbox" name="category[]" value="{{ $category->id }}"
                                           {{ in_array($category->id, (array)request('category', [])) ? 'checked' : '' }}>
                                    <span>{{ $category->translation->name ?? $category->slug }}</span>
                                </span>
                                <span class="text-[10px] text-gray-400">({{ $category->products_count }})</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Brands Filter -->
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-700">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-3">Certified Ateliers</h4>
                        <div class="space-y-2 max-h-48 overflow-y-auto custom-scroll pr-1">
                            @foreach($brands as $brand)
                            <label class="flex items-center justify-between text-xs text-gray-700 dark:text-gray-300 hover:text-amber-600 cursor-pointer">
                                <span class="flex items-center gap-2.5">
                                    <input class="filter-input rounded border-gray-300 text-amber-600 focus:ring-amber-500" 
                                           type="checkbox" name="brand[]" value="{{ $brand->id }}"
                                           {{ in_array($brand->id, (array)request('brand', [])) ? 'checked' : '' }}>
                                    <span>{{ $brand->translation->name ?? $brand->slug }}</span>
                                </span>
                                <span class="text-[10px] text-gray-400">({{ $brand->products_count }})</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Slider -->
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-700">
                        <div class="flex justify-between items-center mb-2">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Price Range</h4>
                            <span class="text-xs font-bold text-amber-600">
                                {{ $symbol }}<span id="minPriceText">0</span> - {{ $symbol }}<span id="maxPriceText">1000</span>
                            </span>
                        </div>
                        <div class="space-y-2">
                            <input type="range" name="price_min" id="minPrice" min="0" max="1000" value="0" step="10" 
                                   class="w-full accent-amber-600 cursor-pointer">
                            <input type="range" name="price_max" id="maxPrice" min="0" max="1000" value="1000" step="10" 
                                   class="w-full accent-amber-600 cursor-pointer">
                        </div>
                    </div>

                </div>
            </aside>

            <!-- Product Grid & Pagination -->
            <main class="lg:col-span-9">
                <div class="relative min-h-[400px]">
                    <!-- Loading Overlay -->
                    <div id="filterLoading" class="absolute inset-0 bg-white/70 dark:bg-gray-900/70 backdrop-blur-xs flex items-center justify-center z-10 hidden rounded-2xl">
                        <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-amber-600"></div>
                    </div>

                    <div class="row" id="productList">
                        @include('themes.xylo.partials.product-list')
                    </div>
                </div>

                <div class="mt-8 flex justify-center">
                    {{ $products->links() }}
                </div>
            </main>

        </div>
    </div>
</section>
@endsection

@section('js')
<script>
    const minSlider = document.getElementById('minPrice');
    const maxSlider = document.getElementById('maxPrice');
    const minPriceText = document.getElementById('minPriceText');
    const maxPriceText = document.getElementById('maxPriceText');
    const loading = document.getElementById('filterLoading');

    function updatePriceDisplay() {
        if (!minSlider || !maxSlider) return;
        let minVal = parseInt(minSlider.value);
        let maxVal = parseInt(maxSlider.value);

        if (minVal > maxVal) {
            [minVal, maxVal] = [maxVal, minVal];
        }

        minPriceText.textContent = minVal;
        maxPriceText.textContent = maxVal;

        sendFilterRequest();
    }

    if (minSlider && maxSlider) {
        minSlider.addEventListener('input', updatePriceDisplay);
        maxSlider.addEventListener('input', updatePriceDisplay);
    }

    function sendFilterRequest() {
        let url = new URL("{{ route('shop.index') }}", window.location.origin);
        let params = new URLSearchParams();

        document.querySelectorAll('.filter-input:checked').forEach(checked => {
            params.append(checked.name, checked.value);
        });

        if (minSlider && maxSlider) {
            let minVal = parseInt(minSlider.value);
            let maxVal = parseInt(maxSlider.value);
            if (minVal > maxVal) [minVal, maxVal] = [maxVal, minVal];
            params.append('price_min', minVal);
            params.append('price_max', maxVal);
        }

        url.search = params.toString();

        if (loading) loading.classList.remove('hidden');

        fetch(url, {
            method: 'GET',
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById('productList').innerHTML = html;
            if (loading) loading.classList.add('hidden');
        })
        .catch(err => {
            console.error(err);
            if (loading) loading.classList.add('hidden');
        });
    }

    document.querySelectorAll('.filter-input').forEach(input => {
        input.addEventListener('change', sendFilterRequest);
    });
</script>
@endsection
