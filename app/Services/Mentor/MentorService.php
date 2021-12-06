<?php

namespace App\Services\Mentor;

use App\Models\Mentor;
use App\Models\MentorStudyField;
use App\Models\StudyField;
use App\Services\Base\BaseModelService;
use App\Services\Evento\Traits\CreateOrUpdateOnEventoPersonId;
use App\Services\Evento\Traits\GetByEventoPersonId;

class MentorService extends BaseModelService
{
    use CreateOrUpdateOnEventoPersonId {
        createOrUpdateOnEventoPersonId AS protected createOrUpdateOnEventoPersonIdTrait;
    }
    use GetByEventoPersonId;

    public function __construct(protected Mentor $model)
    {
        parent::__construct($model);
    }

    public function addStudyField(Mentor $mentor, StudyField $studyField, bool $isDeputy = false): self
    {
        MentorStudyField::firstOrCreate([
            'mentor_id' => $mentor->id,
            'study_field_id' => $studyField->id,
            'is_deputy' => $isDeputy
        ]);

        return $this;
    }

    public function createOrUpdateOnEventoPersonId(int $eventoPersonId, string $lastname = null, string $firstname = null): Mentor
    {
        return $this->createOrUpdateOnEventoPersonIdTrait($eventoPersonId, [
            'firstname' => $firstname, 'lastname' => $lastname,
        ]);
    }
}
