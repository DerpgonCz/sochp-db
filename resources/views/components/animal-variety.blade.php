@php
    use App\Enums\Animal\AnimalBuildEnum;
@endphp
@if($animal->build->isStandard() /*&& $animal->fur->isStandard()*/)
    {{ __('Standard') }}
@elseif($animal->build->isStandard())
    {{--{{ __('enums.%s.%d', \App\Enums\Animal\AnimalBuildEnum::class, $animal->build->value) }}--}}
    {{--@elseif($animal->fur->isStandard())--}}
    {{ __('enums.%s.%d', AnimalBuildEnum::class, $animal->build->value) }}
@else
    {{ __('enums.%s.%d', AnimalBuildEnum::class, $animal->build->value) }}
    {{ __('enums.%s.%d', AnimalBuildEnum::class, $animal->fur->value) }}
@endif

