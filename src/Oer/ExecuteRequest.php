<?php

namespace Yosmy\Currency\Oer;

use Yosmy;

/**
 * https://openexchangerates.org/
 *
 * @di\service()
 */
class ExecuteRequest
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var Yosmy\Http\ExecuteRequest
     */
    private $executeRequest;

    /**
     * @var Yosmy\LogEvent
     */
    private $logEvent;

    /**
     * @var Yosmy\ReportError
     */
    private $reportError;

    /**
     * @di\arguments({
     *     key: "%oer_key%",
     * })
     *
     * @param string                    $key
     * @param Yosmy\Http\ExecuteRequest $executeRequest
     * @param Yosmy\LogEvent            $logEvent
     * @param Yosmy\ReportError         $reportError
     */
    public function __construct(
        string $key,
        Yosmy\Http\ExecuteRequest $executeRequest,
        Yosmy\LogEvent $logEvent,
        Yosmy\ReportError $reportError
    ) {
        $this->key = $key;
        $this->executeRequest = $executeRequest;
        $this->logEvent = $logEvent;
        $this->reportError = $reportError;
    }

    /**
     * @param string $uri
     * @param array  $params
     *
     * @return array
     */
    public function execute(
        string $uri,
        array $params
    ): array {
        $uri = sprintf('https://openexchangerates.org/api/%s.json', $uri);

        $request = [
            'uri' => $uri,
            'params' => $params
        ];

        try {
            $response = $this->executeRequest->execute(
                'GET',
                $uri,
                [
                    'query' => array_merge(
                        [
                            'app_id' => $this->key,
                        ],
                        $params
                    )
                ]
            );

            $this->logEvent->log(
                [
                    'yosmy.currency.oer.execute_request_success',
                    'success'
                ],
                [
                    'request' => $request,
                    'response' => $response->getBody()
                ],
                []
            );
        } catch (Yosmy\Http\Exception $e) {
            $response = $e->getResponse();

            $this->logEvent->log(
                [
                    'yosmy.currency.oer.execute_request_fail',
                    'fail'
                ],
                [
                    'request' => $request,
                    'response' => $response
                ],
                []
            );
        }

        return $response->getBody();
    }
}