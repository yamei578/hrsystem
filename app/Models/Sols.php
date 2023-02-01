<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sols extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'solicitud_id',
        'fecha_desde',
        'fecha_hasta',
        'status',
        'explicacion',
        'fecha_solicitud',
        'monto',
        'onlyrrhh',
        'cuotas'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function solicitud(){
        return $this->belongsTo('App\Models\ConfigSol');
    }

}
