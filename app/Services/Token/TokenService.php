<?php

namespace App\Services\Token;

class TokenService
{
    public function isValid(string $jwt): bool
    {
        return true;
    }

    public function getShibbolethProperties(string $jwt): ShibbolethProperties
    {
        $shibbolethProperties = new ShibbolethProperties();

        $shibbolethProperties->givenName = 'Matthias';
        $shibbolethProperties->surname = 'Baumgartner';
        $shibbolethProperties->fhnwIDPerson = 1234;
        $shibbolethProperties->mail = 'matthias@zehnders.ch';
        $shibbolethProperties->shibSesssionId = 'asfasdf43413';
        $shibbolethProperties->shibIdentityProvider = 'fhnw weis was der Teufel';
        $shibbolethProperties->fhnwDetailedAffiliation = 'staff-hls-alle';
        $shibbolethProperties->entitlement = 'sasfasde5643';

        return $shibbolethProperties;
    }
}
