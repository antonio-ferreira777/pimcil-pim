<?php

namespace App\Http\Requests;

use App\Models\EntitiesPress;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEntitiesPressRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('entities_press_edit');
    }

    public function rules()
    {
        return [
            'entity_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'url' => [
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
