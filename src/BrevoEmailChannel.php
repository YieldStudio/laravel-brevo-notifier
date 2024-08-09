<?php

declare(strict_types=1);

namespace YieldStudio\LaravelBrevoNotifier;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Notification;

class BrevoEmailChannel
{
    public function __construct(protected readonly BrevoService $brevoService) {}

    /**
     * @throws BrevoException
     */
    public function send(Model|AnonymousNotifiable $notifiable, Notification $notification): array
    {
        $email = $notification->toBrevoEmail($notifiable); // @phpstan-ignore-line

        return $this->brevoService->sendEmail($email);
    }
}
