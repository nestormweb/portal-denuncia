<?php

namespace App;

use App\Denuncia;

use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    public $table = "denuncia";

    protected $fillable = ['denu','municipio','otrasituacion','comunidad','departamento','infraccion','persona_id'];

}
