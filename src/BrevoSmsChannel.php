<?php

declare(strict_types=1);

namespace YieldStudio\LaravelBrevoNotifier;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Notification;

class BrevoSmsChannel
{
    public function __construct(protected readonly BrevoService $brevoService) {}

    /**
     * @throws BrevoException
     */
    public function send(Model|AnonymousNotifiable $notifiable, Notification $notification): void
    {
        $sms = $notification->toBrevoSms($notifiable); // @phpstan-ignore-line

        $this->brevoService->sendSms($sms);
    }
}
