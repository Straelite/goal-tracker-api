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
        $goal = Goal::create($data);


        return response()->json($goal);
    }

    public function update(Request $request)
    {
        //TODO Custom requests

        $data = $request->all();
        $data['friendly_updated_at'] = empty($data['friendly_updated_at']) ? Carbon::parse($data['friendly_updated_at']) : Carbon::parse($data['friendly_updated_at']);
        $goal = Goal::create($data);

        return response($goal)->json();
    }

    public function delete(Request $request, int $id)
    {
        $model = Goal::firstOrFail($id);
        $delete = $model->delete();
        return response()->json($delete);
    }

    public function get(Request $request, int $id)
    {
        //TODO Custom requests
        $model = Goal::firstOrFail($id);

        return response()->json($model);
    }
}
