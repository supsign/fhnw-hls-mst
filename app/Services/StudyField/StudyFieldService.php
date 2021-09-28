<?php

namespace App\Services\StudyField;

use App\Models\Semester;
use App\Models\StudyField;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\UpdateTrait;
use App\Services\Evento\Traits\CreateOrUpdateOnEventoId;
use App\Services\Evento\Traits\GetByEventoId;
use App\Services\Semester\SemesterService;

class StudyFieldService extends BaseModelService
{
    use CreateOrUpdateOnEventoId;
    use GetByEventoId;
    use UpdateTrait;

    public function __construct(protected StudyField $model, protected SemesterService $semesterService)
    {
        parent::__construct($model);
    }

    public function extractYearFromEventoNumber(string $eventoNumber): int  //  should be protected
    {
        return str_pad(
            (int)filter_var(
                substr($eventoNumber, strpos($eventoNumber, '/')),
                FILTER_SANITIZE_NUMBER_INT
            ),
            4,
            '20',           //  expected value hast to be in the year 20xx, fix before 2100
            STR_PAD_LEFT
        );
    }

    public function getSemesterFromEventoNumber(string $eventoNumber): Semester
    {
        return $this->semesterService->firstOrcreateByYear(
            $this->extractYearFromEventoNumber($eventoNumber)
        );
    }
}
