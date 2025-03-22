<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class userauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('id')) {
            return redirect()->route('login');
        }

        $user = User::findorfail(session('id'));
        
        if ($user) {
            if ($user->role == 'user') {
                return $next($request);
            } else {
                Session::flush();
                return redirect()->route('login');
            }
        } else {
            Session::flush();
            return redirect()->route('login');
        }

    }

}
