<?php

namespace App\Http\Requests;

use App\Models\Grape;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyGrapeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('grape_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:grapes,id',
        ];
    }
}
