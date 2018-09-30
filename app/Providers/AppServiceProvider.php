<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use App\Event;

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
			return auth()->user()->hasTheRole('admin');
		});

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
