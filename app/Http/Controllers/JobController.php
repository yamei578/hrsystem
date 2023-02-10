<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Job;
use App\Models\Department;

class JobController extends Controller
{
    //
    public function index(){
 
        $jobs = Job::all();
        $departments = Department::all();
        return view('hhrr.puestostrabajo.index',
        ['jobs'=>$jobs,
        'departments'=>$departments
    
        ]);
    }

    public function edit(Job $job){
        $departments = Department::all();
        return view('hhrr.puestostrabajo.edit',
        ['job'=>$job,
        'departments'=>$departments

        ]);

    }

    public function store(){


        request()->validate([
            'name'=>['required']
        ]);

        Job::create([
            'name' =>Str::ucfirst(request('name')),
            'slug' =>Str::of(Str::lower(request('name')))->slug('-')
            
        ]);

        session()->flash('job-added', 'Puesto de trabajo agregado: '. request('name') . '. Porfavor asignarle un departamento al nuevo puesto de trabajo.');
 
        return back();
     }

     public function attach(Job $job){
        $job->departments()->attach(request('department'));
        session()->flash('job-department', 'Se asignó al departamento');
        return back();
    }

    public function detach(Job $job){
        $job->departments()->detach(request('department'));
        session()->flash('job-sindepartment', 'Se quitó del departamento');
        return back();
    }

     public function update(Job $job){

        $job->name = Str::ucfirst(request('name'));
        $job->slug = Str::of(request('name'))->slug('-');
 
        if($job->isDirty('name') || $job->isDirty('department_id')){
         // si tenemos algo que hacer update
         session()->flash('job-updated', 'Puesto de trabajo actualizado: '. request('name'));
         $job->save();
        } else {
         session()->flash('job-updated', 'Nada por cambiar');
         
        }
 
 
        return back();
 
 
     }

    public function destroy(Job $job){

        $job->delete();

        session()->flash('job-deleted', 'Puesto de trabajo eliminado: '. $job->name);

        return back();


    }


}
