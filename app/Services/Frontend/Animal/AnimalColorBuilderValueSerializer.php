<?php

declare(strict_types=1);

namespace App\Services\Frontend\Animal;

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

        return ['shaded', $shaded, $full, $mink];
    }

    public static function deserialize(array $colors): array
    {
        return match ($colors[0]) {
            'shaded' => [
                'shaded' => $colors[1],
                'full' => $colors[2],
                'mink' => $colors[3] ?? null,
            ],
            'full' => [
                'shaded' => null,
                'full' => $colors[1],
                'mink' => $colors[2] ?? null,
            ],
        };
    }
}
