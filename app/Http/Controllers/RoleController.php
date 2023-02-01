<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    //
    public function index(){
        $roles = Role::all();
        return view('admin.roles.index',['roles'=>$roles]);
    }



    public function edit(Role $role){

        return view('admin.roles.edit',
        ['role'=>$role,
        'permissions'=> Permission::all()
    
    
        ]);

    }


    public function update(Role $role){

       $role->name = Str::ucfirst(request('name'));
       $role->slug = Str::of(request('name'))->slug('-');

       if($role->isDirty('name')){
        // si tenemos algo que hacer update
        session()->flash('role-updated', 'Rol actualizado: '. request('name'));
        $role->save();
       } else {
        session()->flash('role-updated', 'Nada se ha actualizado');
        
       }


       return back();


    }

    public function destroy(Role $role){

        $role->delete();

        session()->flash('role-deleted', 'Rol eliminado: '. $role->name);

        return back();


    }


    public function store(){

        request()->validate([
            'name'=>['required']
        ]);

        Role::create([
            'name' =>Str::ucfirst(request('name')),
            'slug' =>Str::of(Str::lower(request('name')))->slug('-')
        ]);

        
 
        return back();
     }
}
