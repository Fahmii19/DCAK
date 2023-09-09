<?php

namespace Database\Seeders;


use App\Models\User_dcak;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionDemoSeeder extends Seeder
{
    public function run()
    {
        // reset cached roles and permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions with guard 'web'
        Permission::create(['name' => 'view koordinator', 'guard_name' => 'web']);
        Permission::create(['name' => 'view calon pemilih', 'guard_name' => 'web']);
        Permission::create(['name' => 'view pemilih', 'guard_name' => 'web']);
        Permission::create(['name' => 'view akun dcak', 'guard_name' => 'web']);

        // create roles with guard 'web' and assign existing permissions
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->givePermissionTo('view calon pemilih');

        $superadminRole = Role::create(['name' => 'super-admin', 'guard_name' => 'web']);
        // superadmin gets all permissions via Gate::before rule

        // create demo users
        $user = User_dcak::create([
            'username' => 'admin',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($adminRole);

        $user = User_dcak::create([
            'username' => 'superadmin',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($superadminRole);
    }
}
