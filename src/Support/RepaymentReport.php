<?php

namespace Mortgage\Support;


class RepaymentReport
{
    /**
     * Month index for repayment
     * 
     * @var integer
     */
    private $termInMonth;

    /**
     * dept = percent + main dept
     * 
     * @var integer
     */
    private $totoalDept;

    /**
     * Only percent dept
     * 
     * @var integer
     */
    private $percentDept;

    /**
     * Debt without percent
     * 
     * @var integer
     */
    private $mainDept;

    /**
     * Balance owed
     * 
     * @var integer
     */
    private $indebtedness;
    
    /**
     * Init repayments for per month
     * 
     * @param integer/float $termInMonth
     * @param integer/float $totoalDept
     * @param integer/float $percentDept
     * @param integer/float $mainDept
     * @param integer/float $indebtedness
     */
    public function __construct($termInMonth, $totoalDept, $percentDept, $mainDept, $indebtedness)
    {
        $this->termInMonth  = $termInMonth;

        $this->totoalDept   = $totoalDept;

        $this->percentDept  = $percentDept;

        $this->mainDept     = $mainDept;

        $this->indebtedness = $indebtedness;
    }
}