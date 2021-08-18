<?php

namespace App\Services\Mentor;

use App\Models\Mentor;
use App\Services\Helpers\hashes;

class MentorService
{
    use hashes;

    public function getByEventoPersonId(int $eventoPersonId)
    {
        $eventoPersonIdHash = $this->getHash($eventoPersonId);

        return Mentor::where(['evento_person_id_hash' => $eventoPersonIdHash])->first();
    }

    public function createOrUpdateOnEventoPersonId(int $eventoPersonId, string $lastname = null, string $firstname = null)
    {
        $eventoPersonIdHash = $this->getHash($eventoPersonId);

        return Mentor::updateOrCreate(
            ['evento_person_id_hash' => $eventoPersonIdHash],
            ['firstname' => $firstname, 'lastname' => $lastname]
        );
    }
}
