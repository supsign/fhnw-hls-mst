<?php

namespace App\Services\StudyField;

use App\Models\Semester;
use App\Models\StudyField;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\UpdateTrait;
use App\Services\Evento\Traits\CreateOrUpdateOnEventoId;
use App\Services\Evento\Traits\GetByEventoId;

class StudyFieldService extends BaseModelService
{
    use CreateOrUpdateOnEventoId;
    use GetByEventoId;
    use UpdateTrait;

    public function __construct(protected StudyField $model)
    {
        parent::__construct($model);
    }

    protected function extractYearFromEventoNumber(string $eventoNumber): int
    {
        return str_pad(
            (int)filter_var(
                substr($eventoNumber, strpos($eventoNumber, '/')),
                FILTER_SANITIZE_NUMBER_INT  
            ),
            4,
            '20',
            STR_PAD_LEFT
        );   
    }

    public function getSemesterFromEventoNumber(string $eventoNumber): Semester
    {
        $year = $this->extractYearFromEventoNumber($eventoNumber);



        return new Semester;
    }
}
