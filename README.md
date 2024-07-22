<p align="center"><img src="./art/logo.svg" alt="Laravel Brevo Notifier Package Logo"></p>

<p align="center">
<a href="https://github.com/yieldstudio/laravel-brevo-notifier/actions/workflows/tests.yml"><img src="https://img.shields.io/github/actions/workflow/status/yieldstudio/laravel-brevo-notifier/tests.yml?branch=main&style=flat-square" alt="Build Status"></a>
<a href="https://github.com/yieldstudio/laravel-brevo-notifier/releases"><img src="https://img.shields.io/github/release/yieldstudio/laravel-brevo-notifier?style=flat-square" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/yieldstudio/laravel-brevo-notifier"><img src="https://img.shields.io/packagist/dt/yieldstudio/laravel-brevo-notifier?style=flat-square" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/yieldstudio/laravel-brevo-notifier"><img src="https://img.shields.io/packagist/l/yieldstudio/laravel-brevo-notifier" alt="License"></a>
</p>

Easily send Brevo transactional email and sms with Laravel.

## Installation

You can install the package via composer:

```bash
composer require yieldstudio/laravel-brevo-notifier
```

## Configure

Just define these environment variables:

```dotenv
BREVO_KEY=
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
BREVO_SMS_SENDER=
```

Make sure that `MAIL_FROM_ADDRESS` is an authenticated email on Brevo. You can verify by logging in your Brevo account here https://app.brevo.com/senders

`BREVO_SMS_SENDER` is limited to 11 for alphanumeric characters and 15 for numeric characters.

You can publish the configuration file with:

```shell
php artisan vendor:publish --provider="YieldStudio\LaravelBrevoNotifier\BrevoNotifierServiceProvider" --tag="config"
```

## Usage

Now you can use the channel in your via() method inside the notification:

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

### Send SMS

```php
<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use YieldStudio\LaravelBrevoNotifier\BrevoSmsChannel;
use YieldStudio\LaravelBrevoNotifier\BrevoSmsMessage;

class OrderConfirmation extends Notification
{
    public function via(): array
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

## Contact us

[<img src="https://github.com/YieldStudio/.github/blob/main/assets/banner.png" width="419px" />](https://www.yieldstudio.fr/contact)

Our team at Yield Studio is ready to welcome you and make every interaction an exceptional experience. You can [contact us](https://www.yieldstudio.fr/contact).


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://raw.githubusercontent.com/YieldStudio/.github/main/CONTRIBUTING.md) for details.

### Security

If you've found a bug regarding security please mail [contact@yieldstudio.fr](mailto:contact@yieldstudio.fr) instead of using the issue tracker.

## Credits

- [David Tang](https://github.com/dtangdev)
- [James Hemery](https://github.com/jameshemery)
- [Arthur Monney](https://github.com/mckenziearts)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
