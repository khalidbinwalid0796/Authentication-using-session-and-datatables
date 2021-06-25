<?php

namespace Database\Seeders;

use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    /*  using faker
        RoleFactory.php te user ar field ar data define kora ase sudhu aikhan theke call korle ee hobe
        10 ta fake data insert hobe \App\Models\Role::factory(10)->create() ar maddhome
        
    */  
        // \App\Models\User::factory(10)->create();
        // \App\Models\Role::factory(10)->create();
        //$this->call(RoleSeeder::class);
        //$this->call(LocationSeeder::class);
        $this->call([
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
