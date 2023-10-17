<?php

namespace App\Providers;

use App\Interfaces\ResponseInterface;
use App\Services\JsonResponse;
use App\Services\ViewResponse;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		if (request()->ajax()) {
			$this->app->bind(ResponseInterface::class, ViewResponse::class);
		} else {
			$this->app->bind(ResponseInterface::class, JsonResponse::class);
		}
    }
}
