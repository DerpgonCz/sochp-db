@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                @auth
                    <h2>{{ __('My litters') }}</h2>
                @endauth
                <div class="my-4">
                    TODO
                </div>

                <h2>{{ __('Approved litters') }}</h2>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>{{ __(sprintf('models.%s.fields.station.name', \App\Models\Litter::class)) }}</th>
                        <th>{{ __(sprintf('models.%s.fields.happened_on', \App\Models\Litter::class)) }}</th>
                        <th>{{ __(sprintf('models.%s.fields.mother.name', \App\Models\Litter::class)) }}</th>
                        <th>{{ __(sprintf('models.%s.fields.father.name', \App\Models\Litter::class)) }}</th>
                        <th class="text-right">{{ __(sprintf('models.%s.children_count', \App\Models\Litter::class)) }}</th>
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
                            <td>{{ $litter->happened_on->format('j. n. Y') }}</td>
                            <td>{{ $litter->mother->name }}</td>
                            <td>{{ $litter->father->name }}</td>
                            <td class="text-right">{{ $litter->children->count()}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
