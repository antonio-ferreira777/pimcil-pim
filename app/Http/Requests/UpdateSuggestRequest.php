<?php

namespace App\Http\Requests;

use App\Models\Suggest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSuggestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('suggest_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:suggests,name,' . request()->route('suggest')->id,
            ],
            'slug' => [
                'string',
                'required',
                'unique:suggests,slug,' . request()->route('suggest')->id,
            ],
            'editable' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'unique:suggests,editable,' . request()->route('suggest')->id,
            ],
            'status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
