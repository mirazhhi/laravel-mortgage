<?php

namespace Mortgage\Contracts;

use Mortgage\Mortgage;
/**
 * Производстов элементов погаешния по месяцам
 */
interface RepaymentSchedule
{
    public function toCompute(Mortgage $mortgage);
}