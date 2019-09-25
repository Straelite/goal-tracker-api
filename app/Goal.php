<?php

namespace App;

class Goal extends ModelAbstract
{

    protected $hidden = [
        'created_at', 'deleted_at', 'updated_at', 'user_id'
    ];

    protected $fillable = [
        'user_id', 'title', 'body', 'friendly_updated_at',
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
