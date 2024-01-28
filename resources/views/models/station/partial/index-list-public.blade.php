@php
    use App\Models\Station;
@endphp

<table class="table table-hover">
    <thead>
    <tr>
        <th>{{ __(sprintf('models.%s.fields.name', Station::class)) }}</th>
        @auth
            <th>{{ __(sprintf('models.%s.fields.owner.name', Station::class)) }}</th>
        @endauth
    </tr>
    </thead>
    <tbody>
    @foreach($stations as $station)
        <tr class="position-relative">
            <th scope="row">
                <a href="{{ route('stations.show', $station) }}" class="stretched-link">
                    {{ $station->name }}
                </a>
            </th>
            @auth
                <td>{{ $station->breeder_name }}</td>
            @endauth
        </tr>
    @endforeach
    </tbody>
</table>
<div class="row">
    <div class="col-12 text-center">
        <div class="d-inline-block">
            {{ $stations->links() }}
        </div>
    </div>
</div>
