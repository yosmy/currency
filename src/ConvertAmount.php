<?php

namespace Yosmy\Currency;

interface ConvertAmount
{
    /**
     * @param string $to
     * @param float  $amount
     * @param int    $decimals
     *
     * @return float
     */
    public function convert(
        string $to,
        float $amount,
        int $decimals
    ): float;
}