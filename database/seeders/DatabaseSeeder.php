<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $roles = [
            ['id'=> 1, 'name' => 'admin', 'guard_name' => 'web'],
            ['id'=> 2,'name' => 'user', 'guard_name' => 'web'],
        ];

        foreach ($roles as $role) {
            \Spatie\Permission\Models\Role::create($role);
        }

        $permissions = [
            ['name' => 'edit-user', 'guard_name' => 'web'],
            ['name' => 'view-user', 'guard_name' => 'web'],
            ['name' => 'edit-status-user', 'guard_name' => 'web'],
            ['name' => 'create-employee', 'guard_name' => 'web'],
            ['name' => 'edit-employee', 'guard_name' => 'web'],
            ['name' => 'edit-status-employee', 'guard_name' => 'web'],
            ['name' => 'view-employee', 'guard_name' => 'web'],
            ['name' => 'edit-attendance', 'guard_name' => 'web'],
            ['name' => 'view-attendance', 'guard_name' => 'web'],
            ['name' => 'clock-in', 'guard_name' => 'web'],
            ['name' => 'clock-out', 'guard_name' => 'web'],
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create($permission);
        }

        // append all permission to admin role
        $admin = \Spatie\Permission\Models\Role::find(1);
        $admin->givePermissionTo(\Spatie\Permission\Models\Permission::all());

        $user = \Spatie\Permission\Models\Role::find(2);
        $user->givePermissionTo([
            'view-attendance',
            'clock-in',
            'clock-out',
            'edit-attendance'
        ]);

        $adminuser = User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@mail.com',
        ]);

        $adminuser->assignRole('admin');

        Employee::create([
            'user_id' => $adminuser->id,
            'date_of_birth' => '1990-01-01',
            'city' => 'Jakarta',
            'status' => 'active',
        ]);

        $this->call([
            EmployeeSeeder::class,
        ]);
    }
}
