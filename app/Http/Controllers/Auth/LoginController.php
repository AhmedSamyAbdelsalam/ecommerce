<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    use AuthenticatesUsers {
        logout as protected originalLogout;
    }

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function redirectTo()
    {
        if (auth()->user()->roles()->first()->allowed_route != '') {
            return $this->redirectTo = auth()->user()->roles()->first()->allowed_route . '/index';
        }
    }

    public function logout(Request $request)
    {
        $cart = collect($request->session()->get('cart'));

        /* Call original logout method */
        $response = $this->originalLogout($request);

        /* Repopulate Sesssion with Cart */
        if (!config('cart.destroy_on_logout')) {
            $cart->each(function ($rows, $identifier) use ($request){
                $request->session()->put('cart.'. $identifier, $rows);
            });
        }

        /* Return original response */
        return $response;

    }

    protected function loggedOut(Request $request)
    {
        Cache::forget('role_routes');
        Cache::forget('user_routes');
        Cache::forget('admin_side_menu');

    }


}
