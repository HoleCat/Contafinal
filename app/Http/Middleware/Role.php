<?php

namespace App\Http\Middleware;

use Closure;
use FontLib\TrueType\Collection;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::user())
        {
            //return $request->session()->user;
            return redirect('login');
        }
        else
        {
            $userRoles = Auth::user()->roles->pluck('nombre');

            if(!$userRoles->contains('admin'))
            {
                return view('home');
            }
            return $next($request);
        }
    }
}
