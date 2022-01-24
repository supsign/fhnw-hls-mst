<?php

namespace App\Http\Requests\StudyFieldYear;

use Illuminate\Foundation\Http\FormRequest;

class PatchStudyFieldYearRequest extends FormRequest
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
            'assessment_id' => 'int|nullable',
            'recommendation_id' => 'int|nullable',
        ];
    }
}
