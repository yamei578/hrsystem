<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Department;
use App\Models\Job;
use App\Models\Externo;

use Illuminate\Http\Request;

class VacantesController extends Controller
{
    //

    public function storeVacanteInterno(){
        $user = Auth::user();
        $user->vacantesinternos()->create(
            [
                'user_id'=>$user->id,
                'department_id'=>request('department_id'),
                'job_id'=>request('job_id'),
                'status'=>request('status'),
                'explicacion'=>request('explicacion')
            ]


        );

        request()->validate([
            'department_id'=>['required'],
            'job_id'=>['required'],
            'explicacion'=>['required']
        ]);
        session()->flash('vacante-creado', 'Tu aviso se ha enviado.');
        return back();
    }

    public function storeVacanteExterno(){
        request()->validate([
            'nombre'=>['required'],
            'cedula'=>['required'],
            'fecha_nacimiento'=>['required'],
            'numero'=>['required'],
            'email_personal'=>['required'],
            'direccion'=>['required'],
            'job_id'=>['required'],
            'idiomas'=>['required'],
            'habilidades'=>['required'],
            'experiencia_laboral'=>['required'],
            'educacion'=>['required'],
            'certificaciones_cursos'=>['required'],
            'referencias_personales'=>['required']

        ]);

        Externo::create([
            'nombre'=>request('nombre'),
            'cedula'=>request('cedula'),
            'fecha_nacimiento'=>request('fecha_nacimiento'),
            'numero'=>request('numero'),
            'email_personal'=>request('email_personal'),
            'direccion'=>request('direccion'),
            'job_id'=>request('job_id'),
            'idiomas'=>request('idiomas'),
            'habilidades'=>request('habilidades'),
            'experiencia_laboral'=>request('experiencia_laboral'),
            'educacion'=>request('educacion'),
            'certificaciones_cursos'=>request('certificaciones_cursos'),
            'referencias_personales'=>request('referencias_personales')
        ]);

        session()->flash('externo-enviado', 'Tu solicitud se ha enviado.');
 
        return back();
    }

  

}
