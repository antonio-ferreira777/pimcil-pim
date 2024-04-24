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
            'status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
