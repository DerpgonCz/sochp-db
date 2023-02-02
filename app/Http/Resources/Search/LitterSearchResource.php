<?php

declare(strict_types=1);

namespace App\Http\Resources\Search;

use Illuminate\Http\Resources\Json\JsonResource;

class LitterSearchResource extends JsonResource
{
    public function toArray($request): array
    {
        /**
         * @var \App\Models\Litter $this
         */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'station_name' => $this->station->name,
        ];
    }
}
