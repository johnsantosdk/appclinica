<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultaRequest extends FormRequest
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
            'Npaciente' =>  'required',
            'Nesp'      =>  'required',
            'Nmed'      =>  'required',
            'Ndata'     =>  'required',
            'Nhor'      =>  'required', 
        ];
    }

    public function messages()
    {
        return [
            'Npaciente.required' =>  ' Selecione o paciente. ',
            'Nesp.required'      =>  ' Selecione a especialidade. ',
            'Nmed.required'      =>  ' Selecione o médico. ',
            'Ndata.required'     =>  ' Informe a data para o agendamento. ',
            'Nhor.required'      =>  ' Selecione o horário do agendamento ',
        ];
    }
}
