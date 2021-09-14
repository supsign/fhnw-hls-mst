<?php

namespace App\Services\Token;

use App\Services\Auth\Role;

class ShibbolethProperties
{
    public $shibSesssionId;
    public $shibIdentityProvider;
    public $entitlement;
    public $fhnwIDPerson;
    public $givenName;
    public $mail;
    public $surname;
    public $fhnwDetailedAffiliation;
}
