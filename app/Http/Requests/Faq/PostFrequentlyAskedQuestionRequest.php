<?php

namespace App\Http\Requests\Faq;

use App\Services\Faq\FrequentlyAskedQuestionService;
use Illuminate\Foundation\Http\FormRequest;

class PostFrequentlyAskedQuestionRequest extends FormRequest
{
    public function __construct(protected FrequentlyAskedQuestionService $faqService)
    {
        
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        if (!$this->sort_order) {
            $this->merge([
                'sort_order' => $this->faqService->getNextAvailiblePosition()
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'answer' => 'string|required',
            'question' => 'string|required',
            'sort_order' => 'int|nullable',
        ];
    }
}
