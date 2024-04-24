<?php

namespace App\Http\Requests;

use App\Models\SuggestsValue;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySuggestsValueRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('suggests_value_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:suggests_values,id',
        ];
    }
}
