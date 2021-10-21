<?php

namespace App\Imports;

use App;
use App\Services\CourseYear\CourseYearService;
use App\Services\Lesson\LessonService;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LessonCleanup extends BaseExcelImport implements ToModel, WithHeadingRow
{
    protected array $requiredFields = ['id_anlass', 'anlassnummer', 'datum', 'wochentag', 'zeit_von', 'zeit_bis'];
    protected CourseYearService $courseYearSerivce;
    protected LessonService $lessonService;

    public function __construct()
    {
        $this->courseYearSerivce = App::make(CourseYearService::class);
        $this->lessonService = App::make(LessonService::class);
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

        $courseYear = $this->courseYearSerivce->getByEventoId($row['id_anlass']);

        if (!$courseYear) {
            return;
        }

        $this->lessonService->removeLessonsFromCourseYear($courseYear);
    }
}
