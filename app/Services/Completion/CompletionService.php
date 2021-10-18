<?php

namespace App\Services\Completion;

use App\Models\Completion;
use App\Models\CourseYear;
use App\Models\Student;
use App\Services\Base\BaseModelService;
use App\Services\Evento\Traits\CreateOrUpdateOnEventoId;
use App\Services\Evento\Traits\GetByEventoId;

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

    public function createUpdateOrDeleteOnEventoId(int $eventoId, Student $student, CourseYear $courseYear, int $credits, string $status, string $grade = ''): ?Completion
    {
        switch (true) {
            case empty($grade):                             $completionTypeId = 1; break;
            case $grade === 'erfüllt' || $grade >= 4:       $completionTypeId = 2; break;
            case $grade === 'nicht erfüllt' || $grade < 4:  $completionTypeId = 3; break;
            default: $status = '';
        }

        if ($status !== 'aA.Angemeldet') {
            $this->getByEventoId($eventoId)?->delete();

            return null;
        }

        return $this->createOrUpdateOnEventoIdTrait($eventoId, [
            'student_id' => $student->id,
            'course_year_id' => $courseYear->id,
            'credits' => $credits,
            'completion_type_id' => $completionTypeId,
        ]);
    }
}
