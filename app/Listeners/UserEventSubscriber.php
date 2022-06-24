<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Facades\Flashes;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

class UserEventSubscriber
{
    public function handleUserLogin($event): void
    {
        Flashes::success(__('Logged in successfully'));
    }

    public function handleUserLogout($event): void
    {
        Flashes::success(__('Logged out successfully'));
    }

    public function subscribe(): array
    {
        return [
            Login::class => 'handleUserLogin',
            Logout::class => 'handleUserLogout',
        ];
    }
}
