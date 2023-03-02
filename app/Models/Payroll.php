<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;
    protected $fillable = 
    ['iess', 
    'horas_extras',
    'horas_feriados',
    'fondo_reserva',
    'aporte_patronal'
    ];
}
