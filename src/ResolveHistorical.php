<?php

namespace Yosmy\Currency;

interface ResolveHistorical
{
    /**
     * @param string   $to
     * @param string[] $dates
     *
     * @return array
     */
    public function resolve(
        string $to,
        array $dates
    ): array;
}