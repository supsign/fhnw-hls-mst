<?php

namespace App\Services\Auth;

use App\Services\Token\ShibbolethProperties;
use Exception;

class RoleService
{
    public function evaluate(ShibbolethProperties $shibbolethProperties): string
    {
        if (!$shibbolethProperties->mail || !$shibbolethProperties->entitlement) {
            throw new Exception('no authorized role identified');
        }

        $staticPartOfUrl = 'http://fhnw.ch/aai/res/hls/stab/';

        switch (true) {
            case str_contains($shibbolethProperties->entitlement, $staticPartOfUrl.'mst_admin'):
                return 'app-admin';

            case str_contains($shibbolethProperties->entitlement, $staticPartOfUrl.'mst_stgl'):
            case str_contains($shibbolethProperties->entitlement, $staticPartOfUrl.'mst_mentor'):
                return 'mentor';

            case str_contains($shibbolethProperties->entitlement, $staticPartOfUrl.'mst_adm_student'):
            case str_contains($shibbolethProperties->entitlement, $staticPartOfUrl.'mst_edu_student'):
                return 'student';

            default:
                throw new Exception('no authorized role identified');
        }
    }
}
