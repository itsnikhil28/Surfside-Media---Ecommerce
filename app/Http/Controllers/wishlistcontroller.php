<?php

namespace App\Http\Controllers;

use App\Models\wishlist;
use Illuminate\Http\Request;

class wishlistcontroller extends Controller
{
    public function index()
    {
        $wishlists = wishlist::orderby('created_at', 'DESC')->where('productqty', '>=', 1)->where('user_id', session('id'))->get();
        return view('home.wishlist', compact('wishlists'));
    }

    public function addtowishlist(Request $request)
    {
        wishlist::create([
            'user_id' => session('id'),
            'product_id' => $request->productid,
            'productqty' => 1
        ]);

        return redirect()->back();
    }

    public function wishlistincrease(Request $request)
    {
        $wishlist = wishlist::findorfail($request->wishlistid);
        $wishlist->productqty += 1;
        $wishlist->save();

        return redirect()->back();
    }

    public function wishlistdecrease(Request $request)
    {
        $wishlist = wishlist::findorfail($request->wishlistid);
        $wishlist->productqty -= 1;
        $wishlist->save();
        if ($wishlist->productqty == 0) {
            $wishlist->delete();
        }

        return redirect()->back();
    }

    public function removefromwishlist(Request $request)
    {
        $wishlist = wishlist::where('product_id', $request->productid)->where('user_id', session('id'))->first();
        $wishlist->delete();

        return redirect()->back();
    }

    public function wishlistempty()
    {
        wishlist::truncate();
        return redirect()->back();
    }
}
