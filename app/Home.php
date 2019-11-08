<?php

namespace App;
use App\Home;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $fillable = ['cedula','nombre','apellido','telefono','calle','numerocasa'];
}
