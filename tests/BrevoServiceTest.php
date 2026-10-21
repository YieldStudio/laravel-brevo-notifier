<?php

declare(strict_types=1);

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use YieldStudio\LaravelBrevoNotifier\BrevoEmailMessage;
use YieldStudio\LaravelBrevoNotifier\BrevoException;
use YieldStudio\LaravelBrevoNotifier\BrevoService;
use YieldStudio\LaravelBrevoNotifier\BrevoSmsMessage;

it('sends a template email with the default sender', function () {
    Http::fake([
        'api.brevo.com/v3/smtp/email' => Http::response(['messageId' => '<abc@smtp-relay.brevo.com>'], 201),
    ]);

    $response = app(BrevoService::class)->sendEmail(
        (new BrevoEmailMessage)
            ->templateId(12)
            ->to('John', 'john@example.com')
            ->params(['order_ref' => 'N°0000001'])
            ->tags(['order'])
    );

    expect($response)->toEqual(['messageId' => '<abc@smtp-relay.brevo.com>']);

    Http::assertSent(function (Request $request) {
        return $request->method() === 'POST'
            && $request->url() === 'https://api.brevo.com/v3/smtp/email'
            && $request->hasHeader('api-key', 'test-key')
            && $request->data() === [
                'sender' => ['email' => 'noreply@example.com', 'name' => 'Example'],
                'to' => [['name' => 'John', 'email' => 'john@example.com']],
                'templateId' => 12,
                'params' => ['order_ref' => 'N°0000001'],
                'tags' => ['order'],
            ];
    });
});

it('sends an email with html content and no template', function () {
    Http::fake([
        'api.brevo.com/v3/smtp/email' => Http::response(['messageId' => '<abc@smtp-relay.brevo.com>'], 201),
    ]);

    app(BrevoService::class)->sendEmail(
        (new BrevoEmailMessage)
            ->from('Shop', 'shop@example.com')
            ->to('John', 'john@example.com')
            ->subject('Your order')
            ->htmlContent('<p>Thanks!</p>')
    );

    Http::assertSent(function (Request $request) {
        return $request->data() === [
            'sender' => ['name' => 'Shop', 'email' => 'shop@example.com'],
            'to' => [['name' => 'John', 'email' => 'john@example.com']],
            'subject' => 'Your order',
            'htmlContent' => '<p>Thanks!</p>',
        ];
    });
});

it('sends an sms with the default sender', function () {
    Http::fake([
        'api.brevo.com/v3/transactionalSMS/sms' => Http::response(['messageId' => 123], 201),
    ]);

    $response = app(BrevoService::class)->sendSms(
        (new BrevoSmsMessage)
            ->to('+33600000000')
            ->content('Your order is confirmed.')
            ->tag('order')
    );

    expect($response)->toEqual(['messageId' => 123]);

    Http::assertSent(function (Request $request) {
        return $request->url() === 'https://api.brevo.com/v3/transactionalSMS/sms'
            && $request->data() === [
                'recipient' => '+33600000000',
                'content' => 'Your order is confirmed.',
                'type' => 'transactional',
                'unicodeEnabled' => true,
                'sender' => 'EXAMPLE',
                'tag' => 'order',
            ];
    });
});

it('throws a BrevoException when Brevo responds with an error', function () {
    Http::fake([
        'api.brevo.com/v3/smtp/email' => Http::response(['code' => 'invalid_parameter', 'message' => 'Invalid templateId'], 400),
    ]);

    app(BrevoService::class)->sendEmail(
        (new BrevoEmailMessage)->templateId(999)->to('John', 'john@example.com')
    );
})->throws(BrevoException::class, 'Brevo responded with an error (400)');
