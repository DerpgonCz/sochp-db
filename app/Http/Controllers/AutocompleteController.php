<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AutocompleteController extends Controller
{
    /** @var array<string, class-string<Model>> */
    private const TYPE_MAPPING = [
        'station' => Station::class,
    ];

    public function autocomplete(Request $request): JsonResponse
    {
        $query = $request->get('q');
        $type = $request->get('type');

        $modelClass = self::TYPE_MAPPING[$type];

        return response()->json(
            [
                'results' => $this->findEntities($modelClass, $query)
                    ->map($this->mapEntityToResponse(...)),
            ],
        );
    }

    private function mapEntityToResponse(Model $entity): array
    {
        return match (true) {
            $entity instanceof Station => [
                'id' => $entity->id,
                'text' => sprintf('%s (%s)', $entity->name, $entity->breeder_name),
            ]
        };
    }

    private function findEntities(string $modelClass, string $query): Collection
    {
        return match (true) {
            $modelClass === Station::class => Station::where('name', 'like', sprintf('%%%s%%', $query))
                ->orWhere('breeder_name', 'like', sprintf('%%%s%%', $query))
                ->orWhereHas('owner', static fn ($q) => $q->where('name', 'like', sprintf('%%%s%%', $query)))
                ->get()
        };
    }
}
