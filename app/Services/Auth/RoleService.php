<?php

namespace App\Services\Auth;

use App\Services\Token\ShibbolethProperties;
use Exception;

class RoleService
{
    private $admins = [
        'beat.zehnder@fhnw.ch',
        'lilian.gilgen@fhnw.ch',
        'andreas.seelig@fhnw.ch',

    ];
    private $mentors = [
        'miriam.langer@fhnw.ch',
        'markus.degen@fhnw.ch',
        'goetz.schlotterbeck@fhnw.ch',
        'oliver.germershaus@fhnw.ch',
        'frank.pude@fhnw.ch',
        'laura.suterdick@fhnw.ch',
        'simone.hemm@fhnw.ch',
    ];
    private $students = [
        'britta.brugger@students.fhnw.ch',
        'nadja.flueckiger@students.fhnw.ch',
        'lukas.ackermann@students.fhnw.ch',
        'talea.marty@students.fhnw.ch',
        'tabea.grossenbacher@students.fhnw.ch',
        'luca.anderhub@students.fhnw.ch',
        'jana.leonhardt@students.fhnw.ch',
        'adam.kummer@students.fhnw.ch',
        'tiffany.moraz@students.fhnw.ch',
        'jonas.hauswurz@students.fhnw.ch',
        'gianluca.frongia@students.fhnw.ch',
        'tamara.ammonkircher@students.fhnw.ch',
        'gentian.bilalli@students.fhnw.ch',
        'malte.probst@students.fhnw.ch',
        'philippe.langer@students.fhnw.ch',
        'antonia.luethi@students.fhnw.ch',
        'benedikt.broennimann@students.fhnw.ch',
        'keanu.werder@students.fhnw.ch',
        'sebastian.stalder@students.fhnw.ch',
        'studenthls.iamtest@students.fhnw.ch',
        'andreas.seelig@students.fhnw.ch',
    ];

    public function evaluate(ShibbolethProperties $shibbolethProperties): string
    {
        if (!$shibbolethProperties->mail) {
            throw new Exception('no authorized role identified');
        }

        if (in_array($shibbolethProperties->mail, $this->admins)) {
            return 'app-admin';
        }

        if (in_array($shibbolethProperties->mail, $this->mentors)) {
            return 'mentor';
        }

        if (in_array($shibbolethProperties->mail, $this->students)) {
            return 'student';
        }

        throw new Exception('no authorized role identified');
    }
}
