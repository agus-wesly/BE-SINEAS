<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        return [
            "name" => ['required', 'string'],
            'email' => ['required','string','email'],
            'telp' => ['required','string'],
            'password' => ['required','min:6','confirmed'],
            'password_confirmation' => ['required']
//            'remember_me' => 'boolean'
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "nama wajib di isi",
            "email.required" => "email wajib di isi",
            "password.required" => "password wajib di isi",
            "password_confirmation.required" => "password konfirmasi wajib di isi",
        ];
    }
}
