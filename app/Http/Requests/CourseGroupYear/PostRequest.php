<?php

namespace App\Http\Requests\CourseGroupYear;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'course_group_id' => [
                'required_without:course_group_name',
                'int',
            ],
            'course_group_name' => [
                'required_without:course_group_id',
                'string',
            ],
            'credits_to_pass' => [
                'nullable',
                'int',
            ],
            'study_field_year_id' => [
                'required',
                'int',
            ],
        ];
    }
}
