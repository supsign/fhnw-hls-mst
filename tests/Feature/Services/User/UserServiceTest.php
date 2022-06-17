<?php

namespace Tests\Feature\Services\User;

use App\Models\Mentor;
use App\Models\Student;
use App\Models\User;
use App\Services\Student\StudentService;
use App\Services\User\UserService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use WithFaker;
    private UserService $userService;
    private StudentService $studentService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->userService = $this->app->make(UserService::class);
        $this->studentService = $this->app->make(StudentService::class);
    }

    public function testServiceCreation()
    {
        $this->assertInstanceOf(UserService::class, $this->userService);
    }

    public function testUpdateOrCreateUserAsStudentWithstudent()
    {
        $eventoId = $this->faker->randomNumber(5);
        $this->studentService->createOrUpdateOnEventoPersonId($eventoId);
        $user = $this->userService->updateOrCreateUserAsStudent($this->faker->email(), $eventoId);
        $user->refresh();
        $this->assertInstanceOf(User::class, $user);
        $this->assertInstanceOf(Student::class, $user->student);
    }

    public function testUpdateOrCreateUserAsMentor()
    {
        $email = $this->faker->email();
        $user = $this->userService->udpateOrCreateAsMentor($email, $this->faker->randomNumber(5));
        $this->assertInstanceOf(User::class, $user);
        $user->refresh();
        $this->assertInstanceOf(Mentor::class, $user->mentor);
    }

    public function testPreventAssociatingMentorToMultipleUsers()
    {
        $eventoId = $this->faker->randomNumber(5);
        $userOne = $this->userService->udpateOrCreateAsMentor($this->faker->email(), $eventoId);
        $userTwo = $this->userService->udpateOrCreateAsMentor($this->faker->email(), $eventoId);
        $userOne->refresh();
        $userTwo->refresh();
        $this->assertNull($userOne->mentor);
    }

    public function testPreventAssociatingStudentToMultipleUsers()
    {
        $eventoId = $this->faker->randomNumber(5);
        $this->studentService->createOrUpdateOnEventoPersonId($eventoId);
        $userOne = $this->userService->updateOrCreateUserAsStudent($this->faker->email(), $eventoId);
        $userTwo = $this->userService->updateOrCreateUserAsStudent($this->faker->email(), $eventoId);
        $userOne->refresh();
        $userTwo->refresh();
        $this->assertNull($userOne->student);
    }
}
