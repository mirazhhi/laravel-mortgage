<?php

namespace Mortgage;

/**
 * Class Mortgage
 * @package Mortgage
 */
abstract class Mortgage
{
    /**
     * The period when the debtor
     * must pay off the debt
     *
     * @var integer
     */
    protected $loanTerm;

    /**
     * Customer loan amount
     *
     * @var integer
     */
    protected $loanAmount;

    /**
     * Interest rate - provided by creditor/lender
     *
     * @var float
     */
    protected $interestRate;

    /**
     * Initializes the main parameters
     *
     * @param int $loanTerm
     * @param int $loanAmount
     * @param int $interestRate
     */
    function __construct(int $loanTerm, int $loanAmount, int $interestRate)
    {
        $this->setViscera($loanTerm, $loanAmount, $interestRate);
    }

    /**
     * Retrieves loan term
     *
     * @return integer
     */
    public function getLoanTerm() : int
    {
        return $this->loanTerm;
    }

    /**
     * Retrieves loan Amount
     *
     * @return integer
     */
    public function getLoanAmount() : int
    {
        return $this->loanAmount;
    }

    /**
     * Retrieves interest rate
     *
     * @return mixed [integer/float]
     */
    public function getInterestRate() : int
    {
        return $this->interestRate;
    }

    /**
     * Сalculates the percentage
     *
     * @return int
     */
    public function getPercentageRatio() : int
    {
        return $this->interestRate / 12;
    }

    /**
     * Сalculates main dept by month
     *
     * @return float
     */
    public function getMainDept()
    {
        return $this->loanAmount / $this->loanTerm;
    }


    /**
     * setCredits
     *
     * @param $loanTerm
     * @param $loanAmount
     * @param $interestRate
     * @return void
     */
    public function setViscera($loanTerm, $loanAmount, $interestRate)
    {
        $this->loanTerm     = $loanTerm;
        $this->loanAmount   = $loanAmount;
        $this->interestRate = $interestRate;
    }

    /**
     * showRepaymentSchedule
     *
     * @return void
     */
    abstract public function showRepaymentSchedule();

    /**
     * getPercentAmount
     *
     * @return void
     */
    abstract public function getPercentAmount();

    /**
     * effectiveRate
     *
     * @return void
     */
    abstract public function effectiveRate();

    /**
     * getTotalamount
     *
     * @return void
     */
    abstract public function getTotalamount();
}
