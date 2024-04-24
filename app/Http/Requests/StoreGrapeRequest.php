<?php

namespace App\Http\Requests;

use App\Models\Grape;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGrapeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('grape_create');
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
            'color' => [
                'string',
                'nullable',
            ],
            'country_id' => [
                'required',
                'integer',
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
