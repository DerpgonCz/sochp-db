@if($animal->date_of_birth === null)
    --
@elseif($animal->isAlive())
    {{ __('Alive')  }} ({{ $animal->date_of_birth->diff('now')->format('%yr %mm') }})
@else
    {{ __('Dead')  }} ({{ $animal->date_of_birth->diff($animal->died_on)->format('%yr %mm') }})
@endif
