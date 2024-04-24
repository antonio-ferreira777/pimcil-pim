<?php

namespace App\Http\Requests;

use App\Models\Variation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVariationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('variation_edit');
    }

    public function rules()
    {
        return [
            'entity_id' => [
                'required',
                'integer',
            ],
            'master_entity_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
