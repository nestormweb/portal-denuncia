<?php

namespace App;
use App\Departamentos;
use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model

{     public $table = "departamento";

    protected $fillable = ['nombre','dpto'];

}
