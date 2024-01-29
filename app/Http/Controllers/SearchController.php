<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\Search\AnimalSearchResource;
use App\Http\Resources\Search\LitterSearchResource;
use App\Http\Resources\Search\StationSearchResource;
use App\Models\Animal;
use App\Models\Litter;
use App\Models\Station;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    /**
     * Which models to search by default
     * Key is class, value is an array of fields to include
     */
    private const SEARCH = [
        Animal::class => ['litter.station'],
        Litter::class => ['station'],
        Station::class => [],
    ];

    /**
     * @var array<string, \Illuminate\Http\Resources\Json\JsonResource>
     */
    private const RESOURCES = [
        Animal::class => AnimalSearchResource::class,
        Station::class => StationSearchResource::class,
        Litter::class => LitterSearchResource::class,
    ];

    public function search(Request $request): JsonResponse
    {
        $query = $request->input('q');
        if (!$query) {
            return response()->json(null);
        }

        $results = [];
        foreach (self::SEARCH as $class => $loadRelations) {
            /** @var \Laravel\Scout\Searchable|string $class */
            $searchResult = $class::search($query)->get();
            if (count($loadRelations)) {
                $searchResult->load($loadRelations);
            }
            $responseArrayKey = Str::lower(Str::plural(class_basename($class)));
            $results[$responseArrayKey] = array_key_exists($class, self::RESOURCES) ? self::RESOURCES[$class]::collection($searchResult) : $searchResult;
        }

        return response()->json([
            'results' => $results,
        ]);
    }
}
