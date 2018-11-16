<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePacienteRequest extends FormRequest
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
        return array_merge(
            PacienteRequest::getUpdateRules(),
            ConvenioRequest::getUpdateRules(),
            TelefoneRequest::getUpdateRules()
        );
    }

    public function messages()
    {
        return array_merge(
            PacienteRequest::getUpdateMessages(),
            ConvenioRequest::getUpdateMessages(),
            TelefoneRequest::getUpdateMessages()
        );
    }
}
