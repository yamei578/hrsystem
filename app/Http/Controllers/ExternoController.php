<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Department;
use App\Models\Externo;
use App\Models\Employee;
class ExternoController extends Controller
{
    //
    public function index(){
       
        //  return view ('hhrr.vacantes.externos');
        $jobs = Job::all();
        $departments = Department::all();
        $externos = Externo::all();
  
          return view('hhrr.vacantes.externos',
          [
          'jobs'=>$jobs,
          'externos'=>$externos,
          'departments'=>$departments
          ]);
      }
  
      public function storeExternos(){
        $jobs = Job::all();
        $departments = Department::all();

       /* request()->validate([
            'cedula'=>['digits:10']
        ]);*/
              
         Externo::create([
          'nombre' => request('nombre'),
          'cedula' => request('cedula'),
          'avatar'=>request('avatar')->store('images'),
          'fecha_nacimiento' => request('fecha_nacimiento'),
          'numero' => request('numero'),
          'email_personal' => request('email_personal'),
          'department_id' => request('department_id'),
          'job_id' => request('job_id'),
          'direccion' => request('direccion'),
          'idiomas' => request('idiomas'),
          'habilidades' => request('habilidades'),
          'experiencia_laboral' => request('experiencia_laboral'),
          'educacion' => request('educacion'),
          'certificaciones_cursos' => request('certificaciones_cursos'),
          'referencias_personales' => request('referencias_personales')
           
          ]);
      
        
          session()->flash('vacante-externo-enviado', 'Gracias. Estaremos revisando tu aplicación y te contactaremos en unos días. Tu formulario se ha enviado.');
  
          return back();
      }

      public function actualizarStatus(Externo $externo){
       
        $externo->proceso_status = request('proceso_status');
  
         session()->flash('vacante-status', 'Se actualizó el status del proceso de reclutamiento.');
         $externo->save();
    

        return back();
      }

      public function edit(Externo $externo){
       
        $jobs = Job::all();
        $departments = Department::all();
    
        return view('hhrr.vacantes.editexternos',
        ['externo'=>$externo,
        'jobs'=>$jobs,
        'departments'=>$departments
      
        ]);
    
    }

    public function destroy(Externo $externo){

        $externo->delete();
    
        session()->flash('externo-eliminado', 'Vacante externa eliminada: '. $externo->nombre);
    
        return back();
    
    
    }

    public function storeExternosToEmployees(Externo $externo){
      //agregar externo a Empresa->Colaboradores
      $jobs = Job::all();
      $departments = Department::all();
      
            
       Employee::create([
        'nombre' => request('nombre'),
        'employee_number' => request('cedula'),
        'fecha_nacimiento' => request('fecha_nacimiento'),
        'numero' => request('numero'),
        'email_personal' => request('email_personal'),
        'department_id' => request('department_id'),
        'job_id' => request('job_id'),
        'direccion' => request('direccion'),
        'idiomas' => request('idiomas'),
        'habilidades' => request('habilidades'),
        'experiencia_laboral' => request('experiencia_laboral'),
        'educacion' => request('educacion'),
        'certificaciones_cursos' => request('certificaciones_cursos'),
        'referencias_personales' => request('referencias_personales')
         
        ]);

        $externo->delete();
    
        return redirect('/hhrr/vacantes/externos');
       // session()->flash('vacante-externa-agregada', 'Se ha agregado a la vacante al módulo de Empresa->Colaboradores. Será necesario completar los datos faltantes del colaborador desde ese módulo.');

        
    }


}
