<?php

namespace Tests\Feature\Permission;

use App\Models\User;
use App\Services\User\CustomerUserService;
use App\Services\User\PermissionService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Symfony\Component\HttpKernel\Exception\HttpException;
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

        var_dump($user->student_id);
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

    public function test_canShowShop()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $user->givePermissionTo('show shop');
        $this->assertTrue($this->actingAs($user)->permissionService->canShowShopOrAbort() instanceof PermissionService);
    }

    public function test_canShowBackend()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $user->givePermissionTo('show backend');
        $this->assertTrue($this->actingAs($user)->permissionService->canShowBackendOrAbort() instanceof PermissionService);
    }

    public function test_canShowCustomerDetails()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $user->givePermissionTo('customer details');
        $this->assertTrue($this->actingAs($user)->permissionService->canShowCustomerDetailsOrAbort() instanceof PermissionService);
    }

    public function test_CanPlaceOrder()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $user->givePermissionTo('place orders');
        $this->assertTrue($this->actingAs($user)->permissionService->canPlaceOrderOrAbort() instanceof PermissionService);
    }

    public function test_AbortWhenNoBackendPermission()
    {
        $this->expectException(HttpException::class);

        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user)->permissionService->canShowBackendOrAbort();
    }

    public function test_AbortWhenNoShowShowPermission()
    {
        $this->expectException(HttpException::class);

        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user)->permissionService->canShowShopOrAbort();
    }

    public function test_AbortWhenNoCustomerDetailsPermission()
    {
        $this->expectException(HttpException::class);

        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user)->permissionService->canShowCustomerDetailsOrAbort();
    }

    public function test_AbortWhenNoPlaceOrderPermission()
    {
        $this->expectException(HttpException::class);

        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user)->permissionService->canPlaceOrderOrAbort();
    }
}
