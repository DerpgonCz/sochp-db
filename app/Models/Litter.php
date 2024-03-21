<?php

namespace App\Models;

use App\Enums\LitterStateEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

/**
 * @property string $name
 * @property \Carbon\Carbon $happened_on
 * @property LitterStateEnum $state
 *
 * @method Builder approved
 * @method static Builder approved
 * @method Builder toApprove
 * @method static Builder toApprove
 * @method Builder toRegister
 * @method static Builder toRegister
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
        'registration_no',
    ];

    protected $casts = [
        'happened_on' => 'datetime',
        'state' => LitterStateEnum::class,
    ];

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }

    public function shouldBeSearchable(): bool
    {
        return $this->state->is(LitterStateEnum::FINALIZED);
    }

    protected function breederName(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value): ?string => $this->station?->breeder_name,
        );
    }

    protected function breederStationName(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value): ?string => $this->station?->name,
        );
    }

    public function scopeApproved(Builder $query): Builder
    {
        return $query->whereIn('state', [LitterStateEnum::FINALIZED, LitterStateEnum::REGISTERED]);
    }

    public function scopeToApprove(Builder $query): Builder
    {
        return $query->whereIn('state', [LitterStateEnum::REQUIRES_BREEDING_APPROVAL, LitterStateEnum::REQUIRES_FINAL_APPROVAL]);
    }

    public function scopeToRegister(Builder $query): Builder
    {
        return $query->whereIn('state', [LitterStateEnum::FINALIZED]);
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
