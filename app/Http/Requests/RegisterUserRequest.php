<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3','max:100'],
            'email' => ['required', 'email','unique:users,email', 'min:4','max:100'],
            'password' => ['required', 'min:8', 'max:50', 'string'],
            'avatar' => ['mimes:jpg,png']
        ];
    }
}
