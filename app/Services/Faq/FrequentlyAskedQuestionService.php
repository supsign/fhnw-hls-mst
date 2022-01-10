<?php

namespace App\Services\Faq;

use App\Http\Requests\Faq\PatchFrequentlyAskedQuestionRequest;
use App\Http\Requests\Faq\PostFrequentlyAskedQuestionRequest;
use App\Models\FrequentlyAskedQuestion;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\FirstOrCreateTrait;
use App\Services\Base\Traits\UpdateTrait;
use Illuminate\Database\Eloquent\Collection;

class FrequentlyAskedQuestionService extends BaseModelService
{
    use UpdateTrait{
        update AS protected baseUpdate;
    }
    use FirstOrCreateTrait{
        firstOrCreate AS protected baseFirstOrCreate;
    }

    public function __construct(protected FrequentlyAskedQuestion $model)
    {
        parent::__construct($model);
    }

    public function createFromPostRequest(PostFrequentlyAskedQuestionRequest $request): FrequentlyAskedQuestion
    {
        return $this->baseFirstOrCreate($request->validated());
    }

    public function getAll(): Collection
    {
        return $this->model::orderBy('sort_order')->get();
    }

    public function getAllWithTrashed(): Collection
    {
        return $this->model::withTrashed()->orderBy('sort_order')->get();
    }

    protected function getNextEntry(FrequentlyAskedQuestion $faq): ?FrequentlyAskedQuestion
    {
        return $this->model::where('sort_order', '>', $faq->sort_order)
            ->orderBy('sort_order')
                ->first();
    }

    protected function getPreviousEntry(FrequentlyAskedQuestion $faq): ?FrequentlyAskedQuestion
    {
        return $this->model::where('sort_order', '<', $faq->sort_order)
            ->orderBy('sort_order', 'desc')
                ->first();
    }

    public function updateFromPatchRequest(FrequentlyAskedQuestion $faq, PatchFrequentlyAskedQuestionRequest $request): FrequentlyAskedQuestion
    {
        $this->baseUpdate($faq, $request->validated());

        return $faq;
    }

    public function sortOrderDown(FrequentlyAskedQuestion $faq): self
    {
        $nextEntry = $this->getNextEntry($faq);

        if (!$nextEntry) {
            return $this;
        }

        $currentPosition = $faq->sort_order;
        $faq->sort_order = $nextEntry->sort_order;
        $nextEntry->sort_order = $currentPosition;

        $faq->save();
        $nextEntry->save();

        return $this;
    }

    public function sortOrderUp(FrequentlyAskedQuestion $faq): self
    {
        $previousEntry = $this->getPreviousEntry($faq);

        if (!$previousEntry) {
            return $this;
        }

        $currentPosition = $faq->sort_order;
        $faq->sort_order = $previousEntry->sort_order;
        $previousEntry->sort_order = $currentPosition;

        $faq->save();
        $previousEntry->save();

        return $this;
    }
}
