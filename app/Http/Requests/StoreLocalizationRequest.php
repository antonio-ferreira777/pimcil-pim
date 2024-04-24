<?php

namespace App\Http\Requests;

use App\Models\Localization;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLocalizationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('localization_create');
    }

    public function rules()
    {
        return [
            'data_table' => [
                'string',
                'required',
            ],
            'data' => [
                'string',
                'required',
            ],
            'data_value' => [
                'string',
                'required',
            ],
            'language_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
