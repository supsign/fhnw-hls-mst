<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\User\PermissionAndRoleService;
use App\Services\User\UserService;
use Illuminate\Database\Seeder;

class ServerAdminSeeder extends Seeder
{
    public function __construct(
        protected UserService $userService,
        protected PermissionAndRoleService $permissionAndRoleService
    ) {
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->userService->udpateOrCreateAsMentor('hls@supsign.ch', 1, 'admin', 'admin')->assignRole('server-admin');
    }
}
