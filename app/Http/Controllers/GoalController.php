<?php

namespace App\Http\Controllers;

use App\Goal;
use App\GoalRelations;
use App\Http\Requests\CurateGoalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GoalController extends Controller
{
    public function create(CurateGoalRequest $request)
    {
        //TODO Custom requests

        $data = $request->all();
        $data['friendly_updated_at'] = Carbon::parse($data['friendly_updated_at']);
        $model = Goal::create($data);


        return response()->json($model);
    }

    public function update(CurateGoalRequest $request, int $id)
    {
        //TODO Custom requests

        $data = $request->all();
        $data['friendly_updated_at'] = empty($data['friendly_updated_at']) ? Carbon::parse($data['friendly_updated_at']) : Carbon::parse($data['friendly_updated_at']);
        $model = Goal::findOrFail($id);
        $model->update($data);

        return response()->json($model);
    }

    public function delete(Request $request, int $id)
    {
        $model = Goal::findOrFail($id);
        $delete = $model->delete();
        return response()->json($delete);
    }

    public function get(Request $request, int $id)
    {
        //TODO Custom requests
        $model = Goal::findOrFail($id);

        return response()->json($model);
    }

    public function getProgress(Request $request, int $id)
    {
        $model = Goal::findOrFail($id);
        $progress = $model->progress()->get();
        return response()->json($progress);
    }

    public function getNotes(Request $request, int $id)
    {
        $model = Goal::findOrFail($id);
        $progress = $model->notes()->get();
        return response()->json($progress);
    }

    public function getRelatedGoals(Request $request, int $id)
    {
        $model = Goal::findOrFail($id);
        $relatedGoals = $model->relatedGoals()->get();
        return response()->json($relatedGoals);
    }

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

    public function deleteGoalRelation(Request $request, int $id)
    {
        $model = GoalRelations::findOrFail($id);
        $response = $model->delete();
        return response()->json($response);
    }
}
