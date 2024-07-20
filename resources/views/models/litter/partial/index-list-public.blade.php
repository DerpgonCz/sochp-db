@php
    use App\Models\Litter;
@endphp

<table class="table table-hover">
    <thead>
    <tr>
        <th></th>
        <th>{{ __(sprintf('models.%s.fields.station.name', Litter::class)) }}</th>
        <th>{{ __(sprintf('models.%s.fields.happened_on', Litter::class)) }}</th>
        <th>{{ __(sprintf('models.%s.fields.father.name', Litter::class)) }}</th>
        <th>{{ __(sprintf('models.%s.fields.mother.name', Litter::class)) }}</th>
        <th class="text-right">{{ __(sprintf('models.%s.children_count', Litter::class)) }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($litters as $litter)
        <tr class="position-relative">
            <th scope="row">
                <a href="{{ route('litters.show', $litter) }}" class="stretched-link">
                    {{ $litter->name }}
                </a>
            </th>
            <td>{{ $litter->station->name }}</td>
            <td>{!! str_replace(' ', '&nbsp;', $litter->happened_on->format('j. n. Y')) !!}</td>
            <td>{{ $litter?->father?->name ?? '--' }}</td>
            <td>{{ $litter?->mother?->name ?? '--' }}</td>
            <td class="text-right">{{ $litter->children->count()}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="row">
    <div class="col-12 text-center">
        <div class="d-inline-block">
            {{ $litters->links() }}
        </div>
    </div>
</div>
