<?php

namespace Tests\Feature\Services\Auth;

use App\Models\Mentor;
use App\Models\Student;
use App\Models\User;
use App\Services\Auth\AuthService;
use App\Services\Student\StudentService;
use App\Services\Token\ShibbolethProperties;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class AuthServiceTest extends TestCase
{

    use WithFaker;
    protected AuthService $authService;
    protected StudentService $studentService;

    protected function setup():void {
        parent::setUp();
        $this->setUpFaker();
        $this->authService = $this->app->make(AuthService::class);
        $this->studentService = $this->app->make(StudentService::class);
    }

    public function testIsAuthorizedForLogin()
    {
        $shibbolethProperties = new ShibbolethProperties();
        $shibbolethProperties->mail = $this->faker->email();
        $shibbolethProperties->fhnwIDPerson = $this->faker->randomNumber(5);

        $isAuthorizedForLogin = $this->invokeMethod($this->authService,'isAuthorizedForLogin',[$shibbolethProperties]);

        $this->assertTrue($isAuthorizedForLogin);
        
    }

    public function testIsNotAuthorizedForLoginMissingFhnwId()
    {
        $shibbolethProperties = new ShibbolethProperties();
        $shibbolethProperties->mail = $this->faker->email();

        $isAuthorizedForLogin = $this->invokeMethod($this->authService,'isAuthorizedForLogin',[$shibbolethProperties]);

        $this->assertFalse($isAuthorizedForLogin);
        
    }

    public function testIsNotAuthorizedForLoginMissingAll()
    {
        $shibbolethProperties = new ShibbolethProperties();

        $isAuthorizedForLogin = $this->invokeMethod($this->authService,'isAuthorizedForLogin',[$shibbolethProperties]);

        $this->assertFalse($isAuthorizedForLogin);
        
    }

    public function testIsNotAuthorizedForloginMissingMail()
    {
        $shibbolethProperties = new ShibbolethProperties();
        $shibbolethProperties->fhnwIDPerson = $this->faker->randomNumber(5);

        $isAuthorizedForLogin = $this->invokeMethod($this->authService,'isAuthorizedForLogin',[$shibbolethProperties]);

        $this->assertFalse($isAuthorizedForLogin);
        
    }

    public function testLoginAsStudentNotExiting()
    {
        $shibbolethProperties = new ShibbolethProperties();
        $shibbolethProperties->mail = $this->faker->email();
        $shibbolethProperties->fhnwIDPerson = $this->faker->randomNumber(5);

        $this->assertFalse(Auth::check());

        $user = $this->invokeMethod($this->authService,'login',[$shibbolethProperties]);
        $this->assertInstanceOf(User::class, $user);
        
        $this->assertTrue(Auth::check());
        $this->assertTrue(Auth::user()->id === $user->id);
    }

    public function testLoginAsStudentExiting()
    {

        $shibbolethProperties = new ShibbolethProperties();
        $shibbolethProperties->mail = $this->faker->email();
        $shibbolethProperties->fhnwIDPerson = $this->faker->randomNumber(5);
        $this->studentService->createOrUpdateOnEventoPersonId($shibbolethProperties->fhnwIDPerson);

        $this->assertFalse(Auth::check());

        $user = $this->invokeMethod($this->authService,'login',[$shibbolethProperties]);
        $this->assertInstanceOf(User::class, $user);
        
        $this->assertTrue(Auth::check());
        $this->assertTrue(Auth::user()->id === $user->id);
        $this->assertInstanceOf(Student::class, $user->student);
    }

    public function testLoginAsMentor()
    {

        $shibbolethProperties = new ShibbolethProperties();
        $shibbolethProperties->mail = $this->faker->email();
        $shibbolethProperties->fhnwIDPerson = $this->faker->randomNumber(5);
        $shibbolethProperties->fhnwDetailedAffiliation = 'staff-hls-alle;sldkjf;aslkdfj';

        $this->assertFalse(Auth::check());

        $user = $this->invokeMethod($this->authService,'login',[$shibbolethProperties]);
        $this->assertInstanceOf(User::class, $user);
        
        $this->assertTrue(Auth::check());
        $this->assertTrue(Auth::user()->id === $user->id);
        $this->assertInstanceOf(Mentor::class, $user->mentor);
    }

    public function testLoginAttempt()
    {

        $shibbolethProperties = new ShibbolethProperties();
        $shibbolethProperties->mail = $this->faker->email();
        $shibbolethProperties->fhnwIDPerson = $this->faker->randomNumber(5);
        $shibbolethProperties->fhnwDetailedAffiliation = 'staff-hls-alle;sldkjf;aslkdfj';

        $this->assertFalse(Auth::check());

        $this->authService->attempt('asdf');
         
        $this->assertTrue(Auth::check());

    }

}