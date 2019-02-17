<?php

namespace Mortgage\Support;


class EffectiveRate
{
    const FINANCIAL_MAX_ITERATIONS = 128;
    const FINANCIAL_ACCURACY = 1.0e-08;


    // Вынести в отдельный класс и внедрить как зависемость
    private function DATEDIFF($datepart, $startdate, $enddate)
    {
        switch (strtolower($datepart)) {
            case 'yy':
            case 'yyyy':
            case 'year':
                $di = getdate($startdate);
                $df = getdate($enddate);
                return $df['year'] - $di['year'];
                break;
            case 'q':
            case 'qq':
            case 'quarter':
                die("Unsupported operation");
                break;
            case 'n':
            case 'mi':
            case 'minute':
                return ceil(($enddate - $startdate) / 60); 
                break;
            case 'hh':
            case 'hour':
                return ceil(($enddate - $startdate) / 3600); 
                break;
            case 'd':
            case 'dd':
            case 'day':
                return ceil(($enddate - $startdate) / 86400); 
                break;
            case 'wk':
            case 'ww':
            case 'week':
                return ceil(($enddate - $startdate) / 604800); 
                break;
            case 'm':
            case 'mm':
            case 'month':
                $di = getdate($startdate);
                $df = getdate($enddate);
                return ($df['year'] - $di['year']) * 12 + ($df['mon'] - $di['mon']);
                break;
            default:
                die("Unsupported operation");
        }
    }

    private function XNPV($rate, $values, $dates)
    {
        if ((!is_array($values)) || (!is_array($dates))) return null;
        if (count($values) != count($dates)) return null;

        $xnpv = 0.0;
        for ($i = 0; $i < count($values); $i++)
        {
            $xnpv += $values[$i] / pow(1 + $rate, $this->DATEDIFF('day', $dates[0], $dates[$i]) / 365);
        }
        return (is_finite($xnpv) ? $xnpv: null);
    }

    private function XIRR($values, $dates, $guess = 0.1)
    {
        if ((!is_array($values)) && (!is_array($dates))) return null;
        if (count($values) != count($dates)) return null;

        // create an initial bracket, with a root somewhere between bot and top
        $x1 = 0.0;
        $x2 = $guess;
        $f1 = $this->XNPV($x1, $values, $dates);
        $f2 = $this->XNPV($x2, $values, $dates);
        for ($i = 0; $i < self::FINANCIAL_MAX_ITERATIONS; $i++)
        {
            if (($f1 * $f2) < 0.0) break;
            if (abs($f1) < abs($f2)) {
                $f1 = $this->XNPV($x1 += 1.6 * ($x1 - $x2), $values, $dates);
            } else {
                $f2 = $this->XNPV($x2 += 1.6 * ($x2 - $x1), $values, $dates);
            }
        }
        if (($f1 * $f2) > 0.0) return null;

        $f = $this->XNPV($x1, $values, $dates);
        if ($f < 0.0) {
            $rtb = $x1;
            $dx = $x2 - $x1;
        } else {
            $rtb = $x2;
            $dx = $x1 - $x2;
        }

        for ($i = 0;  $i < self::FINANCIAL_MAX_ITERATIONS; $i++)
        {
            $dx *= 0.5;
            $x_mid = $rtb + $dx;
            $f_mid = $this->XNPV($x_mid, $values, $dates);
            if ($f_mid <= 0.0) $rtb = $x_mid;
            if ((abs($f_mid) < self::FINANCIAL_ACCURACY) || (abs($dx) < self::FINANCIAL_ACCURACY)) return $x_mid;
        }
        return null;
    }



    public function toCompute($deptValues)
    {
        $dates = [];

        for ($m = 0; $m < count($deptValues); $m++) {
            array_push($dates, mktime(0, 0, 0, date('n') + $m, 1, date('Y')));
        }
        return round($this->XIRR($deptValues, $dates, 0.1) * 100, 2);
    }
}