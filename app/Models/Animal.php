<?php

namespace App\Models;

use App\Enums\GenderEnum;
use App\Enums\LitterStateEnum;
use App\Enums\StationStateEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Animal extends Model
{
    use HasFactory;
    use Searchable;

    protected $casts = [
        'gender' => GenderEnum::class
    ];

    public function toSearchableArray(): array
    {
        return collect($this->toArray())->only([
            'id',
            'name',
            'registration_no',
            'fur',
            'color',
            'effect',
            'marks_primary',
            'marks_secondary'
        ])->toArray();
    }

    public function shouldBeSearchable(): bool
    {
        return $this->litter?->state?->is(LitterStateEnum::FINALIZED) ?? false;
    }

    public function isAlive(): bool
    {
        return $this->died_on === null;
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'owner_id');
    }

    public function caretaker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'caretaker_id');
    }

    public function litter(): BelongsTo
    {
        return $this->belongsTo(Litter::class, 'litter_id');
    }

    public function scopeMales()
    {
        return $this->where('gender', GenderEnum::MALE);
    }

    public function scopeFemales()
    {
        return $this->where('gender', GenderEnum::FEMALE);
    }
}
