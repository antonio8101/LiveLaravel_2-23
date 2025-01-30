<?php

namespace App\Providers;

use App\Http\Controllers\FirstController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->when(FirstController::class)->needs('$param1')->give("PIPPO");
        $this->app->when(FirstController::class)->needs('$p1')->give("PIPPO");
        
        $this->app->when(FirstController::class)->needs('$p1')->give(function(){
            return [
                "x1",
                "x2",
                "x3"
            ];
        });
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
