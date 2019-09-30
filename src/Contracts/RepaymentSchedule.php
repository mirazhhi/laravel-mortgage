<?php

namespace Mortgage\Contracts;

use Mortgage\Mortgage;

interface RepaymentSchedule
{
    /**
     * Calculate the full mortgage schedule
     * 
     * @param  Mortgage $mortgage
     * @return array
     */
    public function toCompute(Mortgage $mortgage);
}