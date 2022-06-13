<?php

namespace App\Imports;

use App;
use App\Services\Completion\CompletionService;
use App\Services\Course\CourseService;
use App\Services\CourseYear\CourseYearService;
use App\Services\Student\StudentService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompletionAttemptImport extends BaseExcelImport implements ToModel, WithHeadingRow
{
    protected array $requiredFields = [
        'id_anmeldung',
        'id_person',
        'id_anlass',
        'anlassnummer',
        'note',
        'credits_anmeldung',
        'status_anmeldung',
        'id_anlass_modul',
        'anlassbezeichnung_modul',
        'anlassnummer_modul',

    ];
    protected CourseService $courseService;
    protected CourseYearService $courseYearService;
    protected CompletionService $completionService;
    protected StudentService $studentService;

    public function __construct()
    {
        $this->courseService = App::make(CourseService::class);
        $this->courseYearService = App::make(CourseYearService::class);
        $this->completionService = App::make(CompletionService::class);
        $this->studentService = App::make(StudentService::class);

        $this->logFilename = 'storage/logs/import_courses_from_completion_attempt_log_'.Carbon::now();

        file_put_contents($this->logFilename, 'evento_id;status'.PHP_EOL);
    }

    /**
     * @param  array  $row
     * @return Model|null
     */
    public function model(array $row)
    {
        if (!$this->hasRequiredFields($row) || $this->isEmptyRow($row)) {
            return;
        }

        $courseYear = $this->courseYearService->getByEventoId($row['id_anlass']);

        if (!$courseYear) {
            $course = $this->courseService->createOrUpdateOnEventoId($row['id_anlass_modul'], [
                'course_type_id' => 1,
                'language_id' => 1,
                'number' => $row['anlassnummer_modul'],
                'name' => $row['anlassbezeichnung_modul'],
                // 'credits' => (int)$row['credits_anmeldung'],
            ]);

            if ($course->wasRecentlyCreated) {
                file_put_contents($this->logFilename, $row['id_anlass'].';created'.PHP_EOL, FILE_APPEND);
            }

            $courseYear = $this->courseYearService->createOrUpdateOnEventoId(
                $row['id_anlass'],
                $course,
                $row['anlassnummer'],
                $row['anlassbezeichnung'],
            );
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
