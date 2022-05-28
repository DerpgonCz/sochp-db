<?php

declare(strict_types=1);

namespace App\Http\Resources\Search;

use Illuminate\Http\Resources\Json\JsonResource;

class AnimalSearchResource extends JsonResource
{
    public function toArray($request): array
    {
        /**
         * @var \App\Models\Animal $this
         */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'station_name' => $this->litter->station->name,
            'color' => $this->color,
        ];
    }
}
