<?php

namespace App\Imports;

use App;
use App\Services\Completion\CompletionService;
use App\Services\Course\CourseService;
use App\Services\Student\StudentService;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompletionCreditImport extends BaseExcelImport implements ToModel, WithHeadingRow
{
    protected array $requiredFields = ['id_anmeldung', 'id_person', 'id_anlass', 'anlassnummer', 'credits_anmeldung'];
    protected CourseService $courseService;
    protected CompletionService $completionService;
    protected StudentService $studentService;

    public function __construct()
    {
        $this->courseService = App::make(CourseService::class);
        $this->completionService = App::make(CompletionService::class);
        $this->studentService = App::make(StudentService::class);
    }

    /**
     * @param  array  $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (!$this->hasRequiredFields($row) || $this->isEmptyRow($row)) {
            //  Throw error? Write log?
            return;
        }

        $course = $this->courseService->getByEventoId($row['id_anlass']);

        if (!$course || !$course->courseYears()->count()) {
            return;
        }

        $this->completionService->createOrUpdateOnEventoIdAsCredit(
            $row['id_anmeldung'],
            $this->studentService->createOrUpdateOnEventoPersonId($row['id_person']),
            $course,
            $row['credits_anmeldung'],
        );
    }
}