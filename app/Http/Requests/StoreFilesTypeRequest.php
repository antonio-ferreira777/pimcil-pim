<?php

namespace App\Http\Requests;

use App\Models\FilesType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFilesTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('files_type_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:files_types',
            ],
            'slug' => [
                'string',
                'required',
                'unique:files_types',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
