<?php

namespace Mortgage\Support;


class RepaymentReport
{
    /**
     * [$termInMonth description]
     * @var [type]
     */
    
    private $termInMonth;
    /**
     * [$totoalDept description]
     * @var [type]
     */
    
    private $totoalDept;
    /**
     * [$percentDept description]
     * @var [type]
     */
    
    private $percentDept;
    /**
     * [$mainDept description]
     * @var [type]
     */
    
    private $mainDept;
    /**
     * [$indebtedness description]
     * @var [type]
     */
    
    private $indebtedness;
    
    /**
     * [__construct description]
     * @param [type] $termInMonth  [description]
     * @param [type] $totoalDept   [description]
     * @param [type] $percentDept  [description]
     * @param [type] $mainDept     [description]
     * @param [type] $indebtedness [description]
     */
    public function __construct($termInMonth, $totoalDept, $percentDept, $mainDept, $indebtedness) {
        $this->termInMonth = $termInMonth;
        $this->totoalDept = $totoalDept;
        $this->percentDept = $percentDept;
        $this->mainDept = $mainDept;
        $this->indebtedness = $indebtedness;
    }
}