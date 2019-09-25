<?php

namespace App\Traits;

use App\Note;

trait HasNotesTrait
{
    public function notes()
    {
        return $this->morphMany(Note::class, 'parent');
    }
}
