<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurateProgressRequest extends ProgressOwnershipRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:' . config('validation.string.lengths.title'),
            'body' => 'string|nullable|max:' . config('validation.string.lengths.body'),
            'friendly_updated_at' => 'string',
            'goal_id' => 'integer|min:1'
        ];
    }
}
