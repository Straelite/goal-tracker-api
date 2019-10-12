<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoalRelations extends Model
{
    use SoftDeletes;

    protected $hidden = [
        'created_at', 'deleted_at', 'updated_at'
    ];

    protected $fillable = [
        'source_goal_id', 'related_goal_id',
    ];

   public function sourceGoal()
    {
        return $this->belongsTo(Goal::class, 'source_goal_id');
    }

    public function relatedGoal()
    {
        return $this->belongsTo(Goal::class, 'related_goal_id');
    }

}
