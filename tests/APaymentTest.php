<?php

use PHPUnit\Framework\TestCase;


/**
 * 
 */
class APaymentTest extends TestCase
{
    protected $dfPayment;

    public function setUp()
    {
        $container = \Illuminate\Container\Container::getInstance();

        $container->bind(\Mortgage\Factory\RepaymentScheduleFactory::class, \Mortgage\Factory\DifferentiatedPaymentFactory::class);

        $this->dfPayment = $container->make(\Mortgage\DifferentiatedPayment::class, [
            'loanTerm' => 12,
            'loanAmount' => 8000000,
            'interestRate' => 14.5,
        ]);
    }

    /**
     * @test
     **/
    public function check_base_getters()
    {
        $this->assertEquals($this->dfPayment->getLoanTerm(), 12);
        $this->assertEquals($this->dfPayment->getLoanAmount(), 8000000);
        $this->assertEquals($this->dfPayment->getInterestRate(), 14.5);
    }

    /**
     * @test
     **/
    public function check_coefficient_and_main_dept()
    {
        $this->assertEquals($this->dfPayment->getMainDept(), 666666.6666666666);
        $this->assertEquals((round($this->dfPayment->getMainDept() * 100) / 100), 666666.67);

        $this->assertEquals($this->dfPayment->getPercentageRatio(), 1.2083333333333333);
    }

    /**
     * @test
     **/
    public function check_total_percent_and_amount()
    {
        $this->assertEquals($this->dfPayment->getPercentAmount(), 628333.33);
        $this->assertEquals($this->dfPayment->getTotalamount(), 8628333.33);
    }
}