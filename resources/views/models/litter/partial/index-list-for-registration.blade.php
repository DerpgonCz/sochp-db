@php
    use App\Models\Litter;
@endphp

<table class="table table-hover">
    <thead>
    <tr>
        <th>{{ __(sprintf('models.%s.fields.name', Litter::class)) }}</th>
        <th>{{ __(sprintf('models.%s.fields.station.name', Litter::class)) }}</th>
        @auth
            <th>{{ __(sprintf('models.%s.fields.owner', Litter::class)) }}</th>
        @endauth
        <th>{{ __(sprintf('models.%s.fields.happened_on', Litter::class)) }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($littersForRegistration as $litter)
        <tr class="position-relative">
            <th scope="row">
                <a href="{{ route('litters.edit', $litter) }}" class="stretched-link">
                    {{ $litter->name }}
                </a>
            </th>
            <td>{{ $litter->station->name }}</td>
            @auth
                <td>{{ $litter->breeder_name }}</td>
            @endauth
            <td class="text-right">{!! str_replace(' ', '&nbsp;', $litter->happened_on->format('j. n. Y')) !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="row">
    <div class="col-12 text-center">
        <div class="d-inline-block">
            {{ $littersForRegistration->links() }}
        </div>
    </div>
</div>
