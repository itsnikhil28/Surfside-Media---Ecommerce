<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;

class adminordercontroller extends Controller
{
    public function orderdetail(Request $request)
    {
        $order = order::findorfail($request->id);
        return view('admin.order-details', compact('order'));
    }

    public function ordertracking()
    {
        return view('admin.order-tracking');
    }
}
