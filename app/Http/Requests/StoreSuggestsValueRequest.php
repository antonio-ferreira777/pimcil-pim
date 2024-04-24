<?php

namespace App\Http\Requests;

use App\Models\SuggestsValue;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSuggestsValueRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('suggests_value_create');
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
        ];
    }
}
