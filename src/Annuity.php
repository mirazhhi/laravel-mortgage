<?php

namespace Mortgage;

use Mortgage\Mortgage;
use Mortgage\Contracts\RepaymentSchedule;
use Mortgage\Support\EffectiveRate;

class Annuity extends Mortgage
{
    /**
     * This object will produce
     * a repayment schedule for each month
     * 
     * @var object
     */
    private $repaymentSchedule;

    /**
     * This object will calculate
     * the annual effective rate
     * 
     * @var object
     */
    private $effectiveRate;
    
    /**
     * Initialize the default value and inject schedule with effective Rate
     * 
     * @param RepaymentSchedule $RepaymentSchedule
     * @param EffectiveRate     $effectiveRate
     * @param integer           $loanTerm
     * @param integer           $loanAmount
     * @param integer           $interestRate
     */
    function __construct(RepaymentSchedule $repaymentSchedule, EffectiveRate $effectiveRate)
    {
        parent::__construct(config('mortgage.loanTerm'), config('mortgage.loanAmount'), config('mortgage.interestRate'));

        $this->repaymentSchedule = $repaymentSchedule->toCompute($this);

        $this->effectiveRate = $effectiveRate;
    }

    /**
     * Displays the repayment schedule for the entire period
     * 
     * @return array
     */
    public function showRepaymentSchedule()
    {
        return collect($this->repaymentSchedule['repaymentScheduleResult']);
    }

    /**
     * Total amount in percent
     * 
     * @return integer
     */
    public function getPercentAmount()
    {
       return $this->repaymentSchedule['totalPercentDept']; 
    }

    /**
     * Effective rate in percent
     * 
     * @return integer
     */
    public function effectiveRate()
    {
        return $this->effectiveRate->toCompute($this->repaymentSchedule['deptValues']);
    }

    /**
     * Total amount with percent
     * in the other words it [ percent dept + loan amount]
     * 
     * @return integer
     */
    public function getTotalamount()
    {
        return $this->repaymentSchedule['totalPercentDept'] + $this->loanAmount;
    }

    /**
     * mortgageType
     *
     * @return void
     */
    public function mortgageType()
    {
        return 'Annuity Payment';
    }
}

