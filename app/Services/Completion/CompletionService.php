<?php

namespace App\Services\Completion;

use App\Models\Completion;
use App\Models\Course;
use App\Models\CourseYear;
use App\Models\Student;
use App\Services\Base\BaseModelService;
use App\Services\Evento\Traits\CreateOrUpdateOnEventoId;
use App\Services\Evento\Traits\GetByEventoId;
use Illuminate\Support\Collection;

/**
 * @method Completion updateOrCreate(array $referenceAttributes, array $updateAttributes = [])
 */
class CompletionService extends BaseModelService
{
    use GetByEventoId;
    use CreateOrUpdateOnEventoId {
        createOrUpdateOnEventoId as protected createOrUpdateOnEventoIdTrait;
    }

    public function __construct(protected Completion $model)
    {
        parent::__construct($model);
    }

    public function createUpdateOrDeleteOnEventoIdAsAttempt(int $eventoId, Student $student, CourseYear $courseYear, int $credits, string $status, string $grade = ''): ?Completion
    {
        switch (true) {
            case empty($grade):
                $completionTypeId = 1;
                break;
            case $grade === 'erfüllt' || $grade >= 4:
                $completionTypeId = 2;
                break;
            case $grade === 'nicht erfüllt' || $grade < 4:
                $completionTypeId = 3;
                break;
            default:
                $status = '';
        }

        if ($status !== 'aA.Angemeldet') {
            $this->getByEventoId($eventoId)?->delete();

            return null;
        }

        /* @var $completion Completion */
        $completion = $this->createOrUpdateOnEventoIdTrait($eventoId, [
            'student_id' => $student->id,
            'course_year_id' => $courseYear->id,
            'credits' => $credits,
            'completion_type_id' => $completionTypeId,
        ]);

        if (isset($student->completions)) {
            $student->load('completions');
        }

        return $completion;
    }

    public function createOrUpdateOnEventoIdAsCredit(int $eventoId, Student $student, Course $course, int $credits): Completion
    {
        /* @var $completion Completion */
        $completion = $this->createOrUpdateOnEventoIdTrait($eventoId, [
            'student_id' => $student->id,
            'course_year_id' => $course->courseYears()->first()->id,
            'credits' => $credits,
            'completion_type_id' => 4,
        ]);

        if (isset($student->completions)) {
            $student->load('completions');
        }

        return $completion;
    }

    public function hasSuccessfulCompletions(Collection $completions): bool
    {
        $successfulCompletions = $completions->filter(function (Completion $completion) {
            return $completion->completion_type_id === 2 || $completion->completion_type_id === 4;
        });

        if ($successfulCompletions->count() !== 0) {
            return true;
        }

        return false;
    }

    public function hasFailedCompletions(Collection $completions): bool
    {
        $failedCompletions = $completions->filter(function (Completion $completion) {
            return $completion->completion_type_id === 3;
        });

        if ($failedCompletions->count() !== 0) {
            return true;
        }

        return false;
    }
}
