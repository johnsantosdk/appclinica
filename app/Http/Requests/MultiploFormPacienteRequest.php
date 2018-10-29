<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\PacienteRequest;
use App\Http\Requests\ConvenioRequest;
use App\Http\Requests\TelefoneRequest;

class MultiploFormPacienteRequest extends FormRequest
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

    /**
    public function rules()
    {
        $formRequest = [
            PacienteRequest::class,
            ConvenioRequest::class,
            TelefoneRequest::class
        ];

        $rules = [];

        foreach ($formRequest as $source) {
            $relues = array_merge(
                $rules,
                (new $source)->rules()
            );
        }
        return $rules;
    }
    **/

    public function rules()
    {
        return array_merge(
            PacienteRequest::getRules(),
            ConvenioRequest::getRules(),
            TelefoneRequest::getRules()
        );
    }

    public function messages()
    {
        return array_merge(
            PacienteRequest::getMessages(),
            ConvenioRequest::getMessages(),
            TelefoneRequest::getMessages()
        );
    }
}
