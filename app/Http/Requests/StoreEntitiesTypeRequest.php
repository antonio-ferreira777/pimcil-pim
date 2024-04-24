<?php

namespace App\Http\Requests;

use App\Models\EntitiesType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEntitiesTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('entities_type_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:entities_types',
            ],
            'slug' => [
                'string',
                'required',
                'unique:entities_types',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
