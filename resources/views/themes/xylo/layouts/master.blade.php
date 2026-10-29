<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'VELORA') }} - Premium Luxury Store</title>

    <!-- Early Theme Detection to prevent flash of white -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Google Fonts: Poppins & Playfair Display for Haute Couture look -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;0,800;1,400;1,600&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS for compatibility -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6.7.2 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

    <!-- Toastr Notifications CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>

    <!-- Tailwind CSS CDN Engine with full configuration -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        velora: {
                            50: '#fcfaf6',
                            100: '#f7f2ea',
                            200: '#ede1cf',
                            300: '#decaa8',
                            400: '#cfa97f',
                            500: '#c5a059',
                            600: '#b38e47',
                            700: '#946140',
                            800: '#794f38',
                            900: '#0f172a',
                        },
                        daraz: {
                            orange: '#f85606',
                            card: '#1e293b',
                            dark: '#0f172a'
                        }
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>

    @if (!App::environment('testing'))
        @vite(['resources/css/app.css', 'resources/views/themes/xylo/sass/app.scss'])
    @endif

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .dark body {
            background-color: #0b0f19;
            color: #f1f5f9;
        }
        .font-serif {
            font-family: 'Playfair Display', Georgia, serif;
        }
        /* Dark mode overrides for existing Bootstrap elements */
        .dark .bg-light {
            background-color: #111827 !important;
            color: #f1f5f9 !important;
        }
        .dark .bg-white {
            background-color: #111827 !important;
            color: #f1f5f9 !important;
        }
        .dark .text-dark, .dark h1, .dark h2, .dark h3, .dark h4, .dark h5, .dark h6 {
            color: #f8fafc !important;
        }
        .dark .text-muted {
            color: #94a3b8 !important;
        }
        .dark .border, .dark .border-bottom, .dark .border-top {
            border-color: #1e293b !important;
        }
        .dark .dropdown-menu {
            background-color: #1e293b !important;
            color: #f8fafc !important;
            border-color: #334155 !important;
        }
        .dark .dropdown-item {
            color: #e2e8f0 !important;
        }
        .dark .dropdown-item:hover {
            background-color: #334155 !important;
            color: #ffffff !important;
        }
        .dark .form-control, .dark .form-select {
            background-color: #1e293b !important;
            border-color: #334155 !important;
            color: #f8fafc !important;
        }
        /* Side Cart Drawer transition */
        #side-cart-drawer {
            transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            transform: translateX(100%);
        }
        #side-cart-drawer.open {
            transform: translateX(0);
        }
        #side-cart-backdrop {
            transition: opacity 0.3s ease;
            opacity: 0;
            pointer-events: none;
        }
        #side-cart-backdrop.open {
            opacity: 1;
            pointer-events: auto;
        }
        /* Floating WhatsApp pulse */
        @keyframes pulse-ring {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 15px rgba(37, 211, 102, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
        }
        .whatsapp-pulse {
            animation: pulse-ring 2s infinite cubic-bezier(0.4, 0, 0.6, 1);
        }
        .custom-scroll::-webkit-scrollbar {
            width: 5px;
        }
        .custom-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        .dark .custom-scroll::-webkit-scrollbar-thumb {
            background: #475569;
        }
    </style>

    @yield('css')
</head>
<body class="bg-gray-50 text-gray-900 dark:bg-[#0b0f19] dark:text-gray-100 antialiased selection:bg-amber-500 selection:text-white">

    <!-- Header -->
    @include('themes.xylo.layouts.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('themes.xylo.layouts.footer')

    <!-- Side Cart Overlay Backdrop -->
    <div id="side-cart-backdrop" class="fixed inset-0 bg-black/60 z-50 transition-opacity backdrop-blur-sm" onclick="closeSideCart()"></div>

    <!-- Slide-out Side Cart Drawer -->
    <div id="side-cart-drawer" class="fixed top-0 right-0 h-full w-full sm:w-[420px] bg-white dark:bg-gray-900 shadow-2xl z-50 flex flex-col transform">
        <!-- Drawer Header -->
        <div class="p-4 border-b border-gray-200 dark:border-gray-800 flex items-center justify-between bg-gray-50 dark:bg-gray-800/60">
            <div class="flex items-center gap-2">
                <i class="fa fa-shopping-bag text-amber-600 dark:text-amber-400 text-lg"></i>
                <h3 class="font-bold text-gray-900 dark:text-white text-lg tracking-wide">Shopping Bag</h3>
                <span id="side-cart-badge" class="bg-amber-600 text-white text-xs px-2 py-0.5 rounded-full font-semibold">0</span>
            </div>
            <button onclick="closeSideCart()" class="text-gray-400 hover:text-gray-600 dark:hover:text-white p-2 rounded-lg transition-colors">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        <!-- Free Delivery Notice -->
        <div class="bg-amber-50 dark:bg-amber-950/40 px-4 py-2 text-xs text-amber-800 dark:text-amber-300 flex items-center justify-between border-b border-amber-200/50 dark:border-amber-900/40">
            <span><i class="fa-solid fa-truck-fast mr-1"></i> Free VIP Express Shipping over $150</span>
            <span class="font-semibold text-amber-700 dark:text-amber-400">VELORA Care</span>
        </div>

        <!-- Items List (Scrollable) -->
        <div id="side-cart-items" class="flex-1 overflow-y-auto p-4 space-y-3 custom-scroll">
            <div class="text-center py-12 text-gray-400">
                <i class="fa fa-shopping-bag text-4xl mb-3 opacity-40"></i>
                <p>Your shopping bag is empty.</p>
            </div>
        </div>

        <!-- Drawer Footer -->
        <div class="p-4 border-t border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/60 space-y-3">
            <div class="flex justify-between items-center text-sm">
                <span class="text-gray-500 dark:text-gray-400 font-medium">Subtotal</span>
                <span id="side-cart-total" class="font-bold text-lg text-gray-900 dark:text-white">$0.00</span>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('cart.view') }}" class="flex-1 text-center py-2.5 px-4 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-200 font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors text-sm">
                    View Full Bag
                </a>
                <a href="{{ route('checkout.index') }}" class="flex-1 text-center py-2.5 px-4 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-semibold transition-colors shadow-md hover:shadow-lg text-sm flex items-center justify-center gap-1.5">
                    Checkout <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Quick View Modal -->
    <div id="quick-view-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black/70 backdrop-blur-sm transition-opacity" onclick="closeQuickView()"></div>
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="relative w-full max-w-3xl transform overflow-hidden rounded-2xl bg-white dark:bg-gray-900 shadow-2xl transition-all border border-gray-200 dark:border-gray-800">
                <!-- Close Button -->
                <button onclick="closeQuickView()" class="absolute top-4 right-4 z-10 text-gray-400 hover:text-gray-700 dark:hover:text-white bg-gray-100 dark:bg-gray-800 rounded-full w-9 h-9 flex items-center justify-center transition-colors">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>

                <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                    <!-- Product Image -->
                    <div class="space-y-3">
                        <div class="overflow-hidden rounded-xl bg-gray-100 dark:bg-gray-800 aspect-square flex items-center justify-center shadow-inner">
                            <img id="qv-main-img" src="" alt="Product" class="w-full h-full object-cover">
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="space-y-4">
                        <div>
                            <span id="qv-category" class="text-xs uppercase tracking-wider font-semibold text-amber-600 dark:text-amber-400"></span>
                            <h2 id="qv-title" class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white font-serif mt-1"></h2>
                            <div class="flex items-center gap-2 mt-2">
                                <div class="text-amber-400 text-xs">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                </div>
                                <span id="qv-reviews" class="text-xs text-gray-500 dark:text-gray-400"></span>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="flex items-baseline gap-3">
                            <span id="qv-price" class="text-2xl font-bold text-gray-900 dark:text-white"></span>
                            <span id="qv-old-price" class="text-sm text-gray-400 line-through"></span>
                            <span id="qv-badge" class="bg-red-500/10 text-red-500 text-xs px-2 py-0.5 rounded font-semibold">SALE</span>
                        </div>

                        <!-- Description -->
                        <p id="qv-desc" class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed max-h-24 overflow-y-auto"></p>

                        <!-- Quantity & Add to Cart -->
                        <div class="pt-2 space-y-3">
                            <div class="flex items-center gap-3">
                                <div class="flex items-center border border-gray-300 dark:border-gray-700 rounded-xl overflow-hidden bg-gray-50 dark:bg-gray-800">
                                    <button type="button" onclick="adjustQvQty(-1)" class="px-3 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 font-bold">-</button>
                                    <input type="number" id="qv-qty" value="1" min="1" max="99" class="w-12 text-center bg-transparent text-gray-900 dark:text-white font-semibold focus:outline-none border-none">
                                    <button type="button" onclick="adjustQvQty(1)" class="px-3 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 font-bold">+</button>
                                </div>
                                <button id="qv-add-btn" onclick="addQvToCart()" class="flex-1 bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2.5 px-4 rounded-xl transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                                    <i class="fa fa-shopping-bag"></i> Add to Bag
                                </button>
                            </div>
                            <a id="qv-detail-link" href="#" class="block text-center text-xs text-amber-600 dark:text-amber-400 hover:underline">
                                View Full Details & Specifications <i class="fa-solid fa-arrow-right text-[10px] ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/1234567890?text=Hello%20VELORA%20Premium%20Store%2C%20I%20would%20like%20assistance%20with%20my%20luxury%20order." 
       target="_blank" 
       rel="noopener noreferrer"
       class="fixed bottom-6 right-6 z-40 bg-[#25D366] text-white rounded-full w-14 h-14 flex items-center justify-center shadow-2xl hover:scale-110 transition-transform whatsapp-pulse group"
       title="Chat with VIP Concierge">
        <i class="fa-brands fa-whatsapp text-3xl"></i>
        <span class="absolute right-16 bg-gray-900 text-white text-xs px-3 py-1.5 rounded-lg whitespace-nowrap shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none hidden sm:block">
            VIP Style Advisor • Online
        </span>
    </a>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-bottom-right",
            timeOut: 3500,
        };

        // Dark / Light Mode Toggle
        function toggleDarkMode() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
                updateThemeIcons(false);
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
                updateThemeIcons(true);
            }
        }

        function updateThemeIcons(isDark) {
            const icons = document.querySelectorAll('.theme-toggle-icon');
            icons.forEach(icon => {
                if (isDark) {
                    icon.classList.remove('fa-moon');
                    icon.classList.add('fa-sun');
                } else {
                    icon.classList.remove('fa-sun');
                    icon.classList.add('fa-moon');
                }
            });
        }

        // Initialize icons on load
        document.addEventListener('DOMContentLoaded', () => {
            updateThemeIcons(document.documentElement.classList.contains('dark'));
        });

        // Side Cart Drawer Functions
        function openSideCart() {
            document.getElementById('side-cart-backdrop').classList.add('open');
            document.getElementById('side-cart-drawer').classList.add('open');
            refreshSideCart();
        }

        function closeSideCart() {
            document.getElementById('side-cart-backdrop').classList.remove('open');
            document.getElementById('side-cart-drawer').classList.remove('open');
        }

        function refreshSideCart() {
            fetch("{{ route('cart.drawer') }}")
                .then(res => res.json())
                .then(data => {
                    renderSideCart(data);
                })
                .catch(err => console.error("Error fetching cart drawer:", err));
        }

        function renderSideCart(data) {
            const container = document.getElementById('side-cart-items');
            const badge = document.getElementById('side-cart-badge');
            const total = document.getElementById('side-cart-total');
            const headerCount = document.getElementById('cart-count');

            if (badge) badge.textContent = data.count || 0;
            if (headerCount) headerCount.textContent = data.count || 0;
            if (total) total.textContent = data.formatted_total || '$0.00';

            if (!data.items || data.items.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-12 text-gray-400">
                        <i class="fa fa-shopping-bag text-4xl mb-3 opacity-40"></i>
                        <p class="font-medium text-sm">Your shopping bag is empty.</p>
                        <a href="{{ route('shop.index') }}" onclick="closeSideCart()" class="mt-4 inline-block text-xs bg-amber-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-amber-700 transition-colors">
                            Explore Collections
                        </a>
                    </div>
                `;
                return;
            }

            let html = '';
            data.items.forEach(item => {
                html += `
                    <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 dark:bg-gray-800/70 border border-gray-100 dark:border-gray-800">
                        <img src="${item.image}" alt="${item.name}" class="w-16 h-16 object-cover rounded-lg flex-shrink-0 bg-white">
                        <div class="flex-1 min-w-0">
                            <h4 class="text-xs font-semibold text-gray-900 dark:text-white truncate">${item.name}</h4>
                            <div class="text-xs text-amber-600 dark:text-amber-400 font-bold mt-0.5">${item.formatted_price}</div>
                            <div class="flex items-center gap-2 mt-1.5">
                                <span class="text-[11px] text-gray-500">Qty: ${item.quantity}</span>
                                <span class="text-[11px] font-semibold text-gray-700 dark:text-gray-300">Total: ${item.formatted_subtotal}</span>
                            </div>
                        </div>
                        <button onclick="removeSideCartItem('${item.key}')" class="text-gray-400 hover:text-red-500 p-1.5 transition-colors">
                            <i class="fa-regular fa-trash-can text-sm"></i>
                        </button>
                    </div>
                `;
            });
            container.innerHTML = html;
        }

        function removeSideCartItem(key) {
            fetch("{{ route('cart.remove') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ product_id: key })
            })
            .then(res => res.json())
            .then(data => {
                toastr.info("Item removed from your bag.");
                refreshSideCart();
            });
        }

        // Global Ajax Add to Cart
        function addToCart(productId, quantity = 1, attributeIds = []) {
            fetch("{{ route('cart.add') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity,
                    attribute_value_ids: attributeIds
                })
            })
            .then(response => response.json())
            .then(data => {
                toastr.success(data.message || "Added to your shopping bag!");
                openSideCart();
            })
            .catch(error => {
                console.error("Error adding to cart:", error);
                toastr.error("Could not add item to cart. Please try again.");
            });
        }

        // Global Wishlist Toggle
        function toggleWishlist(productId, btnElement) {
            fetch("{{ route('wishlist.toggle') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(response => response.json())
            .then(data => {
                const headerBadge = document.getElementById('wishlist-count');
                if (headerBadge) {
                    headerBadge.textContent = data.count;
                    if (data.count > 0) {
                        headerBadge.classList.remove('d-none');
                    } else {
                        headerBadge.classList.add('d-none');
                    }
                }

                if (btnElement) {
                    const icon = btnElement.querySelector('i');
                    if (data.status === 'added') {
                        icon.classList.remove('fa-regular');
                        icon.classList.add('fa-solid');
                        btnElement.classList.add('text-red-500');
                        toastr.success(data.message || "Added to wishlist!");
                    } else {
                        icon.classList.remove('fa-solid');
                        icon.classList.add('fa-regular');
                        btnElement.classList.remove('text-red-500');
                        toastr.info(data.message || "Removed from wishlist");
                    }
                }
            })
            .catch(error => console.error("Error toggling wishlist:", error));
        }

        // Quick View Modal
        let currentQvProductId = null;

        function openQuickView(productId) {
            currentQvProductId = productId;
            fetch(`/product/${productId}/quick-view`)
                .then(res => res.json())
                .then(product => {
                    document.getElementById('qv-title').textContent = product.name;
                    document.getElementById('qv-category').textContent = `${product.brand} • ${product.category}`;
                    document.getElementById('qv-desc').textContent = product.description;
                    document.getElementById('qv-main-img').src = product.image;
                    document.getElementById('qv-price').textContent = `${product.currency_symbol}${product.discount_price ? product.discount_price : product.price}`;
                    
                    if (product.discount_price) {
                        document.getElementById('qv-old-price').textContent = `${product.currency_symbol}${product.price}`;
                        document.getElementById('qv-old-price').style.display = 'inline';
                        document.getElementById('qv-badge').style.display = 'inline';
                    } else {
                        document.getElementById('qv-old-price').style.display = 'none';
                        document.getElementById('qv-badge').style.display = 'none';
                    }

                    document.getElementById('qv-reviews').textContent = `(${product.reviews_count} Reviews)`;
                    document.getElementById('qv-qty').value = 1;
                    document.getElementById('qv-detail-link').href = `/product/${product.slug}`;

                    document.getElementById('quick-view-modal').classList.remove('hidden');
                })
                .catch(err => {
                    console.error("Error loading quick view:", err);
                    toastr.error("Could not load product preview.");
                });
        }

        function closeQuickView() {
            document.getElementById('quick-view-modal').classList.add('hidden');
        }

        function adjustQvQty(delta) {
            const input = document.getElementById('qv-qty');
            let val = parseInt(input.value) || 1;
            val = Math.max(1, Math.min(99, val + delta));
            input.value = val;
        }

        function addQvToCart() {
            if (!currentQvProductId) return;
            const qty = parseInt(document.getElementById('qv-qty').value) || 1;
            addToCart(currentQvProductId, qty);
            closeQuickView();
        }

        // Search live suggestions
        $(document).ready(function () {
            $('#search-input').on('keyup', function () {
                let query = $(this).val();
                if (query.length > 1) {
                    $.ajax({
                        url: '{{ url('/search-suggestions') }}',
                        type: 'GET',
                        data: { q: query },
                        success: function (data) {
                            let suggestions = $('#search-suggestions');
                            suggestions.html('');
                            if (data.length > 0) {
                                data.forEach(product => {
                                    suggestions.append(`
                                        <a href="/product/${product.slug}" class="flex items-center gap-3 p-2.5 hover:bg-gray-100 dark:hover:bg-gray-700/60 transition-colors border-b border-gray-100 dark:border-gray-800 last:border-0 text-decoration-none">
                                            <img src="${product.thumbnail}" alt="${product.name}" class="w-10 h-10 object-cover rounded-lg">
                                            <div class="flex-1 min-w-0">
                                                <div class="text-xs font-semibold text-gray-900 dark:text-white truncate">${product.name}</div>
                                                <div class="text-[11px] text-amber-600 font-bold">${product.price || ''}</div>
                                            </div>
                                        </a>
                                    `);
                                });
                                suggestions.removeClass('d-none');
                            } else {
                                suggestions.addClass('d-none');
                            }
                        }
                    });
                } else {
                    $('#search-suggestions').addClass('d-none');
                }
            });

            $(document).on('click', function (event) {
                if (!$(event.target).closest('#search-input, #search-suggestions').length) {
                    $('#search-suggestions').addClass('d-none');
                }
            });
        });
    </script>

    @yield('js')
</body>
</html>
