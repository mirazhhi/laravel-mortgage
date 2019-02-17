<?php

namespace Mhiggster\Mortgage\Contracts;

use Mortgage\Credits\Mortgage;
/**
 * Производстов элементов погаешния по месяцам
 */
interface RepaymentScheduleFactory
{
    public function toCompute(Mortgage $mortgage);
}