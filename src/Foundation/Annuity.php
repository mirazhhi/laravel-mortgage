<?php

namespace Mortgage\Foundation;

use Mortgage\Mortgage;
use Mortgage\Contracts\RepaymentSchedule;
/**
 * График погошения
 * Он будет интерфейсом
 * !! Переименовать
 */
class Annuity implements RepaymentSchedule
{

    private $repaymentScheduleResult = [];

    private $mainDeptByMonth;

    // Задолжность
    private $loanAmount;
    private $loanAmountInMonth;

    // Основной долг
    private $mainDept;
    // Долг в процентах
    private $percentDept;
    private $totalPercentDept;
    // Общий долг
    private $totalDept;


    private $deptValues = [];



    private function percentDeptCompute($percentageRatio)
    {
        $this->percentDept = $this->numbRound(($this->loanAmountInMonth * $percentageRatio) / 100);
        $this->totalPercentDept += $this->percentDept;
        return $this;
    }

    // rename this function
    private function totalDeptCompute($mortgage)
    {

        $percentRate           = (($mortgage->getInterestRate() / 100 ) / 12);
        $exponentExpression    = pow((1 + $percentRate), $mortgage->getLoanTerm());
        // dd($exponentExpression);
        $upAnuitetExpression   = $percentRate * $exponentExpression;
        $downAnuitetExpression = $exponentExpression - 1;
        $anuitet               = $upAnuitetExpression / $downAnuitetExpression;

        $this->totalDept = $this->numbRound($anuitet * $mortgage->getLoanAmount());
        

        return $this;

        // $this->totalDept = $this->percentDept + $this->mainDept;
        // array_push($this->deptValues, ($this->numbRound($this->totalDept) * -1));
        // return $this;
    }

    private function setMainDept()
    {
        // dd($this->totalDept);
        // dd($this->totalDept);
        // dd($this->percentDept);
        $this->mainDept = $this->totalDept - $this->percentDept;
        return $this;
    }

    private function baseMount($mortgage)
    {
        $this->mainDept = 0;

        $this->loanAmount = $mortgage->getLoanAmount();

        $this->loanAmountInMonth = $mortgage->getLoanAmount();

        $this->percentDept = 0;
        $this->totalPercentDept = 0;

        $this->totalDept = 0;

        $this->mainDeptByMonth = 0;


        array_push($this->deptValues, $this->numbRound($this->loanAmount));
    }


    private function loanAmountCompute($monthIndex, $mortgage)
    {
        $this->mainDeptByMonth = $this->mainDept * $monthIndex;
        $this->loanAmountInMonth = $this->loanAmount - $this->mainDeptByMonth;
        print_r($this->mainDept);
        echo "<br>";
        return $this;
    }


    private function numbRound($repNumb)
    {
        return round($repNumb * 100) / 100;
    }


    private function createSchedule($monthIndex)
    {
        // dd($this->percentDept);
        return new \Mortgage\Support\RepaymentReport(
            $monthIndex, 
            $this->numbRound($this->totalDept),
            $this->percentDept,
            $this->numbRound($this->mainDept),
            $this->numbRound($this->loanAmountInMonth)
        );
    }

    public function toCompute(Mortgage $mortgage)
    {

        $this->baseMount($mortgage);

        for ($monthIndex = 1; $monthIndex <= $mortgage->getLoanTerm(); $monthIndex++) {


            $this->totalDeptCompute($mortgage)
                 ->percentDeptCompute($mortgage->getPercentageRatio())
                 ->setMainDept()
                 ->loanAmountCompute($monthIndex, $mortgage);
                 // ->percentDeptCompute($mortgage->getPercentageRatio())
                 // ->loanAmountCompute($monthIndex, $mortgage)
                 
                 // ->setMainDept();
            // $this->percentDeptCompute($mortgage->getPercentageRatio())
            //      ->loanAmountCompute($monthIndex, $mortgage)
            //      ->totalDeptCompute($mortgage)
            //      ->setMainDept();
            
            array_push($this->repaymentScheduleResult, $this->createSchedule($monthIndex));
        }

        return [
            'repaymentScheduleResult' => $this->repaymentScheduleResult,
            'totalPercentDept' => $this->numbRound($this->totalPercentDept),
            'deptValues' => $this->deptValues,
        ];
    }


}