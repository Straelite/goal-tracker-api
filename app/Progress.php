<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends ModelAbstract
{
    protected $table = 'progress';

    protected $fillable = [
        'title', 'body', 'goal_id', 'friendly_updated_at',
    ];

    public function steps()
    {
        return $this->hasMany(Steps::class);
    }

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }
}
