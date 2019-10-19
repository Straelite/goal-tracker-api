<?php

namespace App\Http\Controllers\V1;

use App\Goal;
use App\GoalRelations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RelatedGoalController extends Controller
{

    public function createGoalRelation(Request $request)
    {
        $data = [
          'source_goal_id' => $request->input('source'),
          'related_goal_id' => $request->input('related')
        ];
        $existingModel = GoalRelations::where($data)->first();
        if ($existingModel) {
            return response()->json(['message' => 'Relation exists'], 409);
        }

        $model = GoalRelations::create($data);
        return response()->json($model);
    }


    public function getRelatedGoals(Request $request, int $id)
    {
        $model = Goal::findOrFail($id);
        $relatedGoals = $model->relatedGoals()->get();
        return response()->json($relatedGoals);
    }


    public function deleteGoalRelation(Request $request, int $id)
    {
        $model = GoalRelations::findOrFail($id);
        $response = $model->delete();
        return response()->json($response);
    }
}
