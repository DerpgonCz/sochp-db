<?php

namespace App\Models;

use App\Enums\Animal\AnimalBreedingTypeEnum;
use App\Enums\Animal\AnimalColorFull;
use App\Enums\Animal\AnimalColorMink;
use App\Enums\Animal\AnimalColorShaded;
use App\Enums\Animal\AnimalEyesEnum;
use App\Enums\Animal\AnimalPrimaryMarkEnum;
use App\Enums\Animal\AnimalSecondaryMarkEnum;
use App\Enums\Animal\AnimalTitleEnum;
use App\Enums\Animal\ColorColorPearlEnum;
use App\Enums\GenderEnum;
use App\Enums\LitterStateEnum;
use App\Services\Frontend\Animal\i18n\AnimalBuildTranslationService;
use App\Services\Frontend\Animal\i18n\AnimalColorTranslationService;
use App\Services\Frontend\Animal\i18n\AnimalEffectTranslationService;
use App\Services\Frontend\Animal\i18n\AnimalFurTranslationService;
use App\Services\Frontend\Animal\i18n\AnimalVarietyTranslationService;
use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection as SupportCollection;
use Laravel\Scout\Searchable;

/**
 * @property GenderEnum $gender
 * @property Litter|null $litter
 * @property Station|null $station
 * @property Collection $parentOfLitters
 *
 * @method static Builder males()
 * @method static Builder females()
 * @method Builder males()
 * @method Builder females()
 * @method static Builder listable()
 * @method Builder listable()
 */
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
        'date_of_birth',
        'died_on',
        'station_id',
        'breeder_name',
        'breeder_station_name',
        'caretaker_name',
        'caretaker_station_name',
        'title',
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
        'color_pearl' => ColorColorPearlEnum::class,
        'date_of_birth' => 'datetime',
    ];

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
            'registration_no' => $this->registration_no,
            'build_cs' => (new AnimalBuildTranslationService())($this, 'cs'),
            'color_cs' => (new AnimalColorTranslationService())($this, 'cs'),
            'effect_cs' => (new AnimalEffectTranslationService())($this, 'cs'),
            'fur_cs' => (new AnimalFurTranslationService())($this, 'cs'),
            'variety_cs' => (new AnimalVarietyTranslationService())($this, 'cs'),
            'build_en' => (new AnimalBuildTranslationService())($this, 'en'),
            'color_en' => (new AnimalColorTranslationService())($this, 'en'),
            'effect_en' => (new AnimalEffectTranslationService())($this, 'en'),
            'fur_en' => (new AnimalFurTranslationService())($this, 'en'),
            'variety_en' => (new AnimalVarietyTranslationService())($this, 'en'),
        ];
    }

    protected function breederName(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value): ?string => $value ?? $this->station?->breeder_name ?? $this->litter?->breeder_name,
        );
    }

    protected function breederStationName(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value): ?string => $value ?? $this->station?->name ?? $this->litter?->breeder_station_name,
        );
    }

    protected function caretakerName(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value): ?string => $value ?? $this->caretaker?->name,
        );
    }

    protected function caretakerStationName(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value): ?string => $value ?? $this->caretaker?->station_name,
        );
    }

    protected function nameWithShortTitles(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                $titles = collect(AnimalTitleEnum::cases())
                    ->filter(fn (AnimalTitleEnum $title): bool => $this->title & $title->value)
                    ->map(static fn (AnimalTitleEnum $title): string => __(sprintf('enums.%s.short.%d', AnimalTitleEnum::class, $title->value)))
                    ->prepend($this->name);

                return $titles->join(', ');
            }
        );
    }

    protected function markings(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                return $this->mark_secondary !== null ?
                    sprintf('%s %s', __(sprintf('enums.%s.%s', AnimalPrimaryMarkEnum::class, $this->mark_primary->value)), __(sprintf('enums.%s.%s', AnimalSecondaryMarkEnum::class, $this->mark_secondary->value))) :
                    __(sprintf('enums.%s.%s', AnimalPrimaryMarkEnum::class, $this->mark_primary->value));
            }
        );
    }

    public function titles(): SupportCollection
    {
        return collect(AnimalTitleEnum::cases())
                ->filter(fn (AnimalTitleEnum $title): bool => $this->title & $title->value)
                ->map(static fn (AnimalTitleEnum $title): string => __(sprintf('enums.%s.long.%d', AnimalTitleEnum::class, $title->value)));
    }

    public function scopeListable(Builder $query): Builder
    {
        return $query
            ->whereRelation('litter', 'state', LitterStateEnum::FINALIZED)
            ->orWhereDoesntHave('litter');
    }

    public function shouldBeSearchable(): bool
    {
        return $this->litter?->state->in([LitterStateEnum::FINALIZED, LitterStateEnum::REGISTERED])
            || $this->litter === null;
    }

    public function isAlive(): bool
    {
        return $this->died_on === null;
    }

    public function caretaker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'caretaker_id');
    }

    public function litter(): BelongsTo
    {
        return $this->belongsTo(Litter::class, 'litter_id');
    }

    public function station(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'station_id');
    }

    public function mother(): BelongsTo
    {
        return $this->belongsTo(Animal::class, 'mother_id');
    }

    public function father(): BelongsTo
    {
        return $this->belongsTo(Animal::class, 'father_id');
    }

    public function scopeMales(Builder $query): Builder
    {
        return $query->where('gender', GenderEnum::MALE);
    }

    public function scopeFemales(Builder $query): Builder
    {
        return $query->where('gender', GenderEnum::FEMALE);
    }

    public function parentOfLitters(): HasMany
    {
        return match(true) {
            $this->gender->is(GenderEnum::MALE) => $this->hasMany(Litter::class, 'father_id')->approved(),
            $this->gender->is(GenderEnum::FEMALE) => $this->hasMany(Litter::class, 'mother_id')->approved(),
        };
    }
}
