@php
    use App\Models\Litter;
@endphp
<select name="{{ $name }}" class="custom-select">
    <option value="">-- {{ __(sprintf('models.%s.fields.%s.name', Litter::class, $i18nField)) }} --</option>
    @if(count($stationAnimals))
        <optgroup label="{{ __('My animals') }}">
    @endif
    @foreach($stationAnimals as $animal)
            <option value="{{ $animal->id }}" @selected($animal->id === $value)>{{ $animal->name }}
                ({{ $animal->litter?->name }})
            </option>
    @endforeach
    @if(count($stationAnimals))
        </optgroup>

        <optgroup label="{{ __('Other animals') }}">
    @endif
    @foreach($otherAnimals as $animal)
        <option value="{{ $animal->id }}" @selected($animal->id === $value)>
            {{ $animal->name }}
            @if($animal->breeder_name)
                (
                @if($animal->litter) {{ $animal->litter->name }}, @endif
                {{ $animal->breeder_name ?? '?' }}
                )
            @endif
        </option>
    @endforeach
    @if(count($stationAnimals))
        </optgroup>
    @endif
</select>
