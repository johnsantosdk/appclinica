<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicoRequest extends FormRequest
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
    public static function getRules()
    {
        return [
            'Nnome'     => 'required|regex:/[^0-9][A-Za-z]$/|max:50',
            'Nnasc'     => 'required',
            'Nsexo'     => 'required',
            'Ncpf'      => 'required|unique:medicos,cpf|cpf',
            'Ncrm'      => 'required|unique:medicos,crm',
            'Nesp'      => 'required|',
        ];
    }

    public static function getUpdateRules()
    {
        return [
            'Nnome'     => 'required|regex:/[^0-9][A-Za-z]$/|max:50',
            'Nnasc'     => 'required',
            'Nsexo'     => 'required',
            'Ncpf'      => 'required|unique:medicos,cpf|cpf',
            'Ncrm'      => 'required|unique:medicos,crm',
            'Nesp'      => 'required|',
        ];
    }

    public function rules()
    {
        return array_merge(
            static::getRules()
            //,static::getUpdateRules()
        );
        
    }

    public static function getMessages()
    {
        return [
            'Nnome.required'    => 'Digite o nome do médico.',
            'Nnome.regex'       => 'Não é aceito números [1,2,3, ...] e nem caracters especiais, como: [!,@,#,$,%,¨,&,*,(,),{,},-,=,+,§,.. etc.]',
            'Nnome.max'         => 'O nome só pode conter no máximo 50 caracteres. ',
            'Nnasc.required'    => 'Por favor, informe a data de nascimento. ',
            'Nsexo.required'    => 'Por favor, informe o sexo. ',
            'Ncpf.required'     => 'Por favor, informe o cpf. ',
            'Ncpf.cpf'          => 'O CPF informado é inválido. ',
            'Ncpf.unique'       => 'Este CPF pertence a outro cadastro. ',
            'Ncrm.required'     => 'Por favor, informe o crm do médico. ',
            'Ncrm.unique'       => 'Este crm pertence a outro cadastro. ',
            'Nesp.required'     => 'Por favor, selecione a especialidade do médico',
        ];
    }
    
    public static function getUpdateMessages()
    {
        return [
            'Nnome.required'    => 'Digite o nome do médico.',
            'Nnome.regex'       => 'Não é aceito números [1,2,3, ...] e nem caracters especiais, como: !,@,#,$,%,¨,&,*,(,),-,=,+,§,.. etc. ',
            'Nnome.max'         => 'O nome só pode conter no máximo 50 caracteres. ',
            'Nnasc.required'    => 'Por favor, informe a data de nascimento.',
            'Nsexo.required'    => 'Por favor, informe o sexo. ',
            'Ncpf.required'     => 'Por favor, informe o cpf. ',
            'Ncpf.cpf'          => 'O CPF informado é inválido. ',
            'Ncpf.unique'       => 'Este CPF pertence a outro cadastro. ',
            'Ncrm.required'     => 'Por favor, informe o crm do médico. ',
            'Ncrm.unique'       => 'Este crm pertence a outro médico. ',
            'Nesp.required'     => 'Por favor, selecione a especialidade do médico',
        ];
    }
    public function messages()
    {
        return array_merge(
            static::getMessages()
            //,static::getUpdateMessages()
        );
    }
}
