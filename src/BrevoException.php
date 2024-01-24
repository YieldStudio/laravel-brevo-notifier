<?php

declare(strict_types=1);

namespace YieldStudio\LaravelBrevoNotifier;

use Exception;
use Psr\Http\Message\ResponseInterface;

final class BrevoException extends Exception
{
    public function __construct(ResponseInterface $response, $notifiable)
    {
        $statusCode = $response->getStatusCode();

        $message = sprintf(
            "Brevo responded with an error (%s) for notifiable '%s' with id '%s', body : %s",
            $statusCode,
            get_class($notifiable),
            $notifiable->getKey(),
            (string) $response->getBody()
        );

        parent::__construct($message, $statusCode);
    }
}
