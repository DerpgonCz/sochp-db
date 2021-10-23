@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>{{ __('Edit a station') }}</h2>
                <h5>{{ __('State') }}: <x-station-state-badge :station="$station"></x-station-state-badge></h5>
            </div>
        </div>
        <div class="row justify-content-center">
            <form method="POST" action="{{ route('stations.update', $station) }}" class="col">
                @method('PUT')
                @csrf

                <label class="form-group">
                    <strong>{{ __(sprintf('models.%s.fields.name', \App\Models\Station::class)) }}</strong>
                    <input type="text" class="form-control" name="name" placeholder="{{ __(sprintf('models.%s.fields.name', \App\Models\Station::class)) }}" value="{{ $station->name }}" required>
                </label>

                <label class="form-group text-right">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    @if($station->state->in([\App\Enums\StationStateEnum::DRAFT, \App\Enums\StationStateEnum::REQUIRES_CHANGES]))
                        <button type="submit" name="state" value="{{ \App\Enums\StationStateEnum::FOR_APPROVAL }}" class="btn btn-success">{{ __('Send for Approval') }}</button>
                    @endif
                    @if($station->state->is(\App\Enums\StationStateEnum::FOR_APPROVAL))
                        <button type="submit" name="state" value="{{ \App\Enums\StationStateEnum::REQUIRES_CHANGES }}" class="btn btn-warning">{{ __('Requires Changes') }}</button>
                        <button type="submit" name="state" value="{{ \App\Enums\StationStateEnum::APPROVED }}" class="btn btn-success">{{ __('Approve') }}</button>
                    @endif
                </label>
            </form>
        </div>
    </div>
@endsection
