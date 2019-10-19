<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class GoalOwnershipRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [];
    }
}
