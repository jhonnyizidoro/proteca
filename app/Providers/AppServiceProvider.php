<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use App\Models\Event;
use Schema;
use Auth;
use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
		Paginator::defaultView('partials.pagination.pagination');
		
		Blade::if('hasevent', function () {
			return Event::where('date', '>=', date('Y-m-d'))->first();
		});

		Blade::if('admin', function () {
			return Auth::user()->hasTheRole('admin');
		});

		if (env('APP_ENV') != 'development') {
			URL::forceScheme('https');
		}

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
