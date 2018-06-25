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
    const YEAR_DAYS = 365;

    /**
     * Calculates total number of days between 2 given dates. Idea is to
     * calculate number of days in both given dates separately and subtract them to get total
     * number of days between both the dates.
     *
     * @param \DateTime $fromDate
     * @param \DateTime $toDate
     * @return int
     */
    public function getDateDifference($fromDate, $toDate): int
    {
        return $this->getDaysForDate($toDate) - $this->getDaysForDate($fromDate);
    }

    /**
     * Calculates total number of days in the given date.
     *
     * @param \DateTime $date
     * @return int
     */
    private function getDaysForDate($date): int
    {
        $day = (int) $date->format('d');
        $month = (int) $date->format('m');
        $year = (int) $date->format('Y');

        $totalDays = (($year * $this::YEAR_DAYS) + $day);

        for($i = 0; $i < $month - 1; $i++)
        {
            $totalDays += $this::MONTH_DAYS[$i];
        }

        $totalDays += $this->countLeapYears($year, $month);

        return $totalDays;
    }

    /**
     * Counts total number of leap years from start to given year.
     * Leap year is calculated by subtracting number of years divisible by 100 from number of years divisible by 4
     * and adding number of years divisible by 400. We need to ignore number of years which are divisible by 100
     * but not by 400 as they are not considered leap years.
     *
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