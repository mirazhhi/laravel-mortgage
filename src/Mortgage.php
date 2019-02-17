<?php

namespace Mortgage;

abstract class Mortgage
{

    /**
     * the period when the debtor 
     * must pay off the debt
     * 
     * @var integer
     */
    protected $loanTerm = 12;
    
    /**
     * customer loan amount
     * 
     * @var integer
     */
    protected $loanAmount = 8000000;
    
    /**
     * interest rate - provided by creditor/lender
     * 
     * @var float
     */
    protected $interestRate = 14.5;


    /**
     * [__construct description]
     * @param integer $loanTerm
     * @param integer $loanAmount
     * @param integer $interestRate
     */
    function __construct($loanTerm, $loanAmount, $interestRate)
    {
        $this->loanTerm = $loanTerm;
        $this->loanAmount = $loanAmount;
        $this->interestRate = $interestRate;
    }
    
    // сроки кредитование
    public function getLoanTerm()
    {
        return $this->loanTerm;
    }

     //  Сумма займа
    public function getLoanAmount()
    {
        return $this->loanAmount;
    }
    
    // ставка вознограждения / процентная ставка
    public function getInterestRate()
    {
        return $this->interestRate;
    }

    // процентный коэффициент
    public function getPercentageRatio()
    {
        // return $this->interestRate / $this->loanTerm;
        return $this->interestRate / 12;
    }

    // Основной долг
    public function getMainDept()
    {
        return $this->loanAmount / $this->loanTerm;
    }
    
}