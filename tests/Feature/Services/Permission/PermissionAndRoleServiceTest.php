<?php

namespace Tests\Feature\Services\Permission;

use App\Models\User;
use App\Services\User\PermissionAndRoleService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\TestCase;

class PermissionAndRoleServiceTest extends TestCase
{
    public PermissionAndRoleService $permissionAndRoleService;

    /**
     * @throws BindingResolutionException
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->permissionAndRoleService = $this->app->make(PermissionAndRoleService::class);
    }

    public function test_AssignAndRemoveStudentRoles()
    {
        /** @var User $user */
        $user = User::factory()->asStudent()->create();
        $this->permissionAndRoleService->assignStudent($user);
        $this->assertTrue($user->hasRole('student'));
        $this->permissionAndRoleService->removeStudent($user);
        $this->assertFalse($user->hasRole('student'));
    }

    public function test_AssignAndRemoveMentorRoles()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->permissionAndRoleService->assignMentor($user);
        $this->assertTrue($user->hasRole('mentor'));
        $this->permissionAndRoleService->removeMentor($user);
        $this->assertFalse($user->hasRole('mentor'));
    }

    public function test_AssignAndRemoveAppAdminRoles()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->permissionAndRoleService->assignAppAdmin($user);
        $this->assertTrue($user->hasRole('app-admin'));
        $this->permissionAndRoleService->removeAppAdmin($user);
        $this->assertFalse($user->hasRole('app-admin'));
    }

    // ToDo
// Write Permission Tests similar to icon project
}
