<?php

namespace Yosmy\Currency\Oer;

use Yosmy;

/**
 * @di\service()
 */
class ResolveHistorical implements Yosmy\Currency\ResolveHistorical
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
    public function resolve(
        string $to,
        array $dates
    ): array {
        $historical = [];

        foreach ($dates as $date) {
            $response = $this->executeRequest->execute(
                sprintf('historical/%s', $date),
                [
                    'base' => 'USD',
                    'symbols' => $to
                ]
            );

            $historical[] = $response['rates'][$to];
        }

        return $historical;
    }
}