<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;
use YieldStudio\LaravelBrevoNotifier\BrevoService;
use YieldStudio\LaravelBrevoNotifier\BrevoSmsChannel;
use YieldStudio\LaravelBrevoNotifier\BrevoSmsMessage;
use YieldStudio\LaravelBrevoNotifier\Tests\User;

it('send notification via BrevoChannel should call BrevoService sendSms method', function () {
    $mock = $this->mock(BrevoService::class)->shouldReceive('sendSms')->once();
    $channel = new BrevoSmsChannel($mock->getMock());
    $channel->send(new User, new class extends Notification
    {
        public function via()
        {
            return [BrevoSmsChannel::class];
        }

        public function toBrevoSms(Model $notifiable): BrevoSmsMessage
        {
            return new BrevoSmsMessage;
        }
    });
});
