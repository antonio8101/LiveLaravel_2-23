<?php

namespace App\Providers;

use App\ContactRepository;
use App\Models\User;
use App\RepositoryContract;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RepositoryContract::class, ContactRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::bind('user', function($username) {
            return User::where( 'name', $username)->firstOrFail();
        });
    }
}
