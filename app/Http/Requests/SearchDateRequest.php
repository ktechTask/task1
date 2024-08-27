<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchDateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'start_day' => 'required|date',
            'end_day' => 'required|date|after:start_day',
        ];
    }

    public function messages()
    {
        return [
            'end_day.after' => 'The check-out date must be after the check-in date.',
        ];
    }
}
