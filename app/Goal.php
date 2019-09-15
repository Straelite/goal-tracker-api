<?php

namespace App;

class Goal extends ModelAbstract
{

   public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }

}
