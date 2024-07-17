<?php

declare(strict_types=1);

namespace YieldStudio\LaravelBrevoNotifier;

use Exception;
use Psr\Http\Message\ResponseInterface;

final class BrevoException extends Exception
{
    public function __construct(ResponseInterface $response)
    {
        $statusCode = $response->getStatusCode();

        $message = sprintf(
            'Brevo responded with an error (%s), body : %s',
            $statusCode,
            $response->getBody()
        );

        parent::__construct($message, $statusCode);
    }
}
