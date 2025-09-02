<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('customer.wishlist.index', compact('wishlist'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ]);

        return redirect()->back()->with('success', 'Product added to wishlist successfully!');
    }

    public function destroy(Wishlist $wishlist)
    {
        // Ensure the user owns the wishlist item
        if ($wishlist->user_id !== Auth::id()) {
            abort(403);
        }

        $wishlist->delete();

        return redirect()->back()->with('success', 'Product removed from wishlist successfully!');
    }
}
