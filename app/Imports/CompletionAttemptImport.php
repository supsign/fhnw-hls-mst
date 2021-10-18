<?php

namespace App\Imports;

use App;
use App\Services\Completion\CompletionService;
use App\Services\CourseYear\CourseYearService;
use App\Services\Student\StudentService;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompletionAttemptImport extends BaseExcelImport implements ToModel, WithHeadingRow
{
    protected array $requiredFields = ['id_anmeldung', 'id_person', 'id_anlass', 'anlassnummer', 'note', 'credits_anmeldung', 'status_anmeldung'];
    protected CourseYearService $courseYearService;
    protected CompletionService $completionService;
    protected StudentService $studentService;

    public function __construct()
    {
        $this->courseYearService = App::make(CourseYearService::class);
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

        $courseYear = $this->courseYearService->getByEventoId($row['id_anlass']);

        if (!$courseYear) {
            return;
        }

        $this->completionService->createUpdateOrDeleteOnEventoIdAsAttempt(
            $row['id_anmeldung'],
            $this->studentService->createOrUpdateOnEventoPersonId($row['id_person']),
            $courseYear,
            $row['credits_anmeldung'],
            $row['status_anmeldung'],
            (string)$row['note'],
        );
    }
}
