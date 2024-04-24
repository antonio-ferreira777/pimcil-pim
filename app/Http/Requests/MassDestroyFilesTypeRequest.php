<?php

namespace App\Http\Requests;

use App\Models\FilesType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFilesTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('files_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:files_types,id',
        ];
    }
}
