<?php

namespace Yosmy\Currency\Oer;

use Yosmy;

/**
 * https://openexchangerates.org/
 *
 * @di\service()
 */
class ConvertAmount implements Yosmy\Currency\ConvertAmount
{
    /**
     * @var ExecuteRequest
     */
    private $executeRequest;

    /**
     * @param ExecuteRequest $executeRequest
     */
    public function __construct(ExecuteRequest $executeRequest)
    {
        $this->executeRequest = $executeRequest;
    }

    /**
     * {@inheritDoc}
     */
    public function convert(
        string $to,
        float $amount,
        int $decimals
    ): float {
        $response = $this->executeRequest->execute(
            'latest',
            [
                'symbols' => $to
            ]
        );

        $rate = $response['rates'][$to];

        $amount = $rate * $amount;

        $amount = number_format($amount, $decimals, '.', '');

        return $amount;
    }
}