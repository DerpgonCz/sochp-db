<?php

declare(strict_types=1);

namespace App\Http\Controllers;

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
        Station::class => [],
        Litter::class => [],

    ];

    public function search(Request $request): JsonResponse
    {
        $query = $request->input('q');
        if (!$query) {
            return response()->json(null);
        }

        $results = [];
        foreach (self::SEARCH as $class => $loadRelations) {
            /** @var \Laravel\Scout\Searchable $class */
            $searchResult = $class::search($query)->get();
            if (count($loadRelations)) {
                $searchResult->load($loadRelations);
            }
            $results[Str::lower(Str::plural(class_basename($class)))] = $searchResult;
        }

        return response()->json([
            'results' => $results,
        ]);
    }
}
