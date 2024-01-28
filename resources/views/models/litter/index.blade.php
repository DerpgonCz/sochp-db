@php
    use Illuminate\Database\Eloquent\Collection;
    use App\Models\Litter;
    use App\Models\Station;

    /** @var Collection<Station>|null $stationLitters */
@endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">

                <ul class="nav nav-tabs" role="tablist">
                    @php
                        $showStationLittersTab = $stationLitters !== null;
                        $activeTab = $showStationLittersTab ? 1 : 0;

                        $activeTab = match(true) {
                            app('request')->has('littersPage') => 0,
                            app('request')->has('stationLittersPage') => 1,
                            app('request')->has('littersForApprovalPage') => 2,
                            app('request')->has('littersForRegistrationPage') => 3,
                            default => $activeTab,
                        }
                    @endphp
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $activeTab === 0 ? 'active' : '' }}" id="approved-litters"
                                data-toggle="tab" data-target="#approved-litters-content" type="button" role="tab">
                            {{ __('Approved litters') }} ({{ $litters->total() }})
                        </button>
                    </li>
                    @if($showStationLittersTab)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 1 ? 'active' : '' }}" id="my-litters" data-toggle="tab" data-target="#my-litters-content" type="button" role="tab">
                                {{ __('My litters') }} ({{ $stationLitters->total() }})
                            </button>
                        </li>
                    @endif
                    @can('approve', Litter::class)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 2 ? 'active' : '' }}" id="for-approval" data-toggle="tab" data-target="#for-approval-content" type="button" role="tab">
                                {{ __('For approval') }} ({{ $littersForApproval->total() }})
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 3 ? 'active' : '' }}" id="for-registration" data-toggle="tab" data-target="#for-registration-content" type="button" role="tab">
                                {{ __('For registration') }} ({{ $littersForRegistration->total() }})
                            </button>
                        </li>
                    @endcan
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade {{ $activeTab === 0 ? 'show active' : '' }}" id="approved-litters-content" role="tabpanel">
                        @include('models.litter.partial.index-list-public')
                    </div>
                    @if($stationLitters !== null)
                        <div class="tab-pane fade {{ $activeTab === 1 ? 'show active' : '' }}" id="my-litters-content"
                             role="tabpanel">

                        </div>
                    @endif
                    @can('approve', Litter::class)
                    <div class="tab-pane fade {{ $activeTab === 2 ? 'show active' : '' }}" id="for-approval-content" role="tabpanel">
                        @include('models.litter.partial.index-list-to-approve')
                    </div>
                    <div class="tab-pane fade {{ $activeTab === 3 ? 'show active' : '' }}" id="for-registration-content" role="tabpanel">
                        @include('models.litter.partial.index-list-for-registration')
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
