<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreatePostulanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postulante', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ci');
            $table->string('nombre');
            $table->string('apellido')->nullable();
            $table->string('sexo')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->date('fecha_nac')->nullable();
            $table->string('telefono');
            $table->string('vivienda')->nullable();
            $table->string('profesion')->nullable();
            $table->string('lugar_trabajo');
            $table->integer('nflia');
            $table->integer('napte')->nullable();
            $table->integer('ingresof');
            $table->string('lugar_vivienda')->nullable();
            $table->integer('monto_apagar')->nullable();
            //$table->string('email')->unique();
           // $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postulante');
    }
}
