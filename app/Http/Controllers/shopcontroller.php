<?php

namespace App\Http\Controllers;

use App\Models\brand;
use App\Models\category;
use App\Models\product;
use App\Models\sales;
use App\Models\wishlist;
use Illuminate\Http\Request;

class shopcontroller extends Controller
{
    public function index()
    {
        $sortOption = 'default';
        $products = product::orderBy('created_at', 'DESC')->paginate(10);
        $categories = category::orderBy('name')->get();
        $brands = brand::orderBy('name')->get();
        $wishlists = wishlist::where('user_id',session('id'))->get();
        $sales_product_id = sales::pluck('product_id');

        return view('home.shop', compact('products', 'categories', 'sortOption', 'brands', 'wishlists', 'sales_product_id'));
    }

    public function sort(Request $request)
    {
        $sortOption = $request->input('sorting', 'default');
        $selectedBrands = $request->input('brands', []);
        $selectedcategory = $request->input('categoryid');
        $minprice = (int) $request->input('price_min') ?? 10;
        $maxprice = (int) $request->input('price_max') ?? 450;

        $query = product::query();

        if (!empty($selectedBrands)) {
            $query->whereIn('brand_id', $selectedBrands);
        }

        if (!empty($selectedcategory)) {
            $query->where('category_id', $selectedcategory);
        }

        if (!empty($minprice) && !empty($maxprice)) {
            $query->whereBetween('regular_price', [$minprice, $maxprice]);
        }
        // if (!empty($minprice) && !empty($maxprice)) {
        //     $query->where('regular_price', ['$gte' => $minprice, '$lte' => $maxprice]);
        // }

        if ($sortOption === 'featured') {
            $query->where('featured', '1');
        } elseif ($sortOption === 'name-asc') {
            $query->orderBy('name', 'ASC');
        } elseif ($sortOption === 'name-desc') {
            $query->orderBy('name', 'DESC');
        } elseif ($sortOption === 'price-asc') {
            $query->orderBy('regular_price', 'ASC');
        } elseif ($sortOption === 'price-desc') {
            $query->orderBy('regular_price', 'DESC');
        } elseif ($sortOption === 'date-asc') {
            $query->orderBy('created_at', 'ASC');
        } elseif ($sortOption === 'date-desc') {
            $query->orderBy('created_at', 'DESC');
        } else {
            $query->orderBy('created_at', 'DESC');
        }

        $products = $query->paginate(500);

        $categories = category::orderBy('name')->get();
        $brands = brand::orderBy('name')->get();
        $wishlists = wishlist::where('user_id',session('id'))->get();
        $sales_product_id = sales::pluck('product_id');
        return view('home.shop', compact('products', 'categories', 'brands', 'sortOption', 'selectedBrands', 'selectedcategory', 'wishlists', 'sales_product_id','minprice','maxprice'));
    }

    public function productdetail($slug)
    {
        $product = product::where('slug', $slug)->first();
        $relatedproducts = product::where("slug", "<>", $product->slug)->get()->take(8);
        $wishlist = wishlist::where('product_id', $product->id)->where('user_id', session('id'))->get();
        $wishlists = wishlist::where('user_id',session('id'))->get();
        $sales_product_id = sales::pluck('product_id');
        return view('home.detail', compact('product', 'relatedproducts', 'wishlist', 'wishlists', 'sales_product_id'));
    }
}
