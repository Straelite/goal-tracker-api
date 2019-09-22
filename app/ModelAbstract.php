<?php

namespace App;

use App\Traits\HasNotesTrait;
use Illuminate\Database\Eloquent\Model;

abstract class ModelAbstract extends Model
{
    use HasNotesTrait;

}
