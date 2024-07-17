<?php

declare(strict_types=1);

namespace YieldStudio\LaravelBrevoNotifier\Tests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use Notifiable;
}
