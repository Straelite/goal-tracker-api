<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Steps extends ModelAbstract
{
    public function progress()
    {
        return $this->belongsTo(Progress::class);
    }
}
