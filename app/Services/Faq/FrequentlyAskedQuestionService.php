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
        return $this
            ->makePositionAvailible($request->sort_order)
            ->baseFirstOrCreate($request->validated());
    }

    public function makePositionAvailible(int $position): self
    {
        $faq = $this->model::where('sort_order', $position)->first();

        if (!$faq) {
            return $this;
        }

        $this->makePositionAvailible($position + 1);
        $faq->sort_order = $position + 1;
        $faq->save();

        return $this;
    }

    public function getAll(): Collection
    {
        return $this->model::orderBy('sort_order')->get();
    }

    public function getAllWithTrashed(): Collection
    {
        return $this->model::withTrashed()->orderBy('sort_order')->get();
    }

    public function getLastPosition(): ?int
    {
        return $this->model::withTrashed()->orderBy('sort_order', 'desc')->limit(1)->first()?->sort_order;
    }

    public function getNextAvailiblePosition()
    {
        return $this->getLastPosition() + 1;
    }

    protected function getNextEntry(FrequentlyAskedQuestion $faq): ?FrequentlyAskedQuestion
    {
        return $this->model::withTrashed()->where('sort_order', '>', $faq->sort_order)
            ->orderBy('sort_order')
                ->first();
    }

    protected function getPreviousEntry(FrequentlyAskedQuestion $faq): ?FrequentlyAskedQuestion
    {
        return $this->model::withTrashed()->where('sort_order', '<', $faq->sort_order)
            ->orderBy('sort_order', 'desc')
                ->first();
    }

    public function updateFromPatchRequest(FrequentlyAskedQuestion $faq, PatchFrequentlyAskedQuestionRequest $request): FrequentlyAskedQuestion
    {
        if ($faq->sort_order != $request->sort_order) {
            $this->makePositionAvailible($request->sort_order);
        }

        $this->baseUpdate($faq, $request->validated());

        return $faq;
    }

    public function moveDown(FrequentlyAskedQuestion $faq): self
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

    public function moveUp(FrequentlyAskedQuestion $faq): self
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
