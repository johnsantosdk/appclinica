<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Nnome' => 'required|max:255',
            'Nstatus' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'Nnome.required' => 'Digite o nome do plano.',
            'Nnome.alpha_num' => 'Não é aceito caracters especiais, como: !,@,#,$,%,¨,&,*,(,),-,=,+,§,.. etc.',
            'Nnome.max'      => 'O nome só pode conter no máximo 256 caracteres.',
            'Nstatus.required'  => 'Escolha o status do plano.',
        ];
    }
}
