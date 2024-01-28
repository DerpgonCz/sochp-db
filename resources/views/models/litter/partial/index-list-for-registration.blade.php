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
            @auth
                <td>{{ $litter->breeder_name }}</td>
            @endauth
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
