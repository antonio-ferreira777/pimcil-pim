<?php

namespace App\Http\Requests;

use App\Models\EntitiesVersioning;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEntitiesVersioningRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('entities_versioning_create');
    }

    public function rules()
    {
        return [
            'entity_id' => [
                'required',
                'integer',
            ],
            'values' => [
                'required',
            ],
        ];
    }
}
