@php
    use App\Models\Litter;
@endphp

<table class="table table-hover">
    <thead>
    <tr>
        <th>{{ __(sprintf('models.%s.fields.name', Litter::class)) }}</th>
        @auth
            <th>{{ __(sprintf('models.%s.fields.owner', Litter::class)) }}</th>
        @endauth
        <th>{{ __(sprintf('models.%s.fields.state', Litter::class)) }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($littersForApproval as $litter)
        <tr class="position-relative">
            <th scope="row">
                <a href="{{ route('litters.edit', $litter) }}" class="stretched-link">
                    {{ $litter->name }}
                </a>
            </th>
            @auth
                <td>{{ $litter->station->owner->name }}</td>
            @endauth
            <td>
                <x-litter-state-badge :litter="$litter"/>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="row">
    <div class="col-12 text-center">
        <div class="d-inline-block">
            {{ $littersForApproval->links() }}
        </div>
    </div>
</div>
