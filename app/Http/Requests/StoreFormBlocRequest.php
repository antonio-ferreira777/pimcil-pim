<?php

namespace App\Http\Requests;

use App\Models\FormBloc;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFormBlocRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('form_bloc_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'display_order' => [
                'nullable',
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
