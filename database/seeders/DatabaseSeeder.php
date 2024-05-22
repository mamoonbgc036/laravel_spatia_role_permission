<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = \App\Models\User::factory()->create([
            'name' => 'mamoon',
            'email' => 'mamoon@test.com',
            'password' => 'mamoon'
        ]);

        $permissons = [
            ['name' => 'user list'],
            ['name' => 'user edit'],
            ['name' => 'user create'],
            ['name' => 'user update'],
            ['name' => 'user delete'],
            ['name' => 'role list'],
            ['name' => 'role edit'],
            ['name' => 'role create'],
            ['name' => 'role delet'],
            ['name' => 'role update'],
            ['name' => 'product list'],
            ['name' => 'product edit'],
            ['name' => 'product create'],
            ['name' => 'product update'],
            ['name' => 'product delete'],
        ];

        foreach ($permissons as $permisson) {
            Permission::create($permisson);
        }

        $role = Role::create(['name' => 'admin']);


        $role->syncPermissions(Permission::all());

        // $user = User::first();
        $user->assignRole($role);
    }
}
