<?php

namespace App\Services\Completion;

use App\Models\Completion;
use App\Models\Student;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\UpdateOrCreateTrait;

/**
 * @method Completion updateOrCreate(array $referenceAttributes, array $updateAttributes = [])
 */
class CompletionService extends BaseModelService
{
    use UpdateOrCreateTrait;

    public function __construct(protected Completion $model)
    {
        parent::__construct($model);
    }

    public function createOrUpdateAsCredit(Student $student, int $course_year_id, int $credits): Completion
    {
        $completion = $this->updateOrCreate(
            [
                'student_id' => $student->id,
                'course_year_id' => $course_year_id
            ],
            [
                'credits' => $credits,
                'completion_type_id' => 4
            ]);

        $student->load('completions');
        return $completion;
    }

}
