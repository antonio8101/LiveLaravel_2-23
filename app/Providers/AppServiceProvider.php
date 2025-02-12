<?php

namespace App\Providers;

use App\Http\Controllers\FirstController;
use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Service\TradingFinance\TradingFinanceInfo;
use Service\TradingFinance\TradingFinanceInfoContract;
use Service\TradingFinance\TradingFinanceInfoWithCache;

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

//        $this->app->bind(TradingFinanceInfoContract::class, function (){
//            return new TradingFinanceInfo();
//        });

        $this->app->bind(TradingFinanceInfoContract::class, function (){
            return new TradingFinanceInfoWithCache();
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

        // Definition of Gate
        Gate::define('update-post', function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });

        // Registering policies
        Gate::policy(Post::class, PostPolicy::class);
    }
}
