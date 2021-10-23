<?php

namespace App\Models;

use App\Enums\StationStateEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

/**
 * @property StationStateEnum $state
 */
class Station extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'state' => StationStateEnum::class,
    ];

    public function scopeApproved()
    {
        return $this->where('state', StationStateEnum::APPROVED);
    }

    public function shouldBeSearchable(): bool
    {
        return $this->state->is(StationStateEnum::APPROVED);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class, 'owner_id');
    }
}
