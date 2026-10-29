# Changelog

All notable changes to `laravel-brevo-notifier` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## 1.1.0 - 2026-10-29

### What's Changed

* feat: add Laravel 13 support by @adrien-nf in https://github.com/YieldStudio/laravel-brevo-notifier/pull/15

Highlights:

* Support for Laravel 13 (`illuminate/database` and `illuminate/support` now allow `^13`) and PHP 8.5, alongside Laravel 9 to 12.
* `templateId` is now optional on `BrevoEmailMessage`, so you can send an email with `htmlContent` / `textContent` only. `templateId` and `params` are omitted from the payload when unset.
* Test suite reworked on top of `Http::fake()` (dropped the `ciareis/bypass` dev dependency) and the CI matrix now covers Laravel 9 to 13 with the matching Testbench versions.

### New Contributors

* @adrien-nf made their first contribution in https://github.com/YieldStudio/laravel-brevo-notifier/pull/15

**Full Changelog**: https://github.com/YieldStudio/laravel-brevo-notifier/compare/1.0.3...1.1.0

## 1.0.3 - 2025-12-04

### What's Changed

* feat(email): add tags by @cmeniger in https://github.com/YieldStudio/laravel-brevo-notifier/pull/13
* return the brevo api response by @andrewbroberg in https://github.com/YieldStudio/laravel-brevo-notifier/pull/12

### New Contributors

* @cmeniger made their first contribution in https://github.com/YieldStudio/laravel-brevo-notifier/pull/13
* @andrewbroberg made their first contribution in https://github.com/YieldStudio/laravel-brevo-notifier/pull/12

**Full Changelog**: https://github.com/YieldStudio/laravel-brevo-notifier/compare/1.0.2...1.0.3

## 1.0.2 - 2025-04-09

### What's Changed

* laravel 12 and php 8.4 by @mckenziearts in https://github.com/YieldStudio/laravel-brevo-notifier/pull/7

**Full Changelog**: https://github.com/YieldStudio/laravel-brevo-notifier/compare/1.0.1...1.0.2

## 1.0.1 - 2024-07-22

### What's Changed

* Add support for Laravel 11 by @mckenziearts in https://github.com/YieldStudio/laravel-brevo-notifier/pull/2

### New Contributors

* @mckenziearts made their first contribution in https://github.com/YieldStudio/laravel-brevo-notifier/pull/2

**Full Changelog**: https://github.com/YieldStudio/laravel-brevo-notifier/compare/1.0.0...1.0.1

## 1.0.0 - 2024-01-24

**Full Changelog**: https://github.com/YieldStudio/laravel-brevo-notifier/commits/1.0.0

**First release ⚡️**

Replacement for [laravel-sendinblue-notifier](https://github.com/YieldStudio/laravel-sendinblue-notifier)
Email & SMS support
