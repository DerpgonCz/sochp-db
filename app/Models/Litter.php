<?php

namespace App\Models;

use App\Enums\LitterStateEnum;
use App\Enums\StationStateEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

/**
 * @property string $name
 * @property \Carbon\Carbon $happened_on
 * @property LitterStateEnum $state
 */
class Litter extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'happened_on',
        'father_id',
        'mother_id',
    ];

    protected $casts = [
        'happened_on' => 'datetime',
        'state' => LitterStateEnum::class,
    ];

    public function toSearchableArray(): array
    {
        return collect($this->toArray())->only([
            'id',
            'name',
        ])->toArray();
    }

    public function scopeApproved(): Builder
    {
        return $this->where('state', LitterStateEnum::FINALIZED);
    }

    public function shouldBeSearchable(): bool
    {
        return $this->state->is(LitterStateEnum::FINALIZED);
    }

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
