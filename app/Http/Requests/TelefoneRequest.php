<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TelefoneRequest extends FormRequest
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
            'NtelR' => 'nullable|telefone_com_ddd',
            'NtelE' => 'nullable|telefone_com_ddd',
            'NtelC' => 'nullable|celular_com_ddd',
        ];
    }

    public static function getUpdateRules()
    {
        return [
            'NtelR' => 'nullable|telefone_com_ddd',
            'NtelE' => 'nullable|telefone_com_ddd',
            'NtelC' => 'nullable|celular_com_ddd',
        ];
    }

    public function rule()
    {
        return array_merge(
            static::getRules(),
            static::getUpdateRules()
        );
    }

    public static function getMessages()
    {
        return [
            'NtelR.telefone_com_ddd'    => 'Telefone residencial inválido.',
            'NtelE.telefone_com_ddd'    => 'Telefone empresarial inválido.',
            'NtelC.celular_com_ddd'     => 'Celular inválido.'
        ];
    }

    public static function getUpdateMessages()
    {
        return [
            'NtelR.telefone_com_ddd'    => 'Telefone residencial inválido.',
            'NtelE.telefone_com_ddd'    => 'Telefone empresarial inválido.',
            'NtelC.celular_com_ddd'     => 'Celular inválido.'
        ];
    }

    public function messages()
    {
        return array_merge(
            static::getMessages(),
            static::getUpdateMessages()
        );
    }
}
