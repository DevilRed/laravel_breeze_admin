<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        $permissionsGroups = [
            ['group_name' => 'Post', 'permissions' => ['create post', 'view post', 'update post', 'delete post']],
            ['group_name' => 'Project', 'permissions' => ['create project', 'view project', 'update project', 'delete project']],
            ['group_name' => 'User', 'permissions' => ['create user', 'view user', 'update user', 'delete user']],

            // add permission as needed same format

        ];
        foreach ($permissionsGroups as $group) {
            $group_name = $group['group_name'];
            $permissions = $group['permissions'];

            foreach ($permissions as $permission) {
                // Add individual permissions within the group
                $permissionNames[] = ['guard_name' => 'web', 'name' => $permission, 'group_name' => $group_name, 'created_at' => now(), 'updated_at' => now()];
            }
        }

        Permission::insert($permissionNames);

        // Admin role gets all permissions
        $adminPermissions = Permission::whereIn('group_name', ['Post', 'Project', 'User'])->pluck('name')->toArray();
        $admin = Role::create(['name' => 'admin'])->givePermissionTo($adminPermissions);

        // Staff role gets specific group permissions
        $staffPermissions = Permission::whereIn('group_name', ['Post','Project'])->pluck('name')->toArray();
        $staff = Role::create(['name' => 'staff'])->givePermissionTo($staffPermissions);

        $adminAccount =  User::firstOrCreate([
            'name' => 'Admin test',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $adminAccount->assignRole($admin);

        $staffAccount =  User::firstOrCreate([
            'name' => 'Staff test',
            'email' => 'staff@gmail.com',
            'password' => bcrypt('password'),
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $staffAccount->assignRole($staff);
    }
}
