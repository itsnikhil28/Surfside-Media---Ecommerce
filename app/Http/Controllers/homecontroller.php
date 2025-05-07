<?php

namespace App\Http\Controllers;

use App\Mail\usermail;
use App\Models\category;
use App\Models\product;
use App\Models\sales;
use App\Models\slider;
use App\Models\User;
use App\Models\usercontact;
use App\Models\wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class homecontroller extends Controller
{
    public function index()
    {
        $featuredproducts = product::where('featured', '1')->get();
        $sliders = slider::all();
        $wishlists = wishlist::where('user_id', session('id'))->get();
        $salesproduct = sales::where('deal_type', 'summer')->get();
        $categories = category::all();
        $bestcategories = category::limit(2)->get();
        foreach ($bestcategories as $category) {
            $category->first_product = $category->products()->first();
        }
        $sales_product_id = sales::pluck('product_id');
        return view('home.index', compact('sliders', 'featuredproducts', 'wishlists', 'salesproduct', 'categories', 'sales_product_id', 'bestcategories'));
    }

    public function about()
    {
        return view('home.about');
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function affiliate()
    {
        return view('home.affiliate');
    }

    public function privacypolicy()
    {
        return view('home.privacy-policy');
    }

    public function termscondition()
    {
        return view('home.terms-condition');
    }


    public function contactform(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|email',
            'phone' => 'required|digits:10|numeric'
        ]);

        $message = Mail::to($request->email)->send(new usermail($request->name, $request->email, $request->phone, $request->message));

        if ($message) {
            usercontact::create([
                'name' => $request->name,
                'email' => $request->email,
                'number' => $request->phone,
                'message' => $request->message
            ]);
            return redirect()->back()->with('success', 'Your response has been received! Our team will contact you soon...');
        } else {
            return redirect()->back()->with('error', 'Our servers are currently busy! Please try again after sometime..');
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect('/login')->with('error', "Account Doesn't Exist");
        } else {
            if (Hash::check($password, $user->password)) {
                session(['id' => $user->_id]);
                session(['role' => $user->role]);
                if ($user->role == 'user') {
                    return redirect('/dashboard');
                }
                return redirect('/admin-dashboard');
            } else {
                return redirect('/login')->with('error', "Please Enter Correct Password");
            }
        }
    }

    public function logout()
    {
        Session::invalidate();
        Session::flush();

        return redirect('/login')->with('success', 'Logout Successfully');
    }
}
