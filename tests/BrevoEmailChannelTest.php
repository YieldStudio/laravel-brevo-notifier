<?php

declare(strict_types=1);

use Illuminate\Notifications\Notification;
use YieldStudio\LaravelBrevoNotifier\BrevoEmailChannel;
use YieldStudio\LaravelBrevoNotifier\BrevoEmailMessage;
use YieldStudio\LaravelBrevoNotifier\BrevoService;
use YieldStudio\LaravelBrevoNotifier\Tests\User;

it('send notification via BrevoEmailChannel should call BrevoService sendEmail method', function () {
    $mock = $this->mock(BrevoService::class)->shouldReceive('sendEmail')->once();
    $channel = new BrevoEmailChannel($mock->getMock());

    $channel->send(new User, new class extends Notification
    {
        public function via()
        {
            return [BrevoEmailChannel::class];
        }

        public function toBrevoEmail(User $notifiable): BrevoEmailMessage
        {
            return new BrevoEmailMessage;
        }
    });
});
