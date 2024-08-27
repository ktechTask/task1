<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class formRequestForLeave extends FormRequest
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
            'type_dayoff_id' => 'required|exists:types,id',
            'start_day' => 'required|date',
            'end_day' => 'required|date|after:start_day',
            'reason' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'type_dayoff_id.required' => 'Lý do nghỉ là bắt buộc.',
            'type_dayoff_id.exists' => 'Lý do nghỉ không hợp lệ.',
            'start_day.required' => 'Ngày bắt đầu là bắt buộc.',
            'end_day.required' => 'Ngày kết thúc là bắt buộc.',
            'end_day.after' => 'Ngày kết thúc phải sau ngày bắt đầu.',
        ];
    }
}
