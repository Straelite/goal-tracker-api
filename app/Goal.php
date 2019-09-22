<?php

namespace App;

class Goal extends ModelAbstract
{

    protected $fillable = [
        'user_id', 'title', 'body', 'friendly_updated_at',
    ];

    protected $casts = [
        'friendly_updated_at' => 'datetime',
    ];


   public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }

}
