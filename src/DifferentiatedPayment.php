<?php

namespace Mortgage;

use Mortgage\Mortgage;
use Mortgage\Support\EffectiveRate;
use Mortgage\Contracts\RepaymentScheduleFactory;

class DifferentiatedPayment extends Mortgage
{
    /**
     * This object will produce
     * a repayment schedule for each month
     * 
     * @var object
     */
    private $repaymentScheduleFactory;

    /**
     * This object will calculate
     * the annual effective rate
     * 
     * @var object
     */
    private $effectiveRate;

    /**
     * TO DO
     * 
     * @param RepaymentScheduleFactory $repaymentScheduleFactory
     * @param EffectiveRate     $effectiveRate
     * @param integer           $loanTerm
     * @param integer           $loanAmount
     * @param integer           $interestRate
     */
    function __construct(RepaymentScheduleFactory $repaymentScheduleFactory, EffectiveRate $effectiveRate, $loanTerm = 48, $loanAmount = 8000000, $interestRate = 18)
    {
        // we get the default information from config another ways we get in the other method
        parent::__construct($loanTerm, $loanAmount, $interestRate);

        $this->repaymentScheduleFactory = $repaymentScheduleFactory->toCompute($this);

        $this->effectiveRate            = $effectiveRate;
    }

    /**
     * Displays the repayment schedule for the entire period
     * 
     * @return array
     */
    public function showRepaymentSchedule()
    {
        return $this->repaymentScheduleFactory['repaymentScheduleResult'];
    }
    
    /**
     * Total amount in percent
     * 
     * @return integer
     */
    public function getPercentAmount()
    {
       return $this->repaymentScheduleFactory['totalPercentDept']; 
    }

    /**
     * Effective rate in percent
     * 
     * @return integer
     */
    public function effectiveRate()
    {
        return $this->effectiveRate->toCompute($this->repaymentScheduleFactory['deptValues']);
    }


    /**
     * Total amount with percent
     * in the other words it [ percent dept + loan amount]
     * 
     * @return integer
     */
    public function getTotalamount()
    {
        return $this->repaymentScheduleFactory['totalPercentDept'] + $this->loanAmount;
    }
}



