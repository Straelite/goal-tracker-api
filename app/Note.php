<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function parent()
    {
        return $this->morphTo('parent');
    }
}
