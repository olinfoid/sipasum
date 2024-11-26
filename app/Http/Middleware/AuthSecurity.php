<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;

class AuthSecurity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $login = Session::get('login');
        if ($login) {
            $users_session = Session::get('users_session');
        } else {
            //Tampilkan Notif dengan Toastr
            $msg = "Kamu belum login :(";
            Toastr::error($msg, 'Maaf', ["positionClass" => "toast-top-center"]);

            return redirect()->route('auth.login');
        }
        return $next($request);
    }
}
