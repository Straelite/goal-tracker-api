<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends ModelAbstract
{
    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }
}
