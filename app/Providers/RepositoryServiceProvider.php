<?php

namespace App\Providers;

use App\Interfaces\BorrowingRepositoryInterface;
use App\Repositories\BorrowingRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
		$this->app->bind(BorrowingRepositoryInterface::class, BorrowingRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
