@php
    use App\Models\Animal;
@endphp
<select name="{{ $name }}" class="custom-select">
    <option value="">-- {{ __(sprintf('models.%s.fields.caretaker.station.name', Animal::class)) }} --</option>
    @foreach($stations as $station)
        <option value="{{ $station->id }}" @selected($station->id === $value)>{{ $station->name }}
            ({{ $station->breeder_name }})
        </option>
    @endforeach
</select>
