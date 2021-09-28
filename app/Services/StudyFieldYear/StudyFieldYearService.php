<?php

namespace App\Services\StudyFieldYear;

use App\Models\StudyFieldYear;
use App\Services\Base\BaseModelService;
use App\Services\Evento\Traits\CreateOrUpdateOnEventoId;
use App\Services\Evento\Traits\GetByEventoId;
use App\Services\StudyField\StudyFieldService;

class StudyFieldYearService extends BaseModelService
{
    use CreateOrUpdateOnEventoId {
        createOrUpdateOnEventoId AS protected createOrUpdateOnEventoIdTrait;
    }
    use GetByEventoId;

    public function __construct(protected StudyFieldYear $model, protected StudyFieldService $studyFieldService)
    {
        parent::__construct($model);
    }

    public function createOrUpdateOnEventoId(int $eventId, array $attributes): StudyFieldYear
    {
        $attributes['begin_semseter_id'] = $this
            ->studyFieldService
                ->getSemesterFromEventoNumber($attributes['evento_number'])
                    ->id;

        return new StudyFieldYear;      //  debug code
        return $this->createOrUpdateOnEventoIdTrait($eventId, $attributes);
    }
}
