<?php

declare(strict_types=1);

namespace YieldStudio\LaravelBrevoNotifier;

final class BrevoSmsMessage
{
    public ?string $from = null;

    public string $to;

    public string $content;

    public string $type = 'transactional';

    public ?string $tag = null;

    public ?string $webUrl = null;

    public bool $unicodeEnabled = true;

    public function from(string $from): BrevoSmsMessage
    {
        $this->from = $from;

        return $this;
    }

    public function to(string $to): BrevoSmsMessage
    {
        $this->to = $to;

        return $this;
    }

    public function content(string $content): BrevoSmsMessage
    {
        $this->content = $content;

        return $this;
    }

    public function type(string $type): BrevoSmsMessage
    {
        $this->type = $type;

        return $this;
    }

    public function tag(string $tag): BrevoSmsMessage
    {
        $this->tag = $tag;

        return $this;
    }

    public function webUrl(string $webUrl): BrevoSmsMessage
    {
        $this->webUrl = $webUrl;

        return $this;
    }

    public function unicodeEnabled(bool $unicodeEnabled): BrevoSmsMessage
    {
        $this->unicodeEnabled = $unicodeEnabled;

        return $this;
    }

    public function toArray(): array
    {
        $data = [
            'recipient' => $this->to,
            'content' => $this->content,
            'type' => $this->type,
            'unicodeEnabled' => $this->unicodeEnabled,
        ];

        if (filled($this->from)) {
            $data['sender'] = $this->from;
        }

        if (filled($this->tag)) {
            $data['tag'] = $this->tag;
        }

        if (filled($this->webUrl)) {
            $data['webUrl'] = $this->webUrl;
        }

        return $data;
    }
}
