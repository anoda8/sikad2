<?php

namespace Database\Seeders;

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
        // $this->call(LaratrustSeeder::class);
        // $this->call(ThAjaranSeeder::class);
        // $this->call(UserRoleSeeder::class);
        // $this->call(GuruSeeder::class);
        $this->call(SiswaSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
