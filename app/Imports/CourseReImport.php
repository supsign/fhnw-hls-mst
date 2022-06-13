<?php

namespace App\Imports;

use App;
use App\Models\Course;
use App\Services\Course\CourseService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CourseReImport extends BaseExcelImport implements ToModel, WithHeadingRow
{
    protected array $requiredFields = ['id_anlass', 'anlassnummer', 'anlassbezeichnung'];
    protected CourseService $service;

    public function __construct()
    {
        $this->service = App::make(CourseService::class);
        $this->courseEventoIds = Course::whereNotNull('evento_id')->get()->pluck('evento_id')->toArray();
        $this->logFilename = 'storage/logs/import_courses_log_'.Carbon::now();

        file_put_contents($this->logFilename, 'evento_id;status'.PHP_EOL);
    }

    public function __destruct()
    {
        foreach ($this->courseEventoIds AS $eventoId) {
            file_put_contents($this->logFilename, $eventoId.';removed'.PHP_EOL, FILE_APPEND);
        }
    }

    /**
     * @param  array  $row
     * @return Model|null
     */
    public function model(array $row): void
    {
        if (!$this->hasRequiredFields($row) || $this->isEmptyRow($row)) {
            //  Throw error? Write log?
            return;
        }

        $course = $this->service->getByEventoId($row['id_anlass']);

        if ($course) {
            file_put_contents($this->logFilename, $row['id_anlass'].';exists'.PHP_EOL, FILE_APPEND);
            $this->removeEventIdFromArray($row['id_anlass']);

            return;
        }

        $this->service->createOrUpdateOnEventoId(
            $row['id_anlass'],
            [
                'course_type_id' => 1,
                'number' => $row['anlassnummer'],
                'name' => $row['anlassbezeichnung'],
                'language_id' => 1,
            ]
        );

        file_put_contents($this->logFilename, $row['id_anlass'].';created'.PHP_EOL, FILE_APPEND);
        $this->removeEventIdFromArray($row['id_anlass']);
    }

    protected function removeEventIdFromArray(int $id): self
    {
        if (($key = array_search($id, $this->courseEventoIds)) !== false) {
            unset($this->courseEventoIds[$key]);
        }

        return $this;
    }
}
