<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | API Token
    |--------------------------------------------------------------------------
    |
    | Your API token from brevo.com.
    | see: https://app.brevo.com/settings/keys/api
    |
    */

    'key' => env('BREVO_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Email Sender
    |--------------------------------------------------------------------------
    |
    | Email and Name used by Brevo when sending email.
    | This configuration is used when sending mail.
    |
    */

    'emailFrom' => [
        'email' => env('MAIL_FROM_ADDRESS'),
        'name' => env('MAIL_FROM_NAME'),
    ],

    /*
    |--------------------------------------------------------------------------
    | SMS Sender
    |--------------------------------------------------------------------------
    |
    | Defines the name that will be used as the "from" for all outgoing text messages
    | This name is limited to 11 for alphanumeric characters and 15 for numeric characters.
    |
    */

    'smsFrom' => env('BREVO_SMS_SENDER'),

];
