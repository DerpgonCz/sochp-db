@php
    use App\Models\Litter;
@endphp

<table class="table table-hover">
    <thead>
    <tr>
        <th>{{ __(sprintf('models.%s.fields.name', Litter::class)) }}</th>
        <th>{{ __(sprintf('models.%s.fields.happened_on', Litter::class)) }}</th>
        <th>{{ __(sprintf('models.%s.fields.father.name', Litter::class)) }}</th>
        <th>{{ __(sprintf('models.%s.fields.mother.name', Litter::class)) }}</th>
        <th class="text-right">{{ __(sprintf('models.%s.children_count', Litter::class)) }}</th>
        <th class="text-center">{{ __(sprintf('models.%s.fields.state', Litter::class)) }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($stationLitters as $litter)
        <tr class="position-relative">
            <th scope="row">
                <a href="{{ route('litters.show', $litter) }}" class="stretched-link">
                    {{ $litter->name }}
                </a>
            </th>
            <td>{{ $litter->happened_on ? $litter->happened_on->format('j. n. Y') : '--' }}</td>
            <td>{{ $litter?->father?->name ?? '--' }}</td>
            <td>{{ $litter?->mother?->name ?? '--' }}</td>
            <td class="text-right">{{ $litter->children->count()}}</td>
            <td class="text-center">
                <x-litter-state-badge :litter="$litter"/>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@can('create', Litter::class)
    <div class="my-4">
        <div class="row">
            <div class="col-12 text-right">
                <a href="{{ route('litters.create') }}"
                   class="btn btn-success">{{ __('Create') }}</a>
            </div>
        </div>
    </div>
@endcan

<div class="row">
    <div class="col-12 text-center">
        <div class="d-inline-block">
            {{ $stationLitters->links() }}
        </div>
    </div>
</div>
