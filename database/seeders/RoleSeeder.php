<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            ['role_name' => 'Super Admin'],
            ['role_name' => 'Admin'],
            ['role_name' => 'Sub Admin'],
        ]);

        //RoleFactory, DatabaseSeeder theke call kora jai abar RoleSeeder theke o call kora jai
        //Role::factory()->count(10)->create();
    }
}
