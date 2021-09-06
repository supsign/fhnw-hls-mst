<?php

namespace App\Services\Auth;

use App\Services\Token\ShibbolethProperties;
use Exception;

class RoleService
{
    public function evaluate(ShibbolethProperties $shibbolethProperties): Role
    {
        if (! $shibbolethProperties->mail) {
            throw new Exception('no authorized role identified');
        }

        if (! $shibbolethProperties->fhnwIDPerson) {
            throw new Exception('no authorized role identified');
        }

        if (str_contains($shibbolethProperties->fhnwDetailedAffiliation, 'staff-hls-alle')) {
            return Role::mentor();
        }

        return Role::student();
    }
}
