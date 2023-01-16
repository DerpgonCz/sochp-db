<?php

declare(strict_types=1);

namespace App\Services\Frontend;

use App\Models\Animal;

class AnimalColorBuilderValueSerializer
{
    public static function serialize(Animal $animal): array
    {
        $full = $animal->color_full;
        $shaded = $animal->color_shaded;
        $mink = $animal->color_mink;

        if ($full === null && $shaded === null) {
            return [];
        }

        if ($full !== null && $shaded == null) {
            return ['full', $full, $mink];
        }

        return ['shaded', $shaded, $full];
    }

    public static function deserialize(array $colors): array
    {
        $count = count($colors);

        return match ($count) {
            2 => match ($colors[0]) {
                'shaded' => [$colors[1], null, null],
                'full' => [null, $colors[1], null],
            },
            3 => match ($colors[0]) {
                'shaded' => [$colors[1], $colors[2], null],
                'full' => [null, $colors[1], $colors[2]],
            },
            default => [],
        };
    }
}
