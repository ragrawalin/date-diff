<?php
/**
 * Created by PhpStorm.
 * User: rahul
 * Date: 25/06/18
 * Time: 1:27 PM
 */

namespace App\Tests\Util;

use App\Util\DateDifference;
use PHPUnit\Framework\TestCase;

class DateDifferenceTest extends TestCase
{
    public function testGetDateDifference()
    {
        $dateDifference = new DateDifference();

        $testCases = [
            [ new \DateTime('1999-01-28'), new \DateTime('2018-03-21') ],
            [ new \DateTime('2003-01-28'), new \DateTime('2018-03-21') ],
            [ new \DateTime('2012-01-28'), new \DateTime('2013-03-21') ],
            [ new \DateTime('1999-01-28'), new \DateTime('2000-03-21') ],
        ];

        foreach($testCases as $testCase)
        {
            $result = $dateDifference->getDateDifference($testCase[0], $testCase[1]);

            $diff = date_diff($testCase[0], $testCase[1])->days;

            $this->assertEquals($result, $diff);
        }
    }
}
