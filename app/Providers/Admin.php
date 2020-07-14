<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class Admin extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('isadmin', function($msg)
        {
            if(Auth::user())
            {
                $userRoles = Auth::user()->roles->pluck('nombre');

                if(!$userRoles->contains($msg))
                {
                    return false;
                }
                else
                {
                    return true;
                } 
            }
            else
            {
                return false;
            }
        });
    }
}
