<?php

use App\Goal;
use App\Note;
use App\Progress;
use App\Step;

return [
    'classes' => [
        'goal' => Goal::class,
        'step' => Step::class,
        'progress' => Progress::class,
        'note' => Note::class
    ]
];
