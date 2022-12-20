<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use App\Models\Pages;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer('*', function($view)
        {
            $data = Setting::first();
            $header = Pages::where('header',1)->get();
            $footer = Pages::where('footer',1)->get();
            $view->with('data', ['data'=>$data,'header'=>$header,'footer'=>$footer]);
        });
    }
}
