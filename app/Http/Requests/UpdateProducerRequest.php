<?php

namespace App\Http\Requests;

use App\Models\Producer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProducerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('producer_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'zip_code' => [
                'string',
                'nullable',
            ],
            'city' => [
                'string',
                'nullable',
            ],
            'country_id' => [
                'required',
                'integer',
            ],
            'url' => [
                'string',
                'nullable',
            ],
            'email' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'fax' => [
                'string',
                'nullable',
            ],
            'vat' => [
                'string',
                'nullable',
            ],
        ];
    }
}
