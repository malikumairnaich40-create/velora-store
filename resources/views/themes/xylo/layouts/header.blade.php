<header class="sticky top-0 z-40 bg-white/95 dark:bg-[#0f172a]/95 backdrop-blur-md shadow-sm border-b border-gray-200/80 dark:border-gray-800/80 transition-colors">

    {{-- Wishlist Count Calculation --}}
    @php
        $wishlistCount = 0;
        if (auth('customer')->check()) {
            $wishlistCount = auth('customer')->user()->wishlistProducts()->count();
        } else {
            $wishlistCount = count(session('guest_wishlist', []));
        }
        $currency = activeCurrency();
    @endphp

    <!-- Top Notice Bar (Daraz Luxury Style) -->
    <div class="bg-gradient-to-r from-gray-900 via-amber-950 to-gray-900 text-amber-200/90 text-xs py-2 px-4 border-b border-amber-900/30">
        <div class="container mx-auto flex justify-between items-center flex-wrap gap-2">
            <div class="flex items-center gap-2 font-medium tracking-wide">
                <span class="inline-block px-2 py-0.5 rounded bg-amber-500/20 text-amber-300 font-semibold uppercase text-[10px] tracking-wider border border-amber-500/30">VIP Privilege</span>
                <span class="hidden sm:inline">✨ VELORA GRAND LAUNCH • 100% AUTHENTIC DESIGNER GUARANTEE • FREE EXPRESS DISPATCH OVER $150</span>
                <span class="sm:hidden">✨ 100% AUTHENTIC LUXURY • FREE SHIPPING OVER $150</span>
            </div>
            
            <div class="flex items-center gap-4 text-xs">
                <!-- Dark / Light Mode Switcher -->
                <button type="button" onclick="toggleDarkMode()" class="flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-white/10 hover:bg-white/20 text-white font-medium transition-colors" title="Toggle Theme">
                    <i class="fa-solid fa-moon theme-toggle-icon text-xs text-amber-300"></i>
                    <span class="text-[11px]">Mode</span>
                </button>

                <!-- Language Selector -->
                <form action="{{ route('change.store.language') }}" method="POST" class="m-0">
                    @csrf
                    <select name="lang" class="bg-black/30 text-amber-200 text-xs rounded border border-amber-800/50 py-0.5 px-2 focus:outline-none cursor-pointer" onchange="this.form.submit()">
                        <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>EN</option>
                        <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>FR</option>
                        <option value="es" {{ app()->getLocale() == 'es' ? 'selected' : '' }}>ES</option>
                        <option value="de" {{ app()->getLocale() == 'de' ? 'selected' : '' }}>DE</option>
                    </select>
                </form>

                <!-- Currency Selector -->
                <form action="{{ route('change.currency') }}" method="POST" class="m-0">
                    @csrf
                    <select name="currency_code" class="bg-black/30 text-amber-200 text-xs rounded border border-amber-800/50 py-0.5 px-2 focus:outline-none cursor-pointer" onchange="this.form.submit()">
                        @foreach (\App\Models\Currency::all() as $cur)
                            <option value="{{ $cur->code }}" {{ session('currency', 'USD') == $cur->code ? 'selected' : '' }}>
                                {{ strtoupper($cur->code) }} ({{ $cur->symbol }})
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar (Daraz E-Commerce Grid) -->
    <div class="container mx-auto px-4 py-3">
        <div class="flex items-center justify-between gap-4 md:gap-8">
            
            <!-- Brand Logo -->
            <a href="{{ route('xylo.home') }}" class="flex items-center gap-2 text-decoration-none group flex-shrink-0">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-700 via-amber-500 to-amber-300 flex items-center justify-center text-white shadow-md shadow-amber-500/20 group-hover:scale-105 transition-transform">
                    <span class="font-serif font-bold text-xl tracking-tighter">V</span>
                </div>
                <div>
                    <span class="font-serif font-black text-2xl tracking-widest text-gray-900 dark:text-white uppercase">VELORA</span>
                    <span class="block text-[9px] tracking-[0.25em] font-semibold text-amber-600 dark:text-amber-400 uppercase -mt-1">PREMIUM STORE</span>
                </div>
            </a>

            <!-- Daraz-Style Wide Search Bar -->
            <div class="flex-1 max-w-2xl hidden md:block">
                <form action="{{ url('/search') }}" method="GET" class="relative m-0">
                    <div class="flex rounded-full overflow-hidden border-2 border-amber-500/60 dark:border-amber-500/40 focus-within:border-amber-500 bg-gray-50 dark:bg-gray-800 shadow-inner">
                        <div class="px-4 py-2.5 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 text-xs font-semibold border-r border-gray-200 dark:border-gray-700 flex items-center gap-1.5 flex-shrink-0">
                            <span>All Luxury</span>
                            <i class="fa-solid fa-angle-down text-[10px] text-gray-400"></i>
                        </div>
                        <input type="text" id="search-input" name="q" 
                               placeholder="Search runway gowns, Italian suits, luxury footwear, chronographs..." 
                               class="w-full bg-transparent px-4 py-2 text-sm text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none">
                        <button type="submit" class="bg-gradient-to-r from-amber-600 to-amber-500 hover:from-amber-700 hover:to-amber-600 text-white px-6 font-semibold flex items-center justify-center transition-all">
                            <i class="fa fa-search text-sm"></i>
                        </button>
                    </div>
                    <div id="search-suggestions" class="absolute left-0 right-0 top-full mt-2 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden z-50 d-none"></div>
                </form>
            </div>

            <!-- Quick Action Icons -->
            <div class="flex items-center gap-3 md:gap-5">
                
                <!-- Wishlist Icon -->
                <a href="{{ auth('customer')->check() ? route('customer.wishlist.index') : 'javascript:void(0)' }}" 
                   onclick="{{ !auth('customer')->check() ? 'toastr.info(\'Wishlist items are saved in your current session.\')' : '' }}"
                   class="relative p-2 rounded-xl text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors text-decoration-none" 
                   title="My Wishlist">
                    <i class="fa-regular fa-heart text-xl text-gray-700 dark:text-gray-200"></i>
                    <span id="wishlist-count" class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold rounded-full h-5 w-5 flex items-center justify-center {{ $wishlistCount > 0 ? '' : 'd-none' }}">
                        {{ $wishlistCount }}
                    </span>
                </a>

                <!-- Account Dropdown -->
                <div class="relative dropdown">
                    <button class="flex items-center gap-2 p-1.5 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors text-gray-700 dark:text-gray-200" 
                            id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        @auth('customer')
                            @php $customer = Auth::guard('customer')->user(); @endphp
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($customer->name) }}&background=c5a059&color=fff" 
                                 alt="Avatar" class="w-8 h-8 rounded-full object-cover ring-2 ring-amber-500/50">
                            <span class="hidden lg:inline text-xs font-semibold text-gray-800 dark:text-gray-200">{{ Str::limit($customer->name, 12) }}</span>
                        @else
                            <div class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-300">
                                <i class="fa-regular fa-user text-base"></i>
                            </div>
                            <span class="hidden lg:inline text-xs font-semibold">Sign In</span>
                        @endauth
                        <i class="fa-solid fa-angle-down text-[10px] text-gray-400 hidden lg:inline"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow-xl rounded-2xl border border-gray-100 dark:border-gray-800 p-2 min-w-[200px]" aria-labelledby="accountDropdown">
                        @guest('customer')
                            <li class="px-3 py-2 border-b border-gray-100 dark:border-gray-800 mb-1">
                                <span class="text-xs text-gray-500 dark:text-gray-400">Welcome to VELORA</span>
                            </li>
                            <li><a class="dropdown-item rounded-lg py-2 text-sm flex items-center gap-2 font-medium" href="{{ route('customer.login') }}"><i class="fa-solid fa-arrow-right-to-bracket text-amber-600"></i> Sign In</a></li>
                            <li><a class="dropdown-item rounded-lg py-2 text-sm flex items-center gap-2 font-medium" href="{{ route('customer.register') }}"><i class="fa-solid fa-user-plus text-amber-600"></i> Create VIP Account</a></li>
                        @else
                            <li class="px-3 py-2 border-b border-gray-100 dark:border-gray-800 mb-1">
                                <div class="text-xs font-bold text-gray-900 dark:text-white">{{ Auth::guard('customer')->user()->name }}</div>
                                <div class="text-[11px] text-gray-500 dark:text-gray-400 truncate">{{ Auth::guard('customer')->user()->email }}</div>
                            </li>
                            <li><a class="dropdown-item rounded-lg py-2 text-sm flex items-center gap-2" href="{{ route('customer.profile.edit') }}"><i class="fa-regular fa-id-badge text-amber-600"></i> My Profile</a></li>
                            <li><a class="dropdown-item rounded-lg py-2 text-sm flex items-center gap-2" href="{{ route('customer.wishlist.index') }}"><i class="fa-regular fa-heart text-amber-600"></i> My Wishlist</a></li>
                            <li><hr class="dropdown-divider border-gray-100 dark:border-gray-800"></li>
                            <li>
                                <a class="dropdown-item rounded-lg py-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-2" href="{{ route('customer.logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('customer-logout-form').submit();">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Sign Out
                                </a>
                                <form id="customer-logout-form" action="{{ route('customer.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>

                <!-- Side Cart Opener Button -->
                <button type="button" onclick="openSideCart()" 
                        class="relative flex items-center gap-2 py-2 px-3.5 rounded-full bg-gradient-to-r from-amber-600 to-amber-500 hover:from-amber-700 hover:to-amber-600 text-white font-semibold text-xs transition-all shadow-md shadow-amber-500/20">
                    <i class="fa fa-shopping-bag text-sm"></i>
                    <span class="hidden sm:inline">Bag</span>
                    <span id="cart-count" class="bg-white text-amber-700 text-[11px] font-black rounded-full h-5 w-5 flex items-center justify-center">
                        {{ session('cart') ? collect(session('cart'))->sum('quantity') : 0 }}
                    </span>
                </button>
            </div>
        </div>

        <!-- Mobile Search Bar (visible only on mobile) -->
        <div class="mt-3 md:hidden">
            <form action="{{ url('/search') }}" method="GET" class="relative m-0">
                <div class="flex rounded-full overflow-hidden border border-amber-500/60 bg-gray-50 dark:bg-gray-800">
                    <input type="text" name="q" placeholder="Search luxury fashion & runway..." 
                           class="w-full bg-transparent px-4 py-2 text-xs text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none">
                    <button type="submit" class="bg-amber-600 text-white px-4 flex items-center justify-center">
                        <i class="fa fa-search text-xs"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Category Mega Navigation Bar (Daraz Style) -->
    <nav class="bg-gray-100/90 dark:bg-[#111827]/90 border-t border-gray-200/60 dark:border-gray-800/60 hidden md:block">
        <div class="container mx-auto px-4 flex items-center justify-between text-xs font-semibold">
            <div class="flex items-center gap-1 py-1 overflow-x-auto custom-scroll">
                <!-- All Categories Dropdown -->
                <div class="relative dropdown group">
                    <button class="flex items-center gap-2 bg-amber-600 text-white px-4 py-2 rounded-lg font-bold tracking-wide hover:bg-amber-700 transition-colors my-1">
                        <i class="fa-solid fa-bars"></i>
                        <span>ALL LUXURY CATEGORIES</span>
                        <i class="fa-solid fa-angle-down text-[10px]"></i>
                    </button>
                    <ul class="dropdown-menu shadow-2xl rounded-2xl border border-gray-100 dark:border-gray-800 p-2 min-w-[240px]">
                        <li><a class="dropdown-item py-2 px-3 rounded-lg flex items-center gap-3 text-xs" href="{{ route('shop.index', ['category[]' => 1]) }}"><i class="fa-solid fa-gem text-amber-600"></i> Women's Luxury</a></li>
                        <li><a class="dropdown-item py-2 px-3 rounded-lg flex items-center gap-3 text-xs" href="{{ route('shop.index', ['category[]' => 2]) }}"><i class="fa-solid fa-user-tie text-amber-600"></i> Men's Couture</a></li>
                        <li><a class="dropdown-item py-2 px-3 rounded-lg flex items-center gap-3 text-xs" href="{{ route('shop.index', ['category[]' => 3]) }}"><i class="fa-solid fa-shoe-prints text-amber-600"></i> Designer Footwear</a></li>
                        <li><a class="dropdown-item py-2 px-3 rounded-lg flex items-center gap-3 text-xs" href="{{ route('shop.index', ['category[]' => 4]) }}"><i class="fa-solid fa-clock text-amber-600"></i> Watches & Jewelry</a></li>
                        <li><a class="dropdown-item py-2 px-3 rounded-lg flex items-center gap-3 text-xs" href="{{ route('shop.index', ['category[]' => 5]) }}"><i class="fa-solid fa-bag-shopping text-amber-600"></i> Bags & Leather</a></li>
                        <li><a class="dropdown-item py-2 px-3 rounded-lg flex items-center gap-3 text-xs" href="{{ route('shop.index', ['category[]' => 6]) }}"><i class="fa-solid fa-glasses text-amber-600"></i> Designer Eyewear</a></li>
                    </ul>
                </div>

                <!-- Nav Hot Links -->
                <a href="{{ route('shop.index') }}" class="px-3 py-2 text-red-600 dark:text-red-400 hover:text-red-700 flex items-center gap-1 font-bold text-decoration-none">
                    <i class="fa-solid fa-bolt text-amber-500"></i> FLASH SALE
                </a>
                <a href="{{ route('shop.index') }}" class="px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-amber-600 dark:hover:text-amber-400 transition-colors text-decoration-none">
                    New Arrivals
                </a>
                <a href="{{ route('shop.index') }}" class="px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-amber-600 dark:hover:text-amber-400 transition-colors text-decoration-none">
                    Runway 2026
                </a>
                <a href="{{ route('shop.index') }}" class="px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-amber-600 dark:hover:text-amber-400 transition-colors text-decoration-none">
                    Official Ateliers
                </a>
                <a href="{{ route('shop.index') }}" class="px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-amber-600 dark:hover:text-amber-400 transition-colors text-decoration-none">
                    Trending Now
                </a>
            </div>

            <!-- VIP Support Ribbon -->
            <div class="hidden lg:flex items-center gap-2 text-gray-500 dark:text-gray-400">
                <i class="fa-solid fa-headset text-amber-600"></i>
                <span>VIP Concierge: <span class="font-bold text-gray-900 dark:text-white">+1 (800) 835-672</span></span>
            </div>
        </div>
    </nav>
</header>
