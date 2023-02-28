<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTax extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'anio',
        'sueldo_anual',
        'total_ingresos',
        'alimentacion',
        'vivienda',
        'recreacion',
        'vestimenta',
        'salud',
        'total_deduccion_personales',
        'deduccion_iess',
        'otros_gastos',
        'total_deducciones',
        'base_imponible',
        'impuesto_por_pagar'

    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
