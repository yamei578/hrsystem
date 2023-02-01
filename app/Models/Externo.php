<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Externo extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'cedula',
        'fecha_nacimiento',
        'numero',
        'email_personal',
        'direccion',
        'department_id',
        'job_id',
        'avatar',
        'idiomas',
        'habilidades',
        'experiencia_laboral',
        'educacion',
        'certificaciones_cursos',
        'referencias_personales'
    ];

    public function job(){
        return $this->belongsTo(Job::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function getAvatarAttribute($value)
    {
        if (strpos($value, 'https://') !== false || strpos($value, 'http://') !== false) {
            return $value;
        }
 
        return asset('storage/' . $value);
    }

}
