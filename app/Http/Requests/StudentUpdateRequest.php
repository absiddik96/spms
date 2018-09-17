<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Admin\Student;

class StudentUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
                'name' => 'required|min:2|max:100',
                'batch_id' => 'required',
                'exam_roll' => 'required',
                'password' => 'confirmed',
                'is_active' => 'required|in:'. Student::ACTIVE_STUDENT . ',' . Student::DEACTIVE_STUDENT,
        ];
    }
    public function messages()
    {
        return [
            'batch_id.required' => 'The batch field is required.',
            'reg_no.required' => 'The registration no field is required.',
        ];
    }
}
