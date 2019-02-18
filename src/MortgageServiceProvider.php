<?php

namespace Mortgage;

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
        
        $this->app->when(\Mortgage\DifferentiatedPayment::class)
                  ->needs(\Mortgage\Contracts\RepaymentScheduleFactory::class)
                  ->give(\Mortgage\Factory\DifferentiatedPayment::class);

        $this->app->when(\Mortgage\Annuity::class)
                  ->needs(\Mortgage\Contracts\RepaymentScheduleFactory::class)
                  ->give(\Mortgage\Factory\Annuity::class);

        // Facades
        $this->app->bind('DifferentiatedPayment', \Mortgage\DifferentiatedPayment::class);
        $this->app->bind('Annuity', \Mortgage\DifferentiatedPayment::class);

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
