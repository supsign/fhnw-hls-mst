<?php

namespace Tests\Feature\Services\Auth;

use App\Services\Auth\Role;
use App\Services\Auth\RoleService;
use App\Services\Student\StudentService;
use App\Services\Token\ShibbolethProperties;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class RoleServiceTest extends TestCase
{

    use WithFaker;
    protected RoleService $roleService;


    protected function setup():void {
        parent::setUp();
        $this->setUpFaker();
        $this->roleService = $this->app->make(RoleService::class);
    }

    public function testEvaluateStudentRole()
    {
        $shibbolethProperties = new ShibbolethProperties();
        $shibbolethProperties->mail = $this->faker->email;
        $shibbolethProperties->fhnwIDPerson = $this->faker->randomNumber(5);
        $role = $this->roleService->evaluate($shibbolethProperties);
        $this->assertInstanceOf(Role::class, $role);
        $this->assertTrue($role->getName() === 'student');
        
    }

    public function testEvaluateStudentMentor()
    {
        $shibbolethProperties = new ShibbolethProperties();
        $shibbolethProperties->mail = $this->faker->email;
        $shibbolethProperties->fhnwIDPerson = $this->faker->randomNumber(5);
        $shibbolethProperties->fhnwDetailedAffiliation = 'asdasdf:asdf"asdf;staff-hls-alle;asdf';
        $role = $this->roleService->evaluate($shibbolethProperties);
        $this->assertInstanceOf(Role::class, $role);
        $this->assertTrue($role->getName() === 'mentor');
        
    }

}