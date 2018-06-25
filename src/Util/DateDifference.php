<?php
/**
 * Created by PhpStorm.
 * User: rahul
 * Date: 25/06/18
 * Time: 1:24 PM
 */

namespace App\Util;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DateDifference extends Controller
{

    const MONTH_DAYS = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

    /**
     * @param \DateTime $fromDate
     * @param \DateTime $toDate
     * @return int
     */
    public function getDateDifference($fromDate, $toDate): int
    {
        return $this->getDays($toDate) - $this->getDays($fromDate);
    }

    /**
     * @param \DateTime $date
     * @return int
     */
    private function getDays($date): int
    {
        $day = (int) $date->format('d');
        $month = (int) $date->format('m');
        $year = (int) $date->format('Y');

        $totalDays = (($year * 365) + $day);

        for($i = 0; $i < $month - 1; $i++)
        {
            $totalDays += $this::MONTH_DAYS[$i];
        }

        $totalDays += $this->countLeapYears($year, $month);

        return $totalDays;
    }

    /**
     * @param int $year
     * @param int $month
     * @return int
     */
    private function countLeapYears($year, $month)
    {
        if($month <= 2) $year--;

        return $year / 4 - $year / 100 + $year / 400;
    }
}