<?php

namespace Mortgage;

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
     * @param integer $loanTerm
     * @param integer $loanAmount
     * @param mixed $interestRate
     */
    function __construct($loanTerm, $loanAmount, $interestRate)
    {
        $this->loanTerm     = $loanTerm;
        $this->loanAmount   = $loanAmount;
        $this->interestRate = $interestRate;
    }
    
    /**
     * Retrieves loan term
     * 
     * @return integer
     */
    public function getLoanTerm()
    {
        return $this->loanTerm;
    }

    /**
     * Retrieves loan Amount
     * 
     * @return integer
     */
    public function getLoanAmount()
    {
        return $this->loanAmount;
    }
    
    /**
     * Retrieves interest rate
     * 
     * @return mixed [integer/float]
     */
    public function getInterestRate()
    {
        return $this->interestRate;
    }

    /**
     * Сalculates the percentage
     * 
     * @return flaot
     */
    private function getPercentageRatio()
    {
        return $this->interestRate / 12;
    }

    /**
     * Сalculates main dept by month
     * 
     * @return float
     */
    private function getMainDept()
    {
        return $this->loanAmount / $this->loanTerm;
    }
    
}