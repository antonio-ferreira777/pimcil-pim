<?php

namespace App\Http\Requests;

use App\Models\Entity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEntityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('entity_edit');
    }

    public function rules()
    {
        return [
            'ref' => [
                'string',
                'required',
            ],
            'ean' => [
                'string',
                'nullable',
            ],
            'name' => [
                'string',
                'required',
            ],
            'taxonomy_id' => [
                'required',
                'integer',
            ],
            'type_id' => [
                'required',
                'integer',
            ],
            'language_id' => [
                'required',
                'integer',
            ],
            'valid_from' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'valid_to' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
