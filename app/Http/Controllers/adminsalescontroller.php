<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminsalescontroller extends Controller
{
    public function addsale()
    {
        $soldProductIds = DB::table('sales')->pluck('product_id');
        $products = product::whereNotIn('id', $soldProductIds)->get();
        return view('admin.add-sales', compact('products'));
    }

    public function productdetail($id)
    {
        $product = product::with('category','brand')->findOrFail($id);
        return response()->json($product);
    }

    public function salestore(Request $request)
    {
        $request->validate([
            'deal_price' => 'required',
            'dealtype' => 'required',
        ]);

        sales::create([
            'product_id' => $request->productid,
            'deal_type' => $request->dealtype,
            'regular_price' => $request->regular_price,
            'deal_price' => $request->deal_price,
        ]);

        return redirect()->route('admin.sales')->with('success', 'Product Added To sales Successfully');
    }

    public function editsale($id)
    {
        $sale = sales::findorfail($id);
        return view('admin.edit-sales', compact('sale'));
    }

    public function updatesale(Request $request)
    {
        $sale = sales::findorfail($request->id);

        $request->validate([
            'deal_price' => 'required',
            'dealtype' => 'required',
        ]);

        // $sale->regular_price = $request->regular_price;
        $sale->deal_type = $request->dealtype;
        $sale->deal_price = $request->deal_price;

        $sale->save();

        return redirect()->route('admin.sales')->with('success', 'Product Updated Successfully');
    }

    public function saledelete($id)
    {
        $sale = sales::findorfail($id);

        $sale->delete();

        return redirect()->route('admin.sales')->with('success', 'Product Removed From sale successfully.');
    }
}
