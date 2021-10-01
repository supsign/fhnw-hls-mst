<?php

namespace Tests\Feature\Services\Permission;

use App\Models\User;
use App\Services\User\PermissionAndRoleService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\TestCase;

class PermissionAndRoleServiceTest extends TestCase
{
    public PermissionAndRoleService $PermissionAndRoleService;

    /**
     * @throws BindingResolutionException
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->PermissionAndRoleService = $this->app->make(PermissionAndRoleService::class);
    }

    public function test_AssignAndRemoveStudentRoles()
    {
        /** @var User $user */
        $user = User::factory()->asStudent()->create();
        $this->PermissionAndRoleService->assignStudent($user);
        $this->assertTrue($user->hasRole('student'));
        $this->PermissionAndRoleService->removeStudent($user);
        $this->assertFalse($user->hasRole('student'));
    }

    public function test_AssignAndRemoveMentorRoles()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->PermissionAndRoleService->assignMentor($user);
        $this->assertTrue($user->hasRole('mentor'));
        $this->PermissionAndRoleService->removeMentor($user);
        $this->assertFalse($user->hasRole('mentor'));
    }

    public function test_AssignAndRemoveAppAdminRoles()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->PermissionAndRoleService->assignAppAdmin($user);
        $this->assertTrue($user->hasRole('app-admin'));
        $this->PermissionAndRoleService->removeAppAdmin($user);
        $this->assertFalse($user->hasRole('app-admin'));
    }

    // ToDo
// Write Permission Tests similar to icon project
}
