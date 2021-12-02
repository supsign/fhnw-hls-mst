<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\User\PermissionAndRoleService;
use Illuminate\Database\Seeder;

class ServerAdminSeeder extends Seeder
{
    public function __construct(protected PermissionAndRoleService $permissionAndRoleService)
    {
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate([
            'email_hash' => '5ab7586c41ff8b3911b44438e9374c2819c64deb08659406e8e89b0d9d00c94588e46714af30dda96c99065d77add8c0b2b182ba865cef75df89119edd0509a0',
        ]);

        $user->assignRole('server-admin');
    }
}
