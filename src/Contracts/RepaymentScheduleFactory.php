<?php

namespace Mortgage\Contracts;

use Mortgage\Mortgage;
/**
 * Производстов элементов погаешния по месяцам
 */
interface RepaymentScheduleFactory
{
    public function toCompute(Mortgage $mortgage);
}