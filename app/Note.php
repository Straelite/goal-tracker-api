<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    protected $fillable = [
        'title', 'body', 'parent_id', 'friendly_updated_at', 'parent_type'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at', 'parent_type', 'parent_id'
    ];

    protected $casts = [
        'friendly_updated_at' => 'datetime',
    ];

    use SoftDeletes;

    public function parent()
    {
        return $this->morphTo('parent');
    }
}
