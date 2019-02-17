<?php

namespace Mortgage;

use Mortgage\Credits\Mortgage;
use Mortgage\Factory\RepaymentScheduleFactory;
use Mortgage\Support\EffectiveRate;

class Annuity extends Mortgage
{
    private $repaymentScheduleFactory;
    private $effectiveRate;
    // i thin there will be the interface
    function __construct(RepaymentScheduleFactory $repaymentScheduleFactory, EffectiveRate $effectiveRate, $loanTerm, $loanAmount, $interestRate)
    {

        parent::__construct($loanTerm, $loanAmount, $interestRate);

        $this->repaymentScheduleFactory = $repaymentScheduleFactory->toCompute($this);

        $this->effectiveRate = $effectiveRate;
    }

    public function showRepaymentSchedule()
    {
        // dd($this->repaymentScheduleFactory);
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

