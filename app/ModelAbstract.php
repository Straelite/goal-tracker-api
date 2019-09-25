<?php

namespace App;

use App\Traits\HasNotesTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class ModelAbstract extends Model
{
    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];

    protected $casts = [
        'friendly_updated_at' => 'datetime',
    ];

    use HasNotesTrait, SoftDeletes;

}
