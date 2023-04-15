<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $entityId = $this->route()->parameter('slider')?->id;

        $rules = [
            'email' => [
                'required',
                'email',
                Rule::unique('clients')->ignore($entityId)
            ],
            'password' => [
                'required',
                'min:8'
            ]
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least :min characters.'
        ];
    }

}
