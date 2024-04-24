<?php

namespace App\Http\Requests;

use App\Models\Reward;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRewardRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('reward_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'doc' => [
                'array',
            ],
            'link' => [
                'string',
                'nullable',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
