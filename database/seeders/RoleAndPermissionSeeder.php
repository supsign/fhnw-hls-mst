<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Roles
        $student = Role::create(['name' => 'student']);
        $mentor = Role::create(['name' => 'mentor']);
        $appAdmin = Role::create(['name' => 'app-admin']);
        $serverAdmin = Role::create(['name' => 'server-admin']);

        // Create Permissions
        Permission::create(['name' => 'show app']);
        Permission::create(['name' => 'show backend']);
        Permission::create(['name' => 'plan schedule']);
        Permission::create(['name' => 'plan my schedules']);
        Permission::create(['name' => 'plan students schedules']);
        Permission::create(['name' => 'manage backend']);

        $appAdmin->givePermissionTo('show app', 'show backend', 'manage backend');
        $mentor->givePermissionTo('show app', 'plan schedule', 'plan students schedules');
        $student->givePermissionTo('show app', 'plan schedule', 'plan my schedules');
        $serverAdmin->givePermissionTo(Permission::all());
    }
}
