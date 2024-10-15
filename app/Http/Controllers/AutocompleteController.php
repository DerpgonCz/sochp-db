<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\GenderEnum;
use App\Models\Animal;
use App\Models\Litter;
use App\Models\Station;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AutocompleteController extends Controller
{
    /** @var array<string, class-string<Model>> */
    private const TYPE_MAPPING = [
        'station' => Station::class,
        'user' => User::class,
        'animal' => Animal::class,
        'litter' => Litter::class
    ];

    public function autocomplete(Request $request): JsonResponse
    {
        $query = $request->get('q');
        $type = $request->get('type');
        $gender = $request->get('gender');

        $modelClass = self::TYPE_MAPPING[$type];

        return response()->json(
            [
                'results' => $this->findEntities($modelClass, $gender, $query)
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
            ],
            $entity instanceof User => [
                'id' => $entity->id,
                'text' => $entity->station !== null ?
                    sprintf('%s (%s)', $entity->name, $entity->station->name) :
                    sprintf($entity->name)
            ],
            $entity instanceof Animal => [
                'id' => $entity->id,
                'text' => $entity->registration_no !== null ?
                    sprintf('%s (%s)', $entity->nameWithShortTitles, $entity->registration_no) :
                    sprintf($entity->nameWithShortTitles)
            ],
            $entity instanceof Litter => [
                'id' => $entity->id,
                'text' => $entity->registration_no !== null ?
                    ($entity->father !== null || $entity->mother !== null ?
                        sprintf('%s (%s, %s x %s)', $entity->name, $entity->registration_no, $entity->father?->name, $entity->mother?->name) :
                        sprintf('%s (%s)', $entity->name, $entity->registration_no)) :
                    sprintf($entity->name)
            ]
        };
    }

    private function findEntities(string $modelClass, ?string $gender, string $query): Collection
    {
        return match (true) {
            $modelClass === Station::class => Station::where('name', 'like', sprintf('%%%s%%', $query))
                ->orWhere('breeder_name', 'like', sprintf('%%%s%%', $query))
                ->orWhereHas('owner', static fn ($q) => $q->where('name', 'like', sprintf('%%%s%%', $query)))
                ->get(),
            $modelClass === User::class => User::where('name', 'like', sprintf('%%%s%%', $query))
                ->orWhereHas('station', static fn ($q) => $q->where('name', 'like', sprintf('%%%s%%', $query)))
                ->get(),
            $modelClass === Animal::class => Animal::where('name', 'like', sprintf('%%%s%%', $query))
                ->where('gender', '=', $gender === 'male' ? GenderEnum::MALE : ($gender === 'female' ? GenderEnum::FEMALE : ''))
                ->orWhere('registration_no', 'like', sprintf('%%%s%%', $query))
                ->get(),
            $modelClass === Litter::class => Litter::where('name', 'like', sprintf('%%%s%%', $query))
                ->orWhere('registration_no', 'like', sprintf('%%%s%%', $query))
                ->orderBy('happened_on', 'DESC')
                ->get(),
        };
    }
}
