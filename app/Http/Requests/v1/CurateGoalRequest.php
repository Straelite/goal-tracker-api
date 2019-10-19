<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class CurateGoalRequest extends GoalOwnershipRequest
{

    public function rules()
    {
        return [
            'title' => 'required|string|max:'.config('validation.string.lengths.title'),
            'body' => 'string|nullable|max:'. config('validation.string.lengths.body'),
            'friendly_updated_at' => 'string'
        ];
    }
}
