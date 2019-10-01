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
        $this->app->when(\Mortgage\Differentiated::class)
                  ->needs(\Mortgage\Contracts\RepaymentSchedule::class)
                  ->give(\Mortgage\Schedules\DifferentiatedSchedule::class);

        $this->app->when(\Mortgage\Annuity::class)
                  ->needs(\Mortgage\Contracts\RepaymentSchedule::class)
                  ->give(\Mortgage\Schedules\AnnuitySchedule::class);

        // Facades
        $this->app->bind('Differentiated', \Mortgage\Differentiated::class);
        $this->app->bind('Annuity', \Mortgage\Annuity::class);
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
