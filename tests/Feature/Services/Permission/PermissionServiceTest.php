<?php

namespace Tests\Feature\Permission;

use App\Models\User;
use App\Services\User\CustomerUserService;
use App\Services\User\PermissionService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\TestCase;

class PermissionServiceTest extends TestCase
{
    public PermissionService $permissionService;

    /**
     * @throws BindingResolutionException
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->permissionService = $this->app->make(PermissionService::class);
    }

    public function test_AssignAndRemoveStudentRoles()
    {
        /** @var User $user */
        $user = User::factory()->asStudent()->create();
        $this->permissionService->assignStudent($user);
        $this->assertTrue($user->hasRole('student'));
        $this->permissionService->removeStudent($user);
        $this->assertFalse($user->hasRole('student'));
    }

    public function test_AssignAndRemoveMentorRoles()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->permissionService->assignMentor($user);
        $this->assertTrue($user->hasRole('mentor'));
        $this->permissionService->removeMentor($user);
        $this->assertFalse($user->hasRole('mentor'));
    }

    public function test_AssignAndRemoveAppAdminRoles()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->permissionService->assignAppAdmin($user);
        $this->assertTrue($user->hasRole('app-admin'));
        $this->permissionService->removeAppAdmin($user);
        $this->assertFalse($user->hasRole('app-admin'));
    }

// ToDo
// Write Permission Tests similar to icon project
}
