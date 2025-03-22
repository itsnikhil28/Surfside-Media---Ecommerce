<?php

namespace App\Http\Controllers;

use App\Models\address;
use App\Models\order;
use App\Models\orderitem;
use App\Models\transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class usercontroller extends Controller
{
    public function index()
    {
        return view('users.dashboard');
    }

    public function accountorders()
    {
        $orders = order::orderby('created_at', 'DESC')->where('user_id', session('id'))->get();
        return view('users.account-order', compact('orders'));
    }

    public function orderdetails($id)
    {
        $order = order::findorfail($id);
        return view('users.account-order-details', compact('order'));
    }

    public function cancelorder(Request $request)
    {
        $order = order::findorfail($request->id);
        orderitem::where('order_id', $order->id)->delete();
        transaction::where('order_id', $order->id)->delete();
        $order->delete();

        return redirect()->route('users.account-orders')->with('success', 'Your order has been cancelled Successfully');
    }

    public function accountaddress()
    {
        $address = address::where('user_id', session('id'))->first();
        return view('users.account-address', compact('address'));
    }

    public function addaddress()
    {
        return view('users.account-addaddress');
    }

    public function storeaddress(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'phone' => 'required|numeric|digits:10',
            'zip' => 'required|numeric|digits:6',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'locality' => 'required',
            'landmark' => 'required',
        ]);

        address::create([
            'user_id' => session('id'),
            'name' => $request->name,
            'phone' => $request->phone,
            'locality' => $request->locality,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => 'INDIA',
            'landmark' => $request->landmark,
            'zip' => $request->zip,
            'isdefault' => true,
        ]);

        return redirect()->route('users.account-address')->with('success', 'Address successfully added');
    }

    public function editaddress()
    {
        $address = address::where('user_id', session('id'))->first();
        return view('users.account-updateaddress', compact('address'));
    }

    public function updateaddress(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'phone' => 'required|numeric|digits:10',
            'zip' => 'required|numeric|digits:6',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'locality' => 'required',
            'landmark' => 'required',
        ]);

        $address = address::where('user_id', session('id'))->first();

        $address->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'locality' => $request->locality,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => 'INDIA',
            'landmark' => $request->landmark,
            'zip' => $request->zip,
            'isdefault' => true,
        ]);

        return redirect()->route('users.account-address')->with('success', 'Address Successfully Updated');
    }

    public function accountdetails()
    {
        $user = User::findorfail(session('id'));
        return view('users.account-details', compact('user'));
    }

    public function accountdetailschange(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'phoneno' => 'required|digits:10',
            'email' => 'required|email',
            'new_password' => 'min:8',
            'new_password_confirmation' => 'min:8|same:new_password',
        ]);

        $user = User::findorfail(session('id'));
        if (!$user) {
            return redirect()->back()->with('error', `User Doesn't exist`);
        } else {
            if (Hash::check($request->old_password, $user->password)) {
                if (Hash::check($request->new_password, $user->password)) {
                    return redirect()->back()->with('error', 'Please enter a different password from previous one');
                } else {
                    $user->name = $request->name;
                    $user->phoneno = $request->phoneno;
                    $user->password = $request->new_password_confirmation;
                    $user->save();

                    Session::flush();
                    Session::invalidate();
                    return redirect('/login')->with('success', 'Details Successfully Updated');
                }
            } else {
                return redirect()->back()->with('error', 'Please enter valid Password of your account');
            }
        }
    }
}
