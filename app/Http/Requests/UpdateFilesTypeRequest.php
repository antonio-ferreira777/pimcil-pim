<?php

namespace App\Http\Requests;

use App\Models\FilesType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFilesTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('files_type_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:files_types,name,' . request()->route('files_type')->id,
            ],
            'slug' => [
                'string',
                'required',
                'unique:files_types,slug,' . request()->route('files_type')->id,
            ],
            'status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
