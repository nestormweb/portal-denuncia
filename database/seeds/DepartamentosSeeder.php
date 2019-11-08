<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Departamento;
class DepartamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('departamento')->insert([
            'nombre'  => 'Concepción',
        ]);
        DB::table('departamento')->insert([
            'nombre'  => 'San Pedro',
        ]);
        DB::table('departamento')->insert([
            'nombre'  => 'Cordillera',
        ]);
        DB::table('departamento')->insert([
            'nombre'  => 'Guairá',
        ]);
        DB::table('departamento')->insert([
            'nombre'  => 'Caaguazú',
        ]);
        DB::table('departamento')->insert([
            'nombre'  => 'Caazapá',
        ]);
        DB::table('departamento')->insert([
            'nombre'  => 'Itapúa',
        ]);
        DB::table('departamento')->insert([
            'nombre'  => 'Misiones',
        ]);
        DB::table('departamento')->insert([
            'nombre'  => 'Paraguarí',
        ]);
        DB::table('departamento')->insert([
            'nombre'  => 'Alto Paraná',
        ]);
        DB::table('departamento')->insert([
            'nombre'  => 'Central',
        ]);
        DB::table('departamento')->insert([
            'nombre'  => 'Ñeembucú',
        ]);
        DB::table('departamento')->insert([
            'nombre'  => 'Amambay',
        ]);
        DB::table('departamento')->insert([
            'nombre'  => 'Canindeyú',
        ]);
        DB::table('departamento')->insert([
            'nombre'  => 'Presidente Hayes',
        ]);
        DB::table('departamento')->insert([
            'nombre'  => 'Boquerón',
        ]);
        DB::table('departamento')->insert([
            'nombre'  => 'Alto Paraguay',
        ]);
    }
}
