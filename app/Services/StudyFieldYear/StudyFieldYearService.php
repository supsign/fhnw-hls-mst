<?php

namespace App\Services\StudyFieldYear;

use App\Models\StudyFieldYear;
use App\Services\Base\BaseModelService;
use App\Services\Evento\Traits\CreateOrUpdateOnEventoId;
use App\Services\Evento\Traits\GetByEventoId;
use App\Services\StudyField\StudyFieldService;
use Exception;

/**
 *  @method \App\Models\StudyFieldYear getByEventoId(int $eventoId)
 */
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

    public function createOrUpdateOnEventoId(int $eventId, array $attributes): StudyFieldYear   //  method mehr specific machen
    {
        if (empty($attributes['study_field_id']) && !empty($attributes['study_field_evento_id'])) { //  auslagern
            $attributes['study_field_id'] = $this
                ->studyFieldService
                    ->getByEventoId($attributes['study_field_evento_id'])
                        ->id;
        } else {
            throw new Exception('study_field_id field is required');
        }

        if (empty($attributes['begin_semester_id']) && !empty($attributes['evento_number'])) {  //  auslagern
            $attributes['begin_semester_id'] = $this
                ->studyFieldService
                    ->getSemesterFromEventoNumber($attributes['evento_number'])
                        ->id;
        } else {
            throw new Exception('begin_semester_id field is required');
        }

        return $this->createOrUpdateOnEventoIdTrait($eventId, $attributes);
    }

    public function getByStudyFieldIdAndSemesterId($studyFieldId, $semesterId): ?StudyFieldYear
    {
        return $this->model::where([
            'begin_semester_id' => $semesterId,
            'study_field_id' => $studyFieldId,
        ])->first();
    }
}
