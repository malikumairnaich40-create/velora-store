<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $customer = Auth::guard('customer')->user();

        $products = $customer->wishlistProducts()
            ->with(['translation', 'thumbnail', 'primaryVariant', 'reviews'])
            ->withCount('reviews')
            ->orderBy('wishlists.created_at', 'desc')
            ->get();

        return view('themes.xylo.wishlist', compact('products'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $productId = (int) $request->product_id;
        $customer = Auth::guard('customer')->user();

        if ($customer) {
            $wishlist = Wishlist::where('customer_id', $customer->id)
                ->where('product_id', $productId)
                ->first();

            if ($wishlist) {
                $wishlist->delete();
                $count = $customer->wishlistProducts()->count();
                return response()->json([
                    'status' => 'removed',
                    'count' => $count,
                    'message' => 'Removed from your Wishlist'
                ]);
            }

            Wishlist::create([
                'customer_id' => $customer->id,
                'product_id' => $productId,
            ]);

            $count = $customer->wishlistProducts()->count();
            return response()->json([
                'status' => 'added',
                'count' => $count,
                'message' => 'Added to your Wishlist!'
            ]);
        }

        // Guest session wishlist
        $wishlist = session('guest_wishlist', []);
        if (in_array($productId, $wishlist)) {
            $wishlist = array_values(array_diff($wishlist, [$productId]));
            session(['guest_wishlist' => $wishlist]);
            return response()->json([
                'status' => 'removed',
                'count' => count($wishlist),
                'message' => 'Removed from your Wishlist'
            ]);
        }

        $wishlist[] = $productId;
        session(['guest_wishlist' => $wishlist]);
        return response()->json([
            'status' => 'added',
            'count' => count($wishlist),
            'message' => 'Added to your Wishlist!'
        ]);
    }
}
