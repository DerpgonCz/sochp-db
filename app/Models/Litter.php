<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Scout\Searchable;


class Litter extends Model
{
    use HasFactory;
    use Searchable;

    protected $casts = [
        'happened_on' => 'datetime',
    ];

    public function mother(): BelongsTo
    {
        return $this->belongsTo(Animal::class, 'mother_id');
    }

    public function father(): BelongsTo
    {
        return $this->belongsTo(Animal::class, 'father_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Animal::class, 'litter_id');
    }

    public function station(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'station_id');
    }
}
