<?php

return [
    'key' => env('BREVO_KEY'),
    'emailFrom' => [
        'email' => env('MAIL_FROM_ADDRESS'),
        'name' => env('MAIL_FROM_NAME')
    ],
    'smsFrom' => env('BREVO_SMS_SENDER')
];
