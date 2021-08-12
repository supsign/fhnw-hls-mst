<?php

namespace App\Services;

class TokenService {
    public function isValid(string $jwt):bool {
        return true;
    }


    public function getClaims(string $jwt):Claims {
        $claims = new Claims();
        
        $claims->firstname = 'Matthias';
        $claims->lastname = 'Baumgartner';
        $claims->eventoId = 1234;
        $claims->role = 'student';
        $claims->mail = 'matthias@zehnders.ch';

        return $claims;
    }
}