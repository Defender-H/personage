<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // 使用基于类的 composer...
        View::composer(
            'admin/base/base', 'App\Http\ViewComposers\ProfileComposer'
        );

//        view()->composer('admin/base/base','App\Http\ViewComposers\ProfileComposer@foobar');

//        // 使用基于闭包的 composers...
//        View::composer('dashboard', function ($view) {
//            //
//        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
        // ...
    }
}
