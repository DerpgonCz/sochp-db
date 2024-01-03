<?php

return [
    'stations' => [
        'created' => 'ChS úspěšně vytvořena',
        'updated' => 'ChS úspěšně upravena',
        'state' => [
            'for_approval' => 'ChS úspěšně odeslána ke schválení',
            'requires_changes' => 'ChS úspěšně odeslána na vyžádání změn',
            'approved' => 'ChS úspěšně schválena',
        ],
    ],
    'litters' => [
        'created' => 'Vrh úspěšně vytvořen',
        'updated' => 'Vrh úspěšně upraven',
        'state' => [
            'requires_draft_changes' => 'Vrh úspěšně odeslán na vyžádání změn',
            'requires_breeding_approval' => 'Vrh úspěšně odeslán ke schválení ke krytí',
            'breeding' => 'Vrh úspěšně schválen ke krytí',
            'requires_breeding_changes' => 'Vrh úspěšně odeslán na vyžádání změn',
            'requires_final_approval' => 'Vrh úspěšně odeslán k finálnímu schválení',
            'finalized' => 'Vrh úspěšně schválen',
            'registered' => 'Vrh úspěšně registrován',
        ],
    ],
    'animals' => [
        'updated' => 'Zvíře úspěšně upraveno'
    ]
];
