<?php

namespace App\Http\Requests;

use App\Models\EntitiesField;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEntitiesFieldRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('entities_field_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:entities_fields,id',
        ];
    }
}
