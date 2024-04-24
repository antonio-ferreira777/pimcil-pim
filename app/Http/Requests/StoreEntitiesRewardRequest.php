<?php

namespace App\Http\Requests;

use App\Models\EntitiesReward;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEntitiesRewardRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('entities_reward_create');
    }

    public function rules()
    {
        return [
            'entity_id' => [
                'required',
                'integer',
            ],
            'year' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'points' => [
                'numeric',
            ],
        ];
    }
}
