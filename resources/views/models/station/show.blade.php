@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>{{ __('Station') }}</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <dl class="row">
                    <dd class="col-3">{{ __(sprintf('models.%s.fields.name', \App\Models\Station::class)) }}</dd>
                    <dt class="col-9">{{ $station->name }}</dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.state', \App\Models\Station::class)) }}</dd>
                    <dt class="col-9"><x-station-state-badge :station="$station" /></dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.owner.name', \App\Models\Station::class)) }}</dd>
                    <dt class="col-9">{{ $station->owner->name }}</dt>
                </dl>
            </div>
        </div>
    </div>
@endsection
