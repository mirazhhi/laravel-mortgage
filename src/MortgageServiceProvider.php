<?php

namespace Mhiggster\Mortgage;

use Illuminate\Support\ServiceProvider;

class MortgageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/mortgage.php' => config_path('mortgage.php'),
        ]);
    }
}
