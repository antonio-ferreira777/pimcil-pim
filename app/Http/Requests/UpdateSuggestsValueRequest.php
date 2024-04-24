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
            'status' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'unique:suggests_values,status,' . request()->route('suggests_value')->id,
            ],
        ];
    }
}
