<?php

namespace App;
use App\Infaccion;
use Illuminate\Database\Eloquent\Model;

class Infraccion extends Model
{
    public $table = "infraccion";
    protected $fillable = ['infracciones','infrac'];

}
