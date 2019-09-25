<?php

namespace App\Http\Controllers;

use App\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ProgressController extends Controller
{
    public function create(Request $request)
    {
        //TODO Custom requests

        $data = $request->all();
        $data['friendly_updated_at'] = Carbon::parse($data['friendly_updated_at']);
        $goal = Progress::create($data);


        return response()->json($goal);
    }

    public function update(Request $request, int $id)
    {
        //TODO Custom requests

        $data = $request->all();
        $data['friendly_updated_at'] = empty($data['friendly_updated_at']) ? Carbon::parse($data['friendly_updated_at']) : Carbon::parse($data['friendly_updated_at']);
        $goal = Progress::findOrFail($id);
        $goal->update($data);

        return response()->json($goal);
    }

    public function delete(Request $request, int $id)
    {
        $model = Progress::findOrFail($id);
        $delete = $model->delete();
        return response()->json($delete);
    }

    public function get(Request $request, int $id)
    {
        //TODO Custom requests
        $model = Progress::findOrFail($id);
        return response()->json($model);
    }


    public function getSteps(Request $request, int $id)
    {
        $model = Progress::findOrFail($id);
        $progress = $model->steps()->get();
        return response()->json($progress);
    }

    public function getNotes(Request $request, int $id)
    {
        $model = Progress::findOrFail($id);
        $progress = $model->notes()->get();
        return response()->json($progress);
    }
}
