<?php

namespace App\Http\Requests;

use App\Models\File;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFileRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('file_edit');
    }

    public function rules()
    {
        return [
            'file' => [
                'array',
                'required',
            ],
            'file.*' => [
                'required',
            ],
            'name' => [
                'string',
                'nullable',
            ],
            'path' => [
                'array',
            ],
            'ext' => [
                'string',
                'nullable',
            ],
            'size' => [
                'string',
                'nullable',
            ],
            'type_id' => [
                'required',
                'integer',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
