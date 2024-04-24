<?php

namespace App\Http\Requests;

use App\Models\SuggestsValue;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSuggestsValueRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('suggests_value_edit');
    }

    public function rules()
    {
        return [
            'suggest_id' => [
                'required',
                'integer',
            ],
            'value' => [
                'string',
                'required',
            ],
            'language_id' => [
                'required',
                'integer',
            ],
            'files' => [
                'array',
            ],
            'pictures' => [
                'array',
            ],
            'table_link' => [
                'string',
                'nullable',
            ],
            'table_link_value' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
