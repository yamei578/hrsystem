<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'cedula',
        'employee_number',
        'numero',
        'avatar',
        'email_personal',
        'email_empresa',
        'direccion',
        'salario',
        'cuenta_bancaria',
        'department_id',
        'job_id',
        'notas',
        'fecha_nacimiento',
        'fecha_ingreso',
        'idiomas',
        'habilidades',
        'experiencia_laboral',
        'educacion',
        'certificaciones_cursos',
        'estatura',
        'peso',
        'status',
        'grupo_sanguineo',
        'contacto_emergencia',
        'telefono_emergencia',
        'alergias',
        'intolerancias',
        'vacunas',
        'antecedentes_familiares',
        'enfermedades_dolencias',
        'cirugias_transplantes',
        'medicamentos',
        'necesidades_especiales',
        'medico_contacto',
        'notas_medicas',
        'user_id'
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function job(){
        return $this->belongsTo(Job::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getAvatarAttribute($value)
    {
        if (strpos($value, 'https://') !== false || strpos($value, 'http://') !== false) {
            return $value;
        }
 
        return asset('storage/' . $value);
    }


}
