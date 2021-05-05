<?php

namespace App\Http\Requests;

use App\Models\Player;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePlayerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('player_edit');
    }

    public function rules()
    {
        return [
            'team_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'prenom' => [
                'string',
                'required',
            ],
            'tranche' => [
                'required',
            ],
            'cine' => [
                'string',
                'nullable',
            ],
            'sexe' => [
                'required',
            ],
            'birthday_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'category' => [
                'required',
            ],
        ];
    }
}
