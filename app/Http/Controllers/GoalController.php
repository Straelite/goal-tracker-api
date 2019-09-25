<?php

namespace App\Http\Controllers;

use App\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GoalController extends Controller
{
    public function create(Request $request)
    {
        //TODO Custom requests

        $data = $request->all();
        $data['friendly_updated_at'] = Carbon::parse($data['friendly_updated_at']);
        $model = Goal::create($data);


        return response()->json($model);
    }

    public function update(Request $request, int $id)
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
}
