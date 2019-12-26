<?php

namespace ProjectApp\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use ProjectApp\User;

class BladeExtrasServiceProvider extends ServiceProvider
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
        // permitir ver vista de cambio de roles solo a los admi
        Blade::if('hasrole', function($expression){
            if(Auth::user()){
                if(Auth::user()->hasAnyRole($expression)){
                    return true;
                }
            }
            return false;
        });
    }
}
