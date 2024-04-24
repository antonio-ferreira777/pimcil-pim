<?php

namespace App\Http\Requests;

use App\Models\Suggest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSuggestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('suggest_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:suggests',
            ],
            'slug' => [
                'string',
                'required',
                'unique:suggests',
            ],
            'editable' => [
                'required',
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
