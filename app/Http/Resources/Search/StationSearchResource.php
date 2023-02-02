<?php

declare(strict_types=1);

namespace App\Http\Resources\Search;

use Illuminate\Http\Resources\Json\JsonResource;

class StationSearchResource extends JsonResource
{
    public function toArray($request): array
    {
        /**
         * @var \App\Models\Station $this
         */
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
