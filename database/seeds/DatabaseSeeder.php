<?php

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

         //dd(infraccionSeeders::class);
        // $this->call(UsersTableSeeder::class);
        $this->call(infraccionSeeder::class);
        $this->call(DepartamentosSeeder::class);

    }
}
