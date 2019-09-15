<?php

namespace App\Traits;

trait HasNotesTrait
{
    public function notes()
    {
        return $this->morphMany(Note::class, 'parent');
    }
}
