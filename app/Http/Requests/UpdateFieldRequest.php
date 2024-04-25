<?php

namespace App\Http\Requests;

use App\Models\Field;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFieldRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('field_edit');
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
            'taxonomies.*' => [
                'integer',
            ],
            'taxonomies' => [
                'array',
            ],
            'channels.*' => [
                'integer',
            ],
            'channels' => [
                'array',
            ],
            'languages.*' => [
                'integer',
            ],
            'languages' => [
                'array',
            ],
            'countries.*' => [
                'integer',
            ],
            'countries' => [
                'array',
            ],
            'entities.*' => [
                'integer',
            ],
            'entities' => [
                'array',
            ],
            'display_order' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'data_source' => [
                'string',
                'nullable',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
