<?php

namespace App\Http\Requests\CourseRecommendation;

use Illuminate\Foundation\Http\FormRequest;

class PostCourseRecommendationRequest extends FormRequest
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
            'recommendation_id' => 'int|required',
            'course_id' => 'int|required',
            'planned_semester' => 'int|required',
        ];
    }
}
