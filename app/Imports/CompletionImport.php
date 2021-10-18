<?php

namespace App\Imports;

use App;
use App\Services\Completion\CompletionService;
use App\Services\Student\StudentService;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompletionImport extends BaseExcelImport implements ToModel, WithHeadingRow
{
    protected array $requiredFields = ['id_anmeldung', 'id_person', 'id_anlass', 'anlassnummer', 'note', 'credits_anmeldung', 'status_anmeldung'];
    protected CompletionService $completionService;
    protected StudentService $studentService;

    public function __construct()
    {
        $this->completionService = App::make(CompletionService::class);
        $this->studentService = App::make(StudentService::class);
    }

    /**
     * @param  array  $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        var_dump($row);

        if (!$this->hasRequiredFields($row) || $this->isEmptyRow($row)) {
            //  Throw error? Write log?
            return;
        }


        // $this->completionService->createUpdateOrDeleteOnEventoId(
        //     $row['id_anmeldung'],
        //     $this->studentService->getByEventoPersonId($row['id_person']),
            
        // );

    }
}
