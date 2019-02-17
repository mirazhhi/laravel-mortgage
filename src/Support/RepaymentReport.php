<?php

namespace Mortgage\Support;


class RepaymentReport
{
    
    private $termInMonth;
    private $totoalDept;
    private $percentDept;
    private $mainDept;
    private $indebtedness;
    
    
    public function __construct($termInMonth, $totoalDept, $percentDept, $mainDept, $indebtedness) {
        $this->termInMonth = $termInMonth;
        $this->totoalDept = $totoalDept;
        $this->percentDept = $percentDept;
        $this->mainDept = $mainDept;
        $this->indebtedness = $indebtedness;
    }
}