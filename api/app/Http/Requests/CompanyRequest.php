<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{

    public function authorize()
    {
        // todo resolve auth
        return true;
    }

    public function rules()
    {
        return [
            'name'    => 'required',
            'phone'   => 'required',
            'address' => 'required',
            'cep'     => ['required','regex:/^\d{5}-\d{3}/'],
            'cnpj'    => ['required','regex:/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/']
        ];
    }

    public function messages()
    {
        return [
            'required'   => 'O campo :attribute é requerido',
            'cep.regex'  => 'O CEP precisa estar no formato 0000-000',
            'cnpj.regex' => 'O CNPJ precisa estar no formato 00.000.000/0000-00'
        ];
    }
}
