<?php

namespace App\Http\Requests;

use App\Models\EntitiesFile;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEntitiesFileRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('entities_file_create');
    }

    public function rules()
    {
        return [
            'entity_id' => [
                'required',
                'integer',
            ],
            'file_id' => [
                'required',
                'integer',
            ],
            'display_order' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'is_default' => [
                'required',
            ],
            'to_use' => [
                'required',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
