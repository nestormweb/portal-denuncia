<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Infraccion;


class infraccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('infraccion')->insert([
            'infracciones'  => 'Vivienda deshabitada',
        ]);

        DB::table('infraccion')->insert([
            'infracciones'  => 'Arrendada o cedida a terceros',
        ]);

        DB::table('infraccion')->insert([
            'infracciones'  => 'Vivienda con uso diferente al habitacional',
        ]);

        DB::table('infraccion')->insert([
            'infracciones'  => 'Vivienda habitada ocasionalmente',
        ]);

        DB::table('infraccion')->insert([
            'infracciones'  => 'Otra situación',
        ]);
    }
}
