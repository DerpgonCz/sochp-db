<?php

namespace App\Models;

use App\Enums\Animal\AnimalBreedingTypeEnum;
use App\Enums\Animal\AnimalEffectEnum;
use App\Enums\Animal\AnimalEyesEnum;
use App\Enums\Animal\AnimalPrimaryMarkEnum;
use App\Enums\Animal\AnimalSecondaryMarkEnum;
use App\Enums\GenderEnum;
use App\Enums\LitterStateEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Animal extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'build',
        'fur',
        'gender',
        'eyes',
        'effect',
        'mark_primary',
        'mark_secondary',
        'breeding_type',
        'note',
        'litter_id',
    ];

    protected $casts = [
        'gender' => GenderEnum::class,
        'eyes' => AnimalEyesEnum::class,
        'effect' => AnimalEffectEnum::class,
        'mark_primary' => AnimalPrimaryMarkEnum::class,
        'mark_secondary' => AnimalSecondaryMarkEnum::class,
        'breeding_type' => AnimalBreedingTypeEnum::class,
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
