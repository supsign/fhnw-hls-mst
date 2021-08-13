<?php

namespace App\Services\Auth;

use App\Services\Token\ShibbolethProperties;

class RoleService
{
    public function evaluate(ShibbolethProperties $shibbolethProperties): Role
    {
        if (str_contains($shibbolethProperties->fhnwDetailedAffiliation, 'staff-hls-alle')) {
            return Role::mentor();
        }

        return Role::student();
    }
}
