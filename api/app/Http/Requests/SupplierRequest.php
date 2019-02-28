<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{

    public function authorize()
    {
        // todo resolve auth
        return true;
    }

    public function rules()
    {
        return [
            'name'           => 'required',
            'email'          => ['required', 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/'],
            'monthlypayment' => 'required',
            'company_id'     => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required'    => 'O campo :attribute é requerido',
            'email.regex' => 'O campo precisa ser um email válido'
        ];
    }
}
