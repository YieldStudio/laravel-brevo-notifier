<?php

declare(strict_types=1);

namespace YieldStudio\LaravelBrevoNotifier;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class BrevoService
{
    protected PendingRequest $http;

    protected string $host = 'https://api.brevo.com/v3';

    protected ?array $emailFrom = null;

    protected ?string $smsFrom = null;

    public function __construct(string $key, array $options = [])
    {
        if (array_key_exists('host', $options)) {
            $this->host = $options['host'];
        }

        if (array_key_exists('emailFrom', $options)) {
            $this->setEmailFrom($options['emailFrom']);
        }

        if (array_key_exists('smsFrom', $options)) {
            $this->setSmsFrom($options['smsFrom']);
        }

        $this->http = Http::withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'api-key' => $key,
        ])->baseUrl($this->host);
    }

    public function sendEmail(BrevoEmailMessage $email, array $options = []): ?array
    {
        if (blank($email->from)) {
            $email->from($this->emailFrom);
        } elseif (array_key_exists('emailFrom', $options)) {
            $email->from($options['emailFrom']);
        }
        $response = $this->http->post('/smtp/email', $email->toArray());

        if (! $response->successful()) {
            throw new BrevoException($response->toPsrResponse());
        }

        return json_decode($response->body(), true);
    }

    public function sendSms(BrevoSmsMessage $sms, array $options = []): ?array
    {
        if (blank($sms->from)) {
            $sms->from($this->smsFrom);
        } elseif (array_key_exists('smsFrom', $options)) {
            $sms->from($options['smsFrom']);
        }

        $response = $this->http->post('/transactionalSMS/sms', $sms->toArray());

        if (! $response->successful()) {
            throw new BrevoException($response->toPsrResponse());
        }

        return json_decode($response->body(), true);
    }

    public function setEmailFrom(array $emailFrom): static
    {
        $this->emailFrom = $emailFrom;

        return $this;
    }

    public function setSmsFrom(string $smsFrom): static
    {
        $this->smsFrom = $smsFrom;

        return $this;
    }
}
