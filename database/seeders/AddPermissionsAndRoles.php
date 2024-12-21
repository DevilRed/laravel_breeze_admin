<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AddPermissionsAndRoles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissionNames = [];
        $existingPermissions = DB::table('permissions')->select('name', 'guard_name')->get()->toArray();

        // define permissions for each group
        $permissionsGroups = [
            ['group_name' => 'Admin',
                'permissions' => ['create room', 'view room', 'update room', 'delete room', 'create reservation', 'view reservation', 'update reservation', 'delete reservation']
            ],
            ['group_name' => 'Client',
                'permissions' => ['create client', 'login', 'logout', 'create reservation']
            ],
        ];

        foreach ($permissionsGroups as $group) {
            $group_name = $group['group_name'];
            $permissions = $group['permissions'];

            foreach ($permissions as $permission) {
                $exists = false;
                foreach ($existingPermissions as $existingPermission) {
                    if ($existingPermission->name === $permission && $existingPermission->guard_name === 'web') {
                        $exists = true;
                        break;
                    }
                }
                if (!$exists) {
                    $permissionNames[] = ['guard_name' => 'web', 'name' => $permission, 'group_name' => $group_name, 'created_at' => now(), 'updated_at' => now()];
                    $existingPermissions[] = (object) ['name' => $permission, 'guard_name' => 'web'];
                }
            }
        }

        Permission::insert($permissionNames);

        // create roles
        $adminRole = Role::create(['name' => 'admin']);
        $clientRole = Role::create(['name' => 'client']);

        // Assign permissions to roles
        $adminPermissions = Permission::where('group_name', 'Admin')->pluck('name')->toArray();
        $adminRole->givePermissionTo($adminPermissions);

        $clientPermissions = Permission::where('group_name', 'Client')->pluck('name')->toArray();
        $clientRole->givePermissionTo($clientPermissions);

        // Create users and assign roles
        $adminAccount = User::firstOrCreate([
            'name' => 'Admin test',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $adminAccount->assignRole($adminRole);

        $clientAccount = User::firstOrCreate([
            'name' => 'Client test',
            'email' => 'client@gmail.com',
            'password' => bcrypt('password'),
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $clientAccount->assignRole($clientRole);
    }
}
