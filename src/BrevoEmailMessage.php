<?php

declare(strict_types=1);

namespace YieldStudio\LaravelBrevoNotifier;

final class BrevoEmailMessage
{
    public array $from = [];

    public array $to = [];

    public array $attachment = [];

    public array $bcc = [];

    public array $cc = [];

    public int $templateId;

    public ?string $subject = null;

    public ?string $htmlContent = null;

    public ?string $textContent = null;

    public ?array $replyTo = null;

    public ?array $headers = null;

    public ?array $params = null;

    public function from($name, $email = null): BrevoEmailMessage
    {
        if (is_array($name)) {
            $this->from = $name;
        } else {
            $this->from = [
                'name' => $name,
                'email' => $email,
            ];
        }

        return $this;
    }

    public function to($name, $email = null): BrevoEmailMessage
    {
        if (is_array($name)) {
            $this->to = $name;
        } else {
            $this->to[] = [
                'name' => $name,
                'email' => $email,
            ];
        }

        return $this;
    }

    public function bcc($name, $email = null): BrevoEmailMessage
    {
        if (is_array($name)) {
            $this->bcc = $name;
        } else {
            $this->bcc[] = [
                'name' => $name,
                'email' => $email,
            ];
        }

        return $this;
    }

    public function cc($name, $email = null): BrevoEmailMessage
    {
        if (is_array($name)) {
            $this->cc = $name;
        } else {
            $this->cc[] = [
                'name' => $name,
                'email' => $email,
            ];
        }

        return $this;
    }

    public function attachment($name, $content = null): BrevoEmailMessage
    {
        if (is_array($name)) {
            $this->attachment = $name;
        } else {
            $this->attachment[] = [
                'name' => $name,
                'content' => $content,
            ];
        }

        return $this;
    }

    public function subject(string $subject): BrevoEmailMessage
    {
        $this->subject = $subject;

        return $this;
    }

    public function replyTo($name, $email = null): BrevoEmailMessage
    {
        if (is_array($name)) {
            $this->replyTo = $name;
        } else {
            $this->replyTo = [
                'name' => $name,
                'email' => $email,
            ];
        }

        return $this;
    }

    public function headers(array $headers): BrevoEmailMessage
    {
        $this->headers = $headers;

        return $this;
    }

    public function templateId(int $templateId): BrevoEmailMessage
    {
        $this->templateId = $templateId;

        return $this;
    }

    public function htmlContent(string $htmlContent): BrevoEmailMessage
    {
        $this->htmlContent = $htmlContent;

        return $this;
    }

    public function textContent(string $textContent): BrevoEmailMessage
    {
        $this->textContent = $textContent;

        return $this;
    }

    public function params(array $params): BrevoEmailMessage
    {
        $this->params = $params;

        return $this;
    }

    public function toArray(): array
    {
        $data = [
            'sender' => $this->from,
            'to' => $this->to,
            'templateId' => $this->templateId,
            'params' => $this->params,
        ];

        if (filled($this->subject)) {
            $data['subject'] = $this->subject;
        }

        if (filled($this->replyTo)) {
            $data['replyTo'] = $this->replyTo;
        }

        if (filled($this->headers)) {
            $data['headers'] = $this->headers;
        }

        if (filled($this->params)) {
            $data['params'] = $this->params;
        }

        if (filled($this->htmlContent)) {
            $data['htmlContent'] = $this->htmlContent;
        }

        if (filled($this->textContent)) {
            $data['textContent'] = $this->textContent;
        }

        if (filled($this->cc)) {
            $data['cc'] = $this->cc;
        }

        if (filled($this->bcc)) {
            $data['bcc'] = $this->bcc;
        }

        if (filled($this->attachment)) {
            $data['attachment'] = $this->attachment;
        }

        return $data;
    }
}
