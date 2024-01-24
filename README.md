# laravel-brevo-notifier

Easily send Brevo transactional email and sms with Laravel notifier.

[![Latest Version](https://img.shields.io/github/release/yieldstudio/laravel-brevo-notifier?style=flat-square)](https://github.com/yieldstudio/laravel-brevo-notifier/releases)
[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/yieldstudio/laravel-brevo-notifier/tests?style=flat-square)](https://github.com/yieldstudio/laravel-brevo-notifier/actions/workflows/tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/yieldstudio/laravel-brevo-notifier?style=flat-square)](https://packagist.org/packages/yieldstudio/laravel-brevo-notifier)

> Major version zero (0.y.z) is for initial development. Anything MAY change at any time. The public API SHOULD NOT be considered stable.

## Installation

	composer require yieldstudio/laravel-brevo-notifier

## Configure

Just define these environment variables:

```dotenv
BREVO_IDENTIFIER=
BREVO_KEY=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
BREVO_SMS_SENDER=
```

Make sure that MAIL_FROM_ADDRESS is an authenticated email on Brevo.

BREVO_SMS_SENDER is limited to 11 for alphanumeric characters and 15 for numeric characters.

You can publish the configuration file with:

```shell
php artisan vendor:publish --provider="YieldStudio\LaravelBrevoNotifier\BrevoNotifierServiceProvider" --tag="config"
```

## Usage

### Send email

```php
<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use YieldStudio\LaravelBrevoNotifier\BrevoEmailChannel;
use YieldStudio\LaravelBrevoNotifier\BrevoEmailMessage;

class OrderConfirmation extends Notification
{
    public function via(): array
    {
        return [BrevoEmailChannel::class];
    }

    public function toBrevoEmail($notifiable): BrevoEmailMessage
    {
        return (new BrevoEmailMessage())
            ->templateId(1)
            ->to($notifiable->firstname, $notifiable->email)
            ->params(['order_ref' => 'N°0000001']);
    }
}
```

### Send sms

```php
<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification
use YieldStudio\LaravelBrevoNotifier\BrevoSmsChannel;
use YieldStudio\LaravelBrevoNotifier\BrevoSmsMessage;

class OrderConfirmation extends Notification
{
    public function via()
    {
        return [BrevoSmsChannel::class];
    }

    public function toBrevoSms($notifiable): BrevoSmsMessage
    {
        return (new BrevoSmsMessage())
            ->from('YIELD')
            ->to('+33626631711')
            ->content('Your order is confirmed.');
    }
}
```

## Unit tests

To run the tests, just run `composer install` and `composer test`.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://raw.githubusercontent.com/YieldStudio/.github/main/CONTRIBUTING.md) for details.

### Security

If you've found a bug regarding security please mail [contact@yieldstudio.fr](mailto:contact@yieldstudio.fr) instead of using the issue tracker.

## Credits

- [David Tang](https://github.com/dtangdev)
- [James Hemery](https://github.com/jameshemery)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
