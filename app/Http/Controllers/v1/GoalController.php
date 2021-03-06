<?php

namespace App\Http\Controllers\V1;

use App\Goal;
use App\GoalRelations;
use App\Helpers\PaginationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\CurateGoalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GoalController extends Controller
{
    protected $paginationHelper;

    public function __construct()
    {
        $this->paginationHelper = new PaginationHelper();
    }

    public function create(CurateGoalRequest $request)
    {
        $data = $request->all();
        $data['friendly_updated_at'] = Carbon::now();
        $data['user_id'] = 1;
        $model = Goal::create($data);
        return response()->json($model, 201)->withHeaders(['Location' => route('v1.goal.get', ['id' => (int) $model->id])]);
    }

    public function update(CurateGoalRequest $request, int $id)
    {
        //TODO Custom requests

        $data = $request->all();
        $data['friendly_updated_at'] = empty($data['friendly_updated_at']) ? Carbon::now() : Carbon::parse($data['friendly_updated_at']);
        $model = Goal::findOrFail($id);
        $model->update($data);

        return response()->json($model);
    }

    public function delete(Request $request, int $id)
    {
        $model = Goal::findOrFail($id);
        $delete = $model->delete();
        return response()->json(['deleted' => $delete]);
    }

    public function get(Request $request, int $id)
    {
        //TODO Custom requests
        $model = Goal::findOrFail($id);

        return response()->json($model);
    }

    public function getPaginated(Request $request)
    {

        $paginationData = $this->paginationHelper->getPaginationData($request);

        $models = Goal::query()->offset($paginationData['offset'])->take($paginationData['take'])->get();
        return response()->json($models);
    }

    public function getProgress(Request $request, int $id)
    {

        $paginationData = $this->paginationHelper->getPaginationData($request);

        $model = Goal::findOrFail($id);
        $progress = $model->progress()->offset($paginationData['offset'])->take($paginationData['take'])->get();
        return response()->json($progress);
    }

    public function getNotes(Request $request, int $id)
    {
        $paginationData = $this->paginationHelper->getPaginationData($request);

        $model = Goal::findOrFail($id);
        $progress = $model->notes()->offset($paginationData['offset'])->take($paginationData['take'])->get();
        return response()->json($progress);
    }

    public function getRelatedGoals(Request $request, int $id)
    {
        $paginationData = $this->paginationHelper->getPaginationData($request);

        $model = Goal::findOrFail($id);
        $relatedGoals = $model->relatedGoals()->offset($paginationData['offset'])->take($paginationData['take'])->get();
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
