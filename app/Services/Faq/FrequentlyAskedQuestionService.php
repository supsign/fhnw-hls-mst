<?php

namespace App\Services\Faq;

use App\Models\FrequentlyAskedQuestion;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\UpdateTrait;

class FrequentlyAskedQuestionService extends BaseModelService
{
    use UpdateTrait{
        update AS protected baseUpdate;
    }

    public function __construct(protected FrequentlyAskedQuestion $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        return $this->model::orderBy('sort_order')->get();
    }

    public function getAllWithTrashed()
    {
        return $this->model::withTrashed()->orderBy('sort_order')->get();
    }
}
