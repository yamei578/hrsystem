<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{


    public function index(){
        $permissions = Permission::all();
        return view('admin.roles.permissionindex',['permissions'=>$permissions]);
    }



    public function edit(Permission $permission){

        return view('admin.roles.permissionedit',
        ['permission'=>$permission
    
    
        ]);

    }


    public function update(Permission $permission){

       $permission->name = Str::ucfirst(request('name'));
       $permission->slug = Str::of(request('name'))->slug('-');

       if($permission->isDirty('name')){
        // si tenemos algo que hacer update
        session()->flash('permission-updated', 'Permiso actualizado: '. request('name'));
        $permission->save();
       } else {
        session()->flash('permission-updated', 'Nada se ha actualizado');
        
       }


       return back();


    }

    public function destroy(Permission $permission){

        $permission->delete();

        session()->flash('permission-deleted', 'Permiso eliminado: '. $permission->name);

        return back();


    }


    public function store(){

        request()->validate([
            'name'=>['required']
        ]);

        Permission::create([
            'name' =>Str::ucfirst(request('name')),
            'slug' =>Str::of(Str::lower(request('name')))->slug('-')
        ]);

        session()->flash('permission-added', 'Permiso agregado');
 
        return back();
     }



    //
    public function attach(Role $role){
        $role->permissions()->attach(request('permission'));
        return back();
    }

    public function detach(Role $role){
        $role->permissions()->detach(request('permission'));
        return back();
    }

}
