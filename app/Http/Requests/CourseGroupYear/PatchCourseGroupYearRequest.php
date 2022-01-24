<?php

namespace App\Http\Requests\CourseGroupYear;

use Illuminate\Foundation\Http\FormRequest;

class PatchCourseGroupYearRequest extends FormRequest
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
            'credits_to_pass' => 'int|nullable',
        ];
    }
}
