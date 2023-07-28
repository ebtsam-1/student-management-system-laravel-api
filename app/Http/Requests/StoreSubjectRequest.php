<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
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
            'title' => ['required','string', 'min:3', 'max:20'],
            'desc' => ['required','string', 'min:3', 'max:20'],
            'files' => ['required','array', 'min:1', 'max:5'],
            'files.*' => ['required', 'mimes:png,jpg,pdf,xslx,mp4,mp3,']
        ];
    }
}
