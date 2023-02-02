<?php

declare(strict_types=1);

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static flash(string $type, string $message): void
 *
 * @method static danger(string $message): void
 * @method static info(string $message): void
 * @method static primary(string $message): void
 * @method static success(string $message): void
 * @method static warning(string $message): void
 */
class Flashes extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'flashes';
    }
}
