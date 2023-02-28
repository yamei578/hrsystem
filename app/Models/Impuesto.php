<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impuesto extends Model
{
    use HasFactory;

    protected $fillable = 
    ['fraccion_basica',
     'exceso_hasta',
     'impuesto_fraccion_basica',
     'impuesto_fraccion_excedente',
    ];
}
