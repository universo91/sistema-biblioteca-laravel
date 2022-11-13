<?php

namespace App\Providers;

use App\Models\Admin\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer("theme.lte.aside", function($view) {
            $menus = Menu::getMenu( true );
            $view->with('menuscomposer', $menus);
        });
        // Con esto logramos compartir esta variable a través de todas las
        // vistas. Por supuesto, necesitamos que esta línea de código sea
        // ejecutada antes y para ello Laravel te recomienda utilizar el
        // método boot de un Service Provider de tu aplicación, por ejemplo
        // AppServiceProvider:
        View::share('theme', 'lte');
    }
}
