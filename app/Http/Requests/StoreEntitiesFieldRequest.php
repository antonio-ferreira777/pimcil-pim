<?php

namespace App\Http\Requests;

use App\Models\EntitiesField;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEntitiesFieldRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('entities_field_create');
    }

    public function rules()
    {
        return [
            'entity_id' => [
                'required',
                'integer',
            ],
            'field_id' => [
                'required',
                'integer',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
