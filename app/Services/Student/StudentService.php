<?php

namespace App\Services\Student;

use App\Models\Student;
use App\Services\Helpers\hashes;

class StudentService
{
    use hashes;

    public function getByEventoPersonId(int $eventoPersonId)
    {
        $eventoPersonenIdHash = $this->getHash($eventoPersonId);

        return Student::where(['evento_person_id_hash' => $eventoPersonenIdHash])->first();
    }
}
