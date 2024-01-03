<?php

namespace App\Models;

use App\Enums\Animal\AnimalBreedingTypeEnum;
use App\Enums\Animal\AnimalColorFull;
use App\Enums\Animal\AnimalColorMink;
use App\Enums\Animal\AnimalColorShaded;
use App\Enums\Animal\AnimalEyesEnum;
use App\Enums\Animal\AnimalPrimaryMarkEnum;
use App\Enums\Animal\AnimalSecondaryMarkEnum;
use App\Enums\GenderEnum;
use App\Enums\LitterStateEnum;
use Illuminate\Database\Eloquent\Builder;
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
        'color_shaded',
        'color_full',
        'color_mink',
        'breeding_type',
        'note',
        'litter_id',
        'mother_id',
        'father_id',
        'registration_no',
        'caretaker_id',
    ];

    protected $casts = [
        'gender' => GenderEnum::class,
        'eyes' => AnimalEyesEnum::class,
        'mark_primary' => AnimalPrimaryMarkEnum::class,
        'mark_secondary' => AnimalSecondaryMarkEnum::class,
        'breeding_type' => AnimalBreedingTypeEnum::class,
        'color_shaded' => AnimalColorShaded::class,
        'color_full' => AnimalColorFull::class,
        'color_mink' => AnimalColorMink::class,
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
            'marks_secondary',
            'color',
        ])->toArray();
    }

    public function scopeListable($query): Builder
    {
        return $query->whereRelation('litter', 'state', LitterStateEnum::FINALIZED);
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

    public function mother(): BelongsTo
    {
        return $this->belongsTo(Animal::class, 'mother_id');
    }

    public function father(): BelongsTo
    {
        return $this->belongsTo(Animal::class, 'father_id');
    }

    public function scopeMales(): Builder
    {
        return $this->where('gender', GenderEnum::MALE);
    }

    public function scopeFemales(): Builder
    {
        return $this->where('gender', GenderEnum::FEMALE);
    }
}
