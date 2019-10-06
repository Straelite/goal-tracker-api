<?php

namespace App;

class Progress extends ModelAbstract
{
    protected $table = 'progress';

    protected $fillable = [
        'title', 'body', 'goal_id', 'friendly_updated_at',
    ];

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }
}
