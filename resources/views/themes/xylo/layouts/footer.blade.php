<footer class="bg-gray-900 text-gray-300 pt-16 pb-8 border-t border-gray-800 transition-colors">
    <div class="container mx-auto px-4">
        <!-- Top Newsletter & VIP Join Row -->
        <div class="bg-gradient-to-r from-amber-950/70 via-gray-900 to-amber-950/70 rounded-3xl p-8 md:p-12 mb-14 border border-amber-500/20 shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div>
                    <span class="text-xs uppercase tracking-[0.25em] text-amber-400 font-bold">Privileged Access</span>
                    <h3 class="font-serif text-2xl md:text-3xl font-bold text-white mt-1">Join the VELORA Inner Circle</h3>
                    <p class="text-sm text-gray-400 mt-2 max-w-md">Receive private invitations to runway previews, seasonal trunk shows, and receive 15% off your first luxury purchase.</p>
                </div>
                <div>
                    <form onsubmit="event.preventDefault(); toastr.success('Thank you for joining VELORA VIP Club! Your 15% code is: VELORA15');" class="flex flex-col sm:flex-row gap-3">
                        <input type="email" required placeholder="Enter your private email..." 
                               class="flex-1 bg-black/40 border border-amber-500/30 rounded-xl px-4 py-3 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-amber-400">
                        <button type="submit" class="bg-gradient-to-r from-amber-600 to-amber-500 hover:from-amber-700 hover:to-amber-600 text-white font-semibold text-sm px-8 py-3 rounded-xl transition-all shadow-lg shadow-amber-500/20 whitespace-nowrap">
                            Subscribe
                        </button>
                    </form>
                    <span class="text-[11px] text-gray-500 block mt-2">By subscribing, you agree to our Privacy Policy and exclusive VIP terms.</span>
                </div>
            </div>
        </div>

        <!-- Links Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 mb-12">
            <!-- Brand Column -->
            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center gap-2">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-amber-700 via-amber-500 to-amber-300 flex items-center justify-center text-white font-serif font-bold text-lg">
                        V
                    </div>
                    <span class="font-serif font-black text-2xl tracking-widest text-white uppercase">VELORA</span>
                </div>
                <p class="text-sm text-gray-400 max-w-sm leading-relaxed">
                    VELORA Premium Store curates the finest international runway fashion, bespoke Italian tailoring, Swiss timepieces, and artisan leather goods with unconditional authenticity.
                </p>
                <div class="flex items-center gap-3 pt-2">
                    <a href="#" class="w-9 h-9 rounded-full bg-gray-800 hover:bg-amber-600 text-gray-300 hover:text-white flex items-center justify-center transition-colors text-sm"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="w-9 h-9 rounded-full bg-gray-800 hover:bg-amber-600 text-gray-300 hover:text-white flex items-center justify-center transition-colors text-sm"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="w-9 h-9 rounded-full bg-gray-800 hover:bg-amber-600 text-gray-300 hover:text-white flex items-center justify-center transition-colors text-sm"><i class="fab fa-pinterest-p"></i></a>
                    <a href="#" class="w-9 h-9 rounded-full bg-gray-800 hover:bg-amber-600 text-gray-300 hover:text-white flex items-center justify-center transition-colors text-sm"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>

            <!-- Categories -->
            <div class="space-y-3">
                <h4 class="text-white font-semibold text-sm tracking-wider uppercase">Collections</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="{{ route('shop.index', ['category[]' => 1]) }}" class="hover:text-amber-400 transition-colors">Women's Luxury</a></li>
                    <li><a href="{{ route('shop.index', ['category[]' => 2]) }}" class="hover:text-amber-400 transition-colors">Men's Couture</a></li>
                    <li><a href="{{ route('shop.index', ['category[]' => 3]) }}" class="hover:text-amber-400 transition-colors">Designer Footwear</a></li>
                    <li><a href="{{ route('shop.index', ['category[]' => 4]) }}" class="hover:text-amber-400 transition-colors">Timepieces & Jewelry</a></li>
                    <li><a href="{{ route('shop.index', ['category[]' => 5]) }}" class="hover:text-amber-400 transition-colors">Bags & Leather</a></li>
                    <li><a href="{{ route('shop.index', ['category[]' => 6]) }}" class="hover:text-amber-400 transition-colors">Designer Eyewear</a></li>
                </ul>
            </div>

            <!-- Client Services -->
            <div class="space-y-3">
                <h4 class="text-white font-semibold text-sm tracking-wider uppercase">VIP Services</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="{{ route('customer.profile.edit') }}" class="hover:text-amber-400 transition-colors">VIP Concierge Account</a></li>
                    <li><a href="{{ route('customer.wishlist.index') }}" class="hover:text-amber-400 transition-colors">Saved Wishlist</a></li>
                    <li><a href="{{ route('cart.view') }}" class="hover:text-amber-400 transition-colors">Shopping Bag</a></li>
                    <li><a href="{{ route('checkout.index') }}" class="hover:text-amber-400 transition-colors">Secure Checkout</a></li>
                    <li><a href="#" class="hover:text-amber-400 transition-colors">Authenticity Certificate</a></li>
                    <li><a href="#" class="hover:text-amber-400 transition-colors">Worldwide Shipping</a></li>
                </ul>
            </div>

            <!-- Contact & Ateliers -->
            <div class="space-y-3">
                <h4 class="text-white font-semibold text-sm tracking-wider uppercase">Atelier Concierge</h4>
                <ul class="space-y-2.5 text-sm text-gray-400">
                    <li class="flex items-start gap-2.5">
                        <i class="fa-solid fa-location-dot text-amber-500 mt-1"></i>
                        <span>Via della Spiga 12, Milan & 5th Ave, New York</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="fa-solid fa-phone text-amber-500"></i>
                        <span>+1 (800) 835-672</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="fa-solid fa-envelope text-amber-500"></i>
                        <span>concierge@velorastore.com</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="fa-brands fa-whatsapp text-green-500"></i>
                        <a href="https://wa.me/1234567890" target="_blank" class="hover:text-amber-400 transition-colors">WhatsApp Live Advisor</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Copyright & Badges -->
        <div class="pt-8 border-t border-gray-800 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-gray-500">
            <p>&copy; {{ date('Y') }} VELORA Premium Store. All rights reserved. Handcrafted for connoisseurs of luxury.</p>
            <div class="flex items-center gap-4 text-xl text-gray-400">
                <i class="fa-brands fa-cc-visa hover:text-white transition-colors" title="Visa"></i>
                <i class="fa-brands fa-cc-mastercard hover:text-white transition-colors" title="Mastercard"></i>
                <i class="fa-brands fa-cc-amex hover:text-white transition-colors" title="American Express"></i>
                <i class="fa-brands fa-cc-paypal hover:text-white transition-colors" title="PayPal"></i>
                <i class="fa-brands fa-cc-apple-pay hover:text-white transition-colors" title="Apple Pay"></i>
            </div>
        </div>
    </div>
</footer>
