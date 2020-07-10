<?php

namespace Yosmy\Currency;

/**
 * @di\service()
 */
class CalculateDeviation
{
    /**
     * https://www.geeksforgeeks.org/php-program-find-standard-deviation-array/
     *
     * @param array $amounts
     *
     * @return float
     */
    public function calculate(
        array $amounts
    ): float {
        $count = count($amounts);

        $variance = 0.0;

        // Calculating mean using array_sum() method
        $average = array_sum($amounts) / $count;

        foreach($amounts as $amount)
        {
            // Sum of squares of differences between all numbers and means.
            $variance += pow(($amount - $average), 2);
        }

        return (float) sqrt($variance / $count);
    }
}