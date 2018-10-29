<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\MultiploFormPacienteRequest;

class PacienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function getRules()
    {
        return [
            'Nnome'     => 'required|max:50',
            'Nnasc'     => 'required',
            'Nsexo'     => 'required',
            'Ncpf'      => 'required|cpf',
            'Nemail'    => 'nullable|email',
        ];
    }

    public function rules()
    {
        return static::getRules();
    }

    public static function getMessages()
    {
        return [
            'Nnome.required'    => 'Digite o nome do paciente.',
            'Nnome.alpha'       => 'Não é aceito caracters especiais, como: !,@,#,$,%,¨,&,*,(,),-,=,+,§,.. etc.',
            'Nnome.max'         => 'O nome só pode conter no máximo 50 caracteres.',
            'Nnasc.required'    => 'Por favor, informe a data de nascimento.',
            'Ncpf.required'     => 'Informe o cpf.',
            'Ncpf.cpf'          => 'CPF inválido.',
            'Nemail.email'      => 'Este email não é válido.'
        ];
    }

    public function messages()
    {
        return static::getMesssages();
    }
}
