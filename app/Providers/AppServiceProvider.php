<?php

namespace ProjectApp\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use ProjectApp\Menu;
use ProjectApp\Notification;

// use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Schema::defaultStringLength(191);

        View::composer("theme.lte.aside", function ($view) {
            $menus = Menu::getMenu(true);
            $view->with('menusComposer', $menus);
        });
        View::share('theme', 'lte');

        // View::share('numberAlert', Notification::numberAlert());
        // \Carbon::setLocale(config('app.locale'));
    }
}
