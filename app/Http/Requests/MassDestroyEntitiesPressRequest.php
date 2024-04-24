<?php

namespace App\Http\Requests;

use App\Models\EntitiesPress;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEntitiesPressRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('entities_press_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:entities_presses,id',
        ];
    }
}
