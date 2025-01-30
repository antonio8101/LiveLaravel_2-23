<?php

namespace MyApp;

use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RepositoryContract::class, ContactRepository::class); // transient binding -- istanze diverse
        // $this->app->singleton(RepositoryContract::class, ContactRepository::class); // singleton binding -- sempre la stessa istanza
        // $this->app->scoped(RepositoryContract::class, ContactRepository::class); // scoped binding -- sempre la stessa istanza SOLO NEL CONTESTO DELLA STESSA RICHIESTA
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
