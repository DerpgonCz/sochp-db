@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>{{ __('Litter') }} {{ $litter->name }}, {{ __(sprintf('models.%s.fields.station.name', \App\Models\Litter::class)) }} {{ $litter->station->name }}</h1>
                <hr>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <dl class="row">
                    <dd class="col-3">{{ __(sprintf('models.%s.fields.mother.name', \App\Models\Litter::class)) }}</dd>
                    <dt class="col-9">
                        {{ $litter->mother->name }}
                        <a href="{{ route('animals.show', $litter->mother) }}"><span class="badge badge-secondary">{{ __('Detail') }}</span></a>
                    </dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.father.name', \App\Models\Litter::class)) }}</dd>
                    <dt class="col-9">
                        {{ $litter->father->name }}
                        <a href="{{ route('animals.show', $litter->father) }}"><span class="badge badge-secondary">{{ __('Detail') }}</span></a>
                    </dt>
                </dl>
            </div>
        </div>

        <h2>{{ __('Children') }}</h2>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>{{ __(sprintf('models.%s.fields.children.name', \App\Models\Litter::class)) }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($litter->children as $animal)
                        <tr class="position-relative">
                            <th scope="row">
                                <a href="{{ route('animals.show', $animal) }}" class="stretched-link">
                                    {{ $animal->name }}
                                </a>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
