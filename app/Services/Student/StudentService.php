<?php

namespace App\Services\Student;

use App\Models\Student;
use App\Services\Base\BaseModelService;
use App\Services\Helpers\hashes;

class StudentService extends BaseModelService
{
    use Hashes;

    public function getByEventoPersonId(int $eventoPersonId): ?Student
    {
        $eventoPersonenIdHash = $this->getHash($eventoPersonId);

        return Student::where(['evento_person_id_hash' => $eventoPersonenIdHash])->first();
    }

    public function createOrUpdateOnEventoPersonId(int $eventoPersonId)
    {
        $eventoPersonIdHash = $this->getHash($eventoPersonId);

        return Student::updateOrCreate(
            ['evento_person_id_hash' => $eventoPersonIdHash]
        );
    }
}
