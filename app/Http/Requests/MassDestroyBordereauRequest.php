<?php

namespace App\Http\Requests;

use App\Models\Bordereau;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBordereauRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('bordereau_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:bordereaus,id',
        ];
    }
}
