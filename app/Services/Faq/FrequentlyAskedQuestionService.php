<?php

namespace App\Services\Faq;

use App\Http\Requests\Faq\PatchFrequentlyAskedQuestionRequest;
use App\Models\FrequentlyAskedQuestion;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\UpdateTrait;
use Illuminate\Database\Eloquent\Collection;

class FrequentlyAskedQuestionService extends BaseModelService
{
    use UpdateTrait{
        update AS protected baseUpdate;
    }

    public function __construct(protected FrequentlyAskedQuestion $model)
    {
        parent::__construct($model);
    }

    public function getAll(): Collection
    {
        return $this->model::orderBy('sort_order')->get();
    }

    public function getAllWithTrashed(): Collection
    {
        return $this->model::withTrashed()->orderBy('sort_order')->get();
    }

    public function updateFromPatchRequest(FrequentlyAskedQuestion $faq, PatchFrequentlyAskedQuestionRequest $request): self
    {
        $faq->update($request->validated());

        return $this;
    }
}
