<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends ModelAbstract
{

    protected $fillable = [
        'title', 'body', 'progress_id', 'friendly_updated_at',
    ];

    public function progress()
    {
        return $this->belongsTo(Progress::class);
    }
}
