<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\v1\CurateProgressRequest;
use App\Progress;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ProgressController extends Controller
{
    protected $paginationHelper;

    public function __construct()
    {
        $this->paginationHelper = new PaginationHelper();
    }

    public function create(CurateProgressRequest $request)
    {

        $data = $request->all();
        $data['friendly_updated_at'] = Carbon::parse($data['friendly_updated_at']);
        $model = Progress::create($data);


        return response()->json($model, 201)->withHeaders(['Location' => route('v1.progress.get', ['id' => (int) $model->id])]);
    }

    public function update(CurateProgressRequest $request, int $id)
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
        $paginationData = $this->paginationHelper->getPaginationData($request);

        $model = Progress::findOrFail($id);
        $progress = $model->steps()->offset($paginationData['offset'])->take($paginationData['take'])->get();
        return response()->json($progress);
    }

    public function getNotes(Request $request, int $id)
    {
        $paginationData = $this->paginationHelper->getPaginationData($request);

        $model = Progress::findOrFail($id);
        $progress = $model->notes()->offset($paginationData['offset'])->take($paginationData['take'])->get();
        return response()->json($progress);
    }
}
