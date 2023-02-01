<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigSol extends Model
{
    use HasFactory;
    protected $fillable = 
    ['name',
    'codigo',
    ];


    public function solicitud(){
        return $this->belongsTo('App\Models\Sols');
    }

}
