<?php

namespace App\Http\Requests;

use App\Models\Field;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFieldRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('field_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'default' => [
                'string',
                'nullable',
            ],
            'form_blocs.*' => [
                'integer',
            ],
            'form_blocs' => [
                'required',
                'array',
            ],
            'channels_transversality' => [
                'required',
            ],
            'language_transversality' => [
                'required',
            ],
            'display_order' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
