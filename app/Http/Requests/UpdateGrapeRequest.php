<?php

namespace App\Http\Requests;

use App\Models\Grape;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGrapeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('grape_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'synonyms' => [
                'string',
                'nullable',
            ],
            'pictures' => [
                'array',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
