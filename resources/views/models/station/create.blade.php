@php
    use App\Models\Station;
@endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>{{ __('Create a new station') }}</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <form method="POST" action="{{ route('stations.store') }}" class="col">
                @method('POST')
                @csrf

                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    {!! __('Every station has to be registered and approved by :org before being able to be approved here', ['org' => '<a href="https://www.rodent.cz/" target="_blank">ÚOK CHHL</a>']) !!}
                </div>

                <label class="form-group">
                    <strong>{{ __(sprintf('models.%s.fields.name', Station::class)) }}</strong>
                    <input type="text" class="form-control" name="name" placeholder="{{ __(sprintf('models.%s.fields.name', Station::class)) }}" value="{{ old('name') }}" required>
                </label>

                <label class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">{{ __('Save') }}</button>
                </label>
            </form>
        </div>
    </div>
@endsection
