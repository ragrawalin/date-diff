<?php
/**
 * Created by PhpStorm.
 * User: rahul
 * Date: 25/06/18
 * Time: 1:24 PM
 */

namespace App\Util;

use PHPUnit\Framework\Exception;
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
     * If use of DateTime class is not permitted, we could also use date in string format and split on '-'
     * to get individual year, month & date. I have used DateTime class just to hold values of fromDate
     * and toDate fields, and get year, month and day from dates. But all the calculations are done separately.
     *
     * $fromDate and $toDate are expected to be in YYYY-MM-DD format.
     *
     * @param \DateTime|string $fromDate
     * @param \DateTime|string $toDate
     * @return int
     */
    public function getDateDifference($fromDate, $toDate): int
    {
        return abs($this->getDaysForDate($toDate) - $this->getDaysForDate($fromDate));
    }

    /**
     * Calculates total number of days in the given date.
     *
     * @param \DateTime|string $date
     * @return int
     */
    private function getDaysForDate($date): int
    {
        if($date instanceof \DateTime)
        {
            $day = (int) $date->format('d');
            $month = (int) $date->format('m');
            $year = (int) $date->format('Y');
        }
        else
        {
            if(!$this->validateDate($date))
            {
                throw new Exception("Invalid date format or invalid date. Please use YYYY-MM-DD format.", 101);
            }
            else
            {
                $temp = explode("-", $date);

                $year = (int) $temp[0];
                $month = (int) $temp[1];
                $day = (int) $temp[2];
            }
        }

        $totalDays = (($year * $this::YEAR_DAYS) + $day);

        for($i = 0; $i < $month - 1; $i++)
        {
            $totalDays += $this::MONTH_DAYS[$i];
        }

        $totalDays += $this->countLeapYears($year, $month);

        return $totalDays;
    }

    /**
     * Checks the format of the date.
     *
     * @param string $date
     * @return bool
     */
    private function validateDate($date)
    {
        $datePattern = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])/";

        return preg_match($datePattern, $date);
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

        $leapYears = floor($year / 4);
        $leapYears -= floor($year / 100);
        $leapYears += floor($year / 400);

        return $leapYears;
    }
}