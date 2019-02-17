<?php

namespace Mortgage;


use Mortgage\Mortgage;
use Mortgage\Contracts\RepaymentSchedule;
use Mortgage\Support\EffectiveRate;
/**
 * 
 */
class DifferentiatedPayment extends Mortgage
{
    private $repaymentScheduleFactory;
    private $effectiveRate;
    // i thin there will be the interface
    
    function __construct(RepaymentSchedule $repaymentScheduleFactory, EffectiveRate $effectiveRate, $loanTerm = 48, $loanAmount = 8000000, $interestRate = 18)
    {
// 48, 8000000, 18
        parent::__construct($loanTerm, $loanAmount, $interestRate);

        $this->repaymentScheduleFactory = $repaymentScheduleFactory->toCompute($this);

        $this->effectiveRate = $effectiveRate;
    }

    // function __construct(RepaymentSchedule $repaymentScheduleFactory, EffectiveRate $effectiveRate, $loanTerm, $loanAmount, $interestRate)
    // {

    //     parent::__construct($loanTerm, $loanAmount, $interestRate);

    //     $this->repaymentScheduleFactory = $repaymentScheduleFactory->toCompute($this);

    //     $this->effectiveRate = $effectiveRate;
    // }


    public function showRepaymentSchedule()
    {
        // use the Schedule dependens
        return $this->repaymentScheduleFactory['repaymentScheduleResult'];
    }
    
    // итоговая сумма в процентах
    public function getPercentAmount()
    {
       return $this->repaymentScheduleFactory['totalPercentDept']; 
    }


    public function effectiveRate()
    {

        return $this->effectiveRate->toCompute($this->repaymentScheduleFactory['deptValues']);
    }


    // итоговая сумма
    public function getTotalamount()
    {
        return $this->repaymentScheduleFactory['totalPercentDept'] + $this->loanAmount;
    }
}



