<?php

namespace Mortgage\Schedules;

use Mortgage\Mortgage;
use Mortgage\Contracts\RepaymentSchedule;

class DifferentiatedSchedule implements RepaymentSchedule
{
    /**
     * Detailed repayment schedule
     * 
     * @var array
     */
    private $repaymentScheduleResult = [];

    /**
     * The amount you need to pay
     * for the current month
     * 
     * @var integer
     */
    private $mainDeptByMonth;

    /**
     * How much is left to pay
     * for the entire period
     * 
     * @var integer
     */
    private $loanAmount;

    /**
     * How much is left to pay
     * from the current month
     * 
     * @var integer
     */
    private $loanAmountInMonth;

    /**
     * main dept by month
     * 
     * @var integer
     */
    private $mainDept;

    /**
     * dept by percent
     * 
     * @var integer
     */
    private $percentDept;

    /**
     * total percent dept for the entire period
     * 
     * @var integer
     */
    private $totalPercentDept;

    /**
     * total dept for the entire period with percent
     * 
     * @var integer
     */
    private $totalDept;

    /**
     * negative debt by month
     * 
     * @var array
     */
    private $deptValues = [];

    /**
     * To compute and set percent dept
     * 
     * @param  float $percentageRatio
     * @return object
     */
    private function percentDeptCompute($percentageRatio)
    {
        $this->percentDept = ($this->loanAmountInMonth * $percentageRatio) / 100;
        $this->totalPercentDept += $this->percentDept;
        return $this;
    }

    /**
     * To compute and set total dept
     * 
     * @return object
     */
    private function totalDeptCompute()
    {
        $this->totalDept = $this->percentDept + $this->mainDept;
        array_push($this->deptValues, ($this->numbRound($this->totalDept) * -1));
        return $this;
    }

    /**
     * Set the initial parameters
     * 
     * @param  Mortgage $mortgage \Mortgage\Mortgage
     * @return void
     */
    private function baseMount($mortgage)
    {
        $this->mainDept          = $mortgage->getMainDept();
        $this->loanAmount        = $mortgage->getLoanAmount();
        $this->loanAmountInMonth = $mortgage->getLoanAmount();
        $this->percentDept       = 0;
        $this->totalPercentDept  = 0;
        $this->totalDept         = 0;
        $this->mainDeptByMonth   = 0;

        array_push($this->deptValues, $this->numbRound($this->loanAmount));
    }

    /**
     * To compute and set main dept by month
     * and loan amount in month
     * 
     * @param  integer $monthIndex 
     * @param  Mortgage $mortgage \Mortgage\Mortgage
     * @return object
     */
    private function loanAmountCompute($monthIndex, Mortgage $mortgage)
    {
        $this->mainDeptByMonth = $this->mainDept * $monthIndex;
        $this->loanAmountInMonth = $this->loanAmount - $this->mainDeptByMonth;
        return $this;
    }

    /**
     * Just round the number
     * 
     * @param  integer $repNumb
     * @return void
     */
    private function numbRound($repNumb)
    {
        return round($repNumb * 100) / 100;
    }

    /**
     * Сreate a new instance of the schedule
     * 
     * @param  integer $monthIndex
     * @return object
     */
    private function createSchedule($monthIndex)
    {

        return new \Mortgage\Support\RepaymentReport(
            $monthIndex, 
            $this->numbRound($this->totalDept),
            $this->numbRound($this->percentDept),
            $this->numbRound($this->mainDept),
            $this->numbRound($this->loanAmountInMonth)
        );
    }

    /**
     * Calculate the full mortgage schedule
     * 
     * @param  Mortgage $mortgage
     * @return array
     */
    public function toCompute(Mortgage $mortgage)
    {

        $this->baseMount($mortgage);

        for ($monthIndex = 1; $monthIndex <= $mortgage->getLoanTerm(); $monthIndex++) {

            $this->percentDeptCompute($mortgage->getPercentageRatio())
                 ->loanAmountCompute($monthIndex, $mortgage)
                 ->totalDeptCompute();

            array_push($this->repaymentScheduleResult, $this->createSchedule($monthIndex));
        }

        return [
            'repaymentScheduleResult' => $this->repaymentScheduleResult,
            'totalPercentDept' => $this->numbRound($this->totalPercentDept),
            'deptValues' => $this->deptValues,
        ];
    }
}