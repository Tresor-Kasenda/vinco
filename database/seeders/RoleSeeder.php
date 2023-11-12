<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'parent',
            'teacher',
            'student',
            'admin'
        ];

        collect($roles)->each(fn($role) => Role::create(['name' => $role, 'guard_name' => 'web']));
    }
}
