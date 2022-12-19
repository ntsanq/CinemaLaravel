<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'email|required|unique:users',
            'name' => 'required',
            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
                'regex:((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,50})'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'password.regex' => 'Password must contain at least one number and both uppercase and lowercase letters.'
        ];
    }
}
