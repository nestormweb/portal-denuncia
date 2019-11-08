<?php

namespace App;
use App\Personas;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    
    protected $fillable = ['cedula','nombre','apellido','telefono','calle','numerocasa'];

}
