<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DateChartRequest extends FormRequest
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
        $buckets = ['day', 'week', 'month', 'year'];
        return [
            'date_from' => ['required','date', 'date_format:Y-m-d H:i'],
            'date_to' => ['required','date', 'date_format:Y-m-d H:i', "after:{$this->date_from}"],
            'bucket' => ['required',Rule::in($buckets)],
        ];
    }
}
