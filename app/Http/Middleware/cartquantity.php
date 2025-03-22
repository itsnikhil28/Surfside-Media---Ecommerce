<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use Symfony\Component\HttpFoundation\Response;

class cartquantity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $item = Cart::instance('cart')->content();

        if ($item->count() > 0) {
            return $next($request);
        } else {
            return redirect('/cart');
        }
    }
}
