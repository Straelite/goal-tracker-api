<?php

namespace App\Observers;

use App\Goal;
use App\GoalRelations;

class GoalObserver
{
    /**
     * Handle the goal "deleted" event.
     *
     * @param  \App\Goal  $goal
     * @return void
     */
    public function deleted(Goal $goal, bool $forceDelete = false)
    {

        $deleteFunction = $forceDelete ? 'forceDelete' : 'delete';
        //We want model observers to fire on the related models in turn so don't just call delete on the query builder
        $progress = $goal->progress();
        while ($progress->count() > 0) {
            $progress = $goal->progress()->take(50)->get();
            $progress->each(function ($prog) use ($deleteFunction) {
                $prog->$deleteFunction();
            });
            $progress = $goal->progress()->take(50)->get();
        }

        $notes = $goal->notes();

        while ($notes->count() > 0) {
            $notes = $goal->progress()->take(50)->get();
            $notes->each(function ($note) use ($deleteFunction) {
                $note->$deleteFunction();
            });
            $notes = $goal->progress()->take(50)->get();
        }

        $goalRelations = GoalRelations::where('source_goal_id', $goal->id)->orWhere('related_goal_id', $goal->id);

        while ($goalRelations->count() > 0) {
            $goalRelations = GoalRelations::where('source_goal_id', $goal->id)->orWhere('related_goal_id', $goal->id)->take(50)->get();
            $goalRelations->each(function ($relation) use ($deleteFunction) {
                $relation->$deleteFunction();
            });
            $goalRelations = GoalRelations::where('source_goal_id', $goal->id)->orWhere('related_goal_id', $goal->id);
        }
    }

    /**
     * Handle the goal "force deleted" event.
     *
     * @param  \App\Goal  $goal
     * @return void
     */
    public function forceDeleted(Goal $goal)
    {
        $this->deleted($goal, true);
    }
}
