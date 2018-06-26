<?php
/**
 * Created by PhpStorm.
 * User: rahul
 * Date: 25/06/18
 * Time: 1:27 PM
 */

namespace App\Tests\Util;

use App\Util\DateDifference;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;

class DateDifferenceTest extends TestCase
{
    /**
     * This test compares result of getDateDifference function in DateDifference class with
     * output from inbuilt date_diff function.
     */
    public function testGetDateDifference()
    {
        $dateDifference = new DateDifference();

        // Hard coded test cases
        $testCases = [
            [ new \DateTime('1999-01-28'), new \DateTime('2018-03-21') ],
            [ new \DateTime('2003-01-28'), new \DateTime('2018-03-21') ],
            [ new \DateTime('2012-01-28'), new \DateTime('2013-03-21') ],
            [ new \DateTime('1999-05-28'), new \DateTime('2000-03-21') ],
            [ new \DateTime('1290-05-16'), new \DateTime('2702-10-02') ],
            [ new \DateTime('1975-09-07'), new \DateTime('0673-01-15') ],
        ];

        // Some randomly generated test cases for more comprehensive testing
        for($i = 0; $i < 4; $i++)
        {
            $testCase = [ new \DateTime($this->getRandomDate()), new \DateTime($this->getRandomDate()) ];
            array_push($testCases, $testCase);
        }

        foreach($testCases as $testCase)
        {
            $result = $dateDifference->getDateDifference($testCase[0], $testCase[1]);

            $diff = abs(date_diff($testCase[0], $testCase[1])->days);

            $this->assertEquals($result, $diff);
        }
    }

    public function testInvalidDateFormat()
    {
        $dateDifference = new DateDifference();

        $testCases = [
            ['1999-01-32', '2018-03-21'],
            ['1999-13-31', '2018-03-21'],
            ['11999-13-31', '2018-03-21'],
        ];

        foreach ($testCases as $testCase)
        {
            $this->expectException(Exception::class);
            $dateDifference->getDateDifference($testCase[0], $testCase[1]);
        }
    }
    /**
     * @return string
     */
    private function getRandomDate()
    {
        $day = rand(1, 28);
        $month = rand(1, 12);
        $year = rand(1, 3000);

        return $year . "-" . $month . "-" . $day;
    }

}
