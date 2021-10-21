<?php

namespace App\Imports;

use App;
use App\Services\Student\StudentService;
use App\Services\StudyFieldYear\StudyFieldYearService;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport extends BaseExcelImport implements ToModel, WithHeadingRow
{
    protected array $requiredFields = [
        'id_anmeldung',
        'id_person',
        'id_anlass',
        'anlassnummer',
        'matrikel_nr',
        'vornamen',
        'nachname',
        'eintritt_per',
        'eintritt_in_periode',
        'status_anmeldung',
    ];
    protected StudentService $studentService;
    protected StudyFieldYearService $studyFieldYearService;

    public function __construct()
    {
        $this->studentService = App::make(StudentService::class);
        $this->studyFieldYearService = App::make(StudyFieldYearService::class);
    }

    /**
     * @param  array  $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row): void
    {
        if (!$this->hasRequiredFields($row) || $this->isEmptyRow($row)) {
            //  Throw error? Write log?
            return;
        }

        $attributes = [];

        if (!in_array($row['status_anmeldung'], ['jA.Immatrikuliert', 'jA.Angemeldet'])) {
            return;
        }

        $studyFieldYear = $this->studyFieldYearService->getByEventoId($row['id_anlass']);

        if ($studyFieldYear) {
            $attributes['study_field_year_id'] = $studyFieldYear->id;
        }

        $this->studentService->createOrUpdateOnEventoPersonId(
            $row['id_person'],
            $attributes
        );
    }
}
