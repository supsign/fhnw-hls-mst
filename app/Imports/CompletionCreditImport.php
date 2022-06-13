<?php

namespace App\Imports;

use App;
use App\Services\Completion\CompletionService;
use App\Services\Course\CourseService;
use App\Services\Student\StudentService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompletionCreditImport extends BaseExcelImport implements ToModel, WithHeadingRow
{
    protected array $requiredFields = ['id_anmeldung', 'id_person', 'id_anlass', 'anlassnummer', 'anlassbezeichnung', 'credits'];
    protected CourseService $courseService;
    protected CompletionService $completionService;
    protected StudentService $studentService;

    public function __construct()
    {
        $this->courseService = App::make(CourseService::class);
        $this->completionService = App::make(CompletionService::class);
        $this->studentService = App::make(StudentService::class);

        $this->logFilename = 'storage/logs/import_courses_from_completion_credit_log_'.Carbon::now();

        file_put_contents($this->logFilename, 'evento_id;status'.PHP_EOL);
    }

    /**
     * @param  array  $row
     * @return Model|null
     */
    public function model(array $row)
    {
        if (!$this->hasRequiredFields($row) || $this->isEmptyRow($row)) {
            //  Throw error? Write log?
            return;
        }

        $course = $this->courseService->getByEventoId($row['id_anlass']);

        if (!$course) {
            $course = $this->courseService->firstOrCreateByNumber(
                $row['id_anlass'],
                1,
                1,
                $row['anlassbezeichnung'],
                // $row['credits'],
            );

            file_put_contents($this->logFilename, $row['id_anlass'].';created'.PHP_EOL, FILE_APPEND);
        }

        $this->completionService->createOrUpdateOnEventoIdAsCredit(
            $row['id_anmeldung'],
            $this->studentService->createOrUpdateOnEventoPersonId($row['id_person']),
            $course,
            $row['credits'],
        );
    }
}
