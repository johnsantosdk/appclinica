<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConvenioRequest extends FormRequest
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
            'Nmat'      => 'required|max:40|alpha_num',
            'NplanoId'  => 'required|numeric'
        ];
    }

    public function rules()
    {
        return static::getRules();
    }

    public static function getMessages()
    {
        return [
            'Nmat.required'     => 'Por favor, infome a matricula do plano.',
            'Nmat.max'          => 'A matricula não pode conter mais que 40 caracters',
            'Nmat.alpha_num'    => 'Há a presença de caracteres especais no campo matricula.',
            'NplanoId.required' => 'Por favor, selecione o plano do paciente.',
            'NplanoId.numeric'  => 'ERRO 401 NOT FOUNT.'
        ];
    }

    public function messages()
    {
        return static::getMessages();
    }
}
