<?php

declare(strict_types=1);

namespace YieldStudio\LaravelBrevoNotifier;

use Illuminate\Support\ServiceProvider;

class BrevoNotifierServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config' => config_path(),
            ], 'config');
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/brevo.php', 'brevo');

        $this->app->bind(BrevoService::class, function () {
            $key = config('brevo.key');
            $emailFrom = config('brevo.emailFrom');
            $smsFrom = config('brevo.smsFrom');
            $options = config('brevo.options', []);

            $instance = new BrevoService($key, $options);

            if (filled($emailFrom)) {
                $instance->setEmailFrom($emailFrom);
            }

            if (filled($smsFrom)) {
                $instance->setSmsFrom($smsFrom);
            }

            return $instance;
        });
    }

    public function provides(): array
    {
        return [BrevoService::class];
    }
}
