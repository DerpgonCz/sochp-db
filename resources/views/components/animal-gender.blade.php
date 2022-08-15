@php
    use App\Enums\GenderEnum;
@endphp
@switch($value->gender)
    @case(GenderEnum::MALE())
        <span style="font-size: 1.5rem;">♂</span>
        @break
    @case(GenderEnum::FEMALE())
        <span style="font-size: 1.5rem;">♀</span>
        @break
@endswitch
