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
        //           
        // $mortgage = $this->app->make(\Mortgage\DifferentiatedPayment::class, [
        //     'loanTerm' => 48,
        //     'loanAmount' => 8000000,
        //     'interestRate' => 18,
        // ]);

        // dd($mortgage->showRepaymentSchedule());
        // dd(new \Mortgage\DifferentiatedPayment(48, 8000000, 18));
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {


        // $this->publishes([
        //     __DIR__ . '/../config/mortgage.php' => config_path('mortgage.php'),
        // ]);
    }
}
