<?php

namespace Database\Seeders;

use App\Services\User\UserService;
use Illuminate\Database\Seeder;

class ServerAdminSeeder extends Seeder
{
    public function __construct(
        protected UserService $userService,
    ) {
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this
            ->userService->updateOrCreateAsAppAdmin('hls@supsign.ch', 1, 'admin', 'admin')
            ->removeRole('mentor')
            ->removeRole('app-admin')
            ->assignRole('server-admin');
    }
}
