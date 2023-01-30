<?php

namespace App\Providers;
use DB;
use View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

    public function register()
    {
        //
    }
    
    public function boot() {
        $config['contact_popup'] = DB::table('settings')->where('type', 'Contact Popup')->get();
        $config['social_links'] = DB::table('settings')->where('type', 'Social Links')->get();

        View::composer('includes.layout', function ($view) use ($config) {
            $view->with('config', $config);
        });
    }

}
