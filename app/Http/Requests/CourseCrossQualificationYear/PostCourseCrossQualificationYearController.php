<?php

namespace App\Http\Requests\CourseCrossQualificationYear;

use Illuminate\Foundation\Http\FormRequest;

class PostCourseCrossQualificationYearController extends FormRequest
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
            'course_id' => 'int|required',
            'cross_qualification_year_id' => 'int|required',
        ];
    }
}
