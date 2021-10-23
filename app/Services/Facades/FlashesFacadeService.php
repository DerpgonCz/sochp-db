<?php

declare(strict_types=1);

namespace App\Services\Facades;

use Illuminate\Support\Facades\Session;

class FlashesFacadeService
{
    public function flash(string $type, string $message): void
    {
        Session::push(sprintf('flashes.%s', $type), $message);
    }

    public function success(string $message): void
    {
        $this->flash('success', $message);
    }

    public function danger(string $message): void
    {
        $this->flash('danger', $message);
    }

    public function primary(string $message): void
    {
        $this->flash('primary', $message);
    }

    public function info(string $message): void
    {
        $this->flash('info', $message);
    }

    public function warning(string $message): void
    {
        $this->flash('warning', $message);
    }
}
