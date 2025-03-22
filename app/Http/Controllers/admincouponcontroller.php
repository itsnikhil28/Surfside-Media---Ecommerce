<?php

namespace App\Http\Controllers;

use App\Models\coupon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class admincouponcontroller extends Controller
{

    public function addcoupon()
    {
        return view('admin.add-coupon');
    }

    public function couponstore(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code',
            'type' => 'required',
            'value' => 'required|numeric',
            'cart_value' => 'required|numeric',
            'expiry_date' => 'required|date|after:today'
        ]);

        if (coupon::where('code', strtoupper($request->code))->count() > 0) {
            return redirect()->back()->with('error', 'Coupon already added! Please use different One...');
        } else {
            coupon::create([
                'code' => strtoupper($request->code),
                'type' => $request->type,
                'value' => (int) $request->value,
                'cart_value' => (int) $request->cart_value,
                'expiry_date' => $request->expiry_date,
            ]);
        }

        return redirect()->route('admin.coupons')->with('success', 'Coupon added successfully..');
    }

    public function editcoupon($id)
    {
        $coupon = coupon::findorfail($id);
        return view('admin.edit-coupon', compact('coupon'));
    }

    public function updatecoupon(Request $request)
    {
        $coupon = coupon::findorfail($request->id);

        $request->validate([
            'code' => 'required|unique:coupons,code,' . $request->id,
            'type' => 'required',
            'value' => 'required|numeric',
            'cart_value' => 'required|numeric',
            'expiry_date' => 'required|date|after:today'
        ]);

        $coupon->code = strtoupper($request->code);
        $coupon->type = $request->type;
        $coupon->value = (int) $request->value;
        $coupon->cart_value = (float) $request->cart_value;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->save();

        return redirect()->route('admin.coupons')->with('success', 'Coupon Updated successfully..');
    }

    public function coupondelete($id)
    {
        $coupon = coupon::findorfail($id);
        $coupon->delete();
        return redirect()->back()->with('success', 'Coupon Deleted successfully..');
    }
}
