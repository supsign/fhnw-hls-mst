<?php

namespace App\Services\Completion;

use App\Models\Completion;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\FirstOrCreateTrait;

/**
 * @method Completion firstOrCreate(array $referenceAttributes, array $insertAttributes = [])
 */
class CompletionService extends BaseModelService
{
    use FirstOrCreateTrait;

    public function __construct(protected Completion $model)
    {
        parent::__construct($model);
    }

    public function createOrUpdateAsCredit(int $student_id, int $course_year_id, int $credits): Completion
    {
        return $this->firstOrCreate(
            [
                'student_id' => $student_id,
                'course_year_id' => $course_year_id
            ],
            [
                'credits' => $credits,
                'completion_id' => 4
            ]);
    }

}
