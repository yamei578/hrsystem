<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    //
    public function index(){

        $departments = Department::all();
        $users = User::all();
        return view('hhrr.departamentos.index',
        ['departments'=>$departments,
        'users'=>$users,
        ]);

      

        //return view('hhrr.departamentos.index');
    }

    public function edit(Department $department){

        $users = User::all();
        return view('hhrr.departamentos.edit',
        ['department'=>$department,
        'users'=>$users,

        ]);

    }

    public function store(){
        request()->validate([
            'name'=>['required'],
            'user_id'=>['required'],
        ]);

        Department::create([
            'name' =>Str::ucfirst(request('name')),
            'user_id'=>request('user_id'),
            'slug' =>Str::of(Str::lower(request('name')))->slug('-')
        ]);

        session()->flash('department-added', 'Departamento agregado: '. request('name'));
 
        return back();
    }

    public function update(Department $department){

        $department->name = Str::ucfirst(request('name'));
        $department->user_id = request('user_id');
        $department->slug = Str::of(request('name'))->slug('-');
 
        if($department->isDirty('name') || $department->isDirty('user_id')){
         // si tenemos algo que hacer update
         session()->flash('department-updated', 'Departamento actualizado: '. request('name'));
         $department->save();
        } else {
         session()->flash('department-updated', 'Nada por cambiar');
         
        }
 
 
        return back();
 
 
     }

    public function destroy(Department $department){

        $department->delete();

        session()->flash('department-deleted', 'Departamento eliminado: '. $department->name);

        return back();


    }

  
}
