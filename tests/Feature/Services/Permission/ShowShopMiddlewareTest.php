<?php

namespace Tests\Feature\Permission;

use App\Models\Customer;
use App\Models\User;
use App\Services\User\CustomerUserService;
use Tests\TestCase;

class ShowShopMiddlewareTest extends TestCase
{
    public CustomerUserService $customerUserService;

    public function setUp(): void
    {
        parent::setUp();

        $this->customerUserService = $this->app->make(CustomerUserService::class);
    }

    public function test_UserWithoutCustomer()
    {
        /** @var User $user */
        $user = User::factory()->create();

        // No Permission & No Role
        $this->actingAs($user)->get(route('home'))->assertStatus(403);

        // Visitor
        $user->assignRole('visitor');
        $this->actingAs($user)->get(route('home'))->assertOk();
        $user->removeRole('visitor');

        // Emplyoee
        $user->assignRole('employee');
        $this->actingAs($user)->get(route('home'))->assertStatus(403);
        $user->removeRole('employee');

        // Buyer
        $user->assignRole('buyer');
        $this->actingAs($user)->get(route('home'))->assertStatus(403);
        $user->removeRole('buyer');

        // Server Admin
        $user->assignRole('super-admin');
        $this->actingAs($user)->get(route('home'))->assertStatus(403);
        $user->removeRole('super-admin');
    }

    public function test_UserWithCustomer()
    {
        /** @var User $user */
        /** @var Customer $customer */
        $user = User::factory()->create();
        $customer = Customer::factory()->create();

        $this->customerUserService->attach($customer, $user);

        // No Permission & No Role
        $this->actingAs($user)->get(route('home'))->assertStatus(403);

        // Visitor
        $user->assignRole('visitor');
        $this->actingAs($user)->get(route('home'))->assertOk();
        $user->removeRole('visitor');

        // Buyer
        $user->assignRole('employee');
        $this->actingAs($user)->get(route('home'))->assertOk();
        $user->removeRole('employee');

        // Buyer
        $user->assignRole('buyer');
        $this->actingAs($user)->get(route('home'))->assertOk();
        $user->removeRole('buyer');

        // Server Admin
        $user->assignRole('super-admin');
        $this->actingAs($user)->get(route('home'))->assertOk();
        $user->removeRole('super-admin');
    }
}
