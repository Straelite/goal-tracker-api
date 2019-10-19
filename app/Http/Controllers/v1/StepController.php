<?php

namespace App\Http\Controllers\V1;

use App\Step;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class StepController extends Controller
{
    public function create(Request $request)
    {
        //TODO Custom requests

        $data = $request->all();
        $data['friendly_updated_at'] = Carbon::parse($data['friendly_updated_at']);
        $model = Step::create($data);

        return response()->json($model, 201)->withHeaders(['Location' => route('v1.step.get', ['id' => (int) $model->id])]);
    }

    public function update(Request $request, int $id)
    {
        //TODO Custom requests

        $data = $request->all();
        $data['friendly_updated_at'] = empty($data['friendly_updated_at']) ? Carbon::parse($data['friendly_updated_at']) : Carbon::parse($data['friendly_updated_at']);
        $model = Step::findOrFail($id);
        $model->update($data);

        return response()->json($model);
    }

    public function delete(Request $request, int $id)
    {
        $model = Step::findOrFail($id);
        $delete = $model->delete();
        return response()->json($delete);
    }

    public function get(Request $request, int $id)
    {
        //TODO Custom requests
        $model = Step::findOrFail($id);

        return response()->json($model);
    }

    public function getNotes(Request $request, int $id)
    {
        $model = Step::findOrFail($id);
        $progress = $model->notes()->get();
        return response()->json($progress);
    }
}
