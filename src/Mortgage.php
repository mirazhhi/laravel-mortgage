<?php

namespace Mhiggster\Mortgage;

/**
 * Надо будет переименовать 
 */
abstract class Mortgage
{


    protected $loanTerm = 12; // default value
    
    protected $loanAmount = 8000000;
    
    protected $interestRate = 14.5;



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