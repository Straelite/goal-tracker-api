<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class NoteController extends Controller
{
    public function create(Request $request)
    {
        //TODO Custom requests

        $data = $request->all();
        $parentClass = $this->queryClassFromFriendlyType($data['parent_type']);
        $data['parent_type'] = $parentClass;
        $data['friendly_updated_at'] = Carbon::parse($data['friendly_updated_at']);
        $model = Note::create($data);

        $parent = $parentClass::find($data['parent_id']);

        $model->parent()->save($parent);

        return response()->json($model);
    }

    public function update(Request $request, int $id)
    {
        //TODO Custom requests

        $data = $request->all();
        $data['friendly_updated_at'] = empty($data['friendly_updated_at']) ? Carbon::parse($data['friendly_updated_at']) : Carbon::parse($data['friendly_updated_at']);
        $model = Note::findOrFail($id);
        $model->update($data);

        return response()->json($model);
    }

    public function delete(Request $request, int $id)
    {
        $model = Note::findOrFail($id);
        $delete = $model->delete();
        return response()->json($delete);
    }

    public function get(Request $request, int $id)
    {
        //TODO Custom requests
        $model = Note::findOrFail($id);
        return response()->json($model);
    }

    //TODO move to a helper
    //TODO better name
    protected function queryClassFromFriendlyType(string $friendlyName)
    {
        return config(sprintf('classMapping.classes.%s', $friendlyName));
    }
}
