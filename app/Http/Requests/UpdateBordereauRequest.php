<?php

namespace App\Http\Requests;

use App\Models\Bordereau;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBordereauRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bordereau_edit');
    }

    public function rules()
    {
        return [
            'team_id' => [
                'required',
                'integer',
            ],
            'etat' => [
                'required',
            ],
        ];
    }
}
