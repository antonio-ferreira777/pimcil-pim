<?php

namespace App\Http\Requests;

use App\Models\FylesType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFylesTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('fyles_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:fyles_types,id',
        ];
    }
}
