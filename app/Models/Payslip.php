<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    use HasFactory;

    protected $fillable = 
    ['user_id', 
    'nombre',
    'fecha_desde',
    'fecha_hasta',
    'mes_anio',
    'sueldo_nominal',
    'sueldo_ganado',
    'dias_laborados',
    'horas_suplementarias',
    'horas_extras',
    'total_horas_extras',
    'valor_horas_extras',
    'comision',
    'total_ingresos',
    'aporte_iess',
    'prestamos_quirografarios',
    'anticipos_prestamos',
    'total_descuentos',
    'liquido_pagar'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
     }
 

    
}
