<?php

namespace App\Http\Controllers;

use App\Models\Role;
Use App\Models\User;
use App\Models\Job;
use App\Models\Department;
use App\Models\Employee;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //

   /* public function show(User $user){
        return view('admin.users.profile',['user'=>$user]);
    }*/

    public function index(){
        $employees = Employee::all();
        $users = User::all();
        return view('admin.users.index',
        ['users'=>$users,
        'roles'=>Role::all()
        ]);
    }

    public function show(User $user){
       // return view('admin.users.profile', ['user'=>$user]);
       $employees = Employee::all();
       $jobs = Job::all();
       $departamentos = Department::all();
       return view('admin.users.profile', 
       ['user'=>$user,
        'roles'=>Role::all(),
        'departamentos'=>$departamentos,
        'jobs'=>$jobs
        ]);


    }



    public function update(User $user){

    
        try{
            
        if(request('avatar')){
            $inputs['avatar'] = request('avatar')->store('images');
        }

        $user->username = Str::ucfirst(request('username'));
        $user->employee_number = request('employee_number');
        $user->name = request('name');
        $user->email = request('email');
        $user->department_id = request('department_id');
        $user->job_id = request('job_id');
        $user->salario = request('salario');
        $user->fecha_ingreso = request('fecha_ingreso');

        

        if($user->isDirty('username') || $user->isDirty('employee_number') || $user->isDirty('name') 
        || $user->isDirty('email') || $user->isDirty('department_id') || $user->isDirty('job_id') || $user->isDirty('salario') || $user->isDirty('fecha_ingreso')){

            request()->validate([
                'username' => ['required', 'string', 'max:255', 'alpha_dash'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'employee_number' => ['required']
            ]);

            $user->update();
            session()->flash('user-updated', 'Usuario actualizado.');
        }

        else {
           
            session()->flash('user-updated', 'Nada ha sido actualizado.');
        }

        return back();
        }
        catch(\Exception $e){
            return back()->with('mensajeError','Nada ha sido actualizado. Revisar datos y que no haya información repetida con otros usuarios.');
        }

      
    }

    public function attach(User $user){
        $user->roles()->attach(request('role'));
        session()->flash('role-attached', 'Se asignó el rol.');


        return back();
    }

    public function detach(User $user){
        $user->roles()->detach(request('role'));
        session()->flash('role-detached', 'Se quitó el rol.');
        return back();
    }


 


    /*public function destroy(User $user){

        $user->delete();

        session()->flash('user-deleted', 'Usuario se ha eliminado.');

        return back();


    }*/

    public function inactivar($id){
        //inactivar vacante
          $user = User::find($id);
          $user->status=1;
          $user->save();
  
          session()->flash('user-deleted', 'Usuario ' . $user->name . ' se ha inactivado.');
  
          return redirect()->back();
       }

       public function activar($id){
        //activar vacante
 
        $user = User::find($id);
        $user->status=0;
        $user->save();

        session()->flash('user-active', 'Usuario ' . $user->name . ' se ha activado.');

         return redirect()->back();
 
      }



    

    public function create(){
        $departamentos = Department::all();
        $jobs = Job::all();
        $hashed_random_password = (Str::random(8));
     return view('admin.users.create',
     ['departamentos'=>$departamentos,
     'jobs'=>$jobs,
     'hashed_random_password'=>$hashed_random_password
    
    ]);

     /* $roles = Role::all();
     

      return view('admin.users.create',
      ['roles'=>$roles,
    
      ]);*/
  
     }

    

     public function new(Request $request)
    {

        $departamentos = Department::all();
        $jobs = Job::all();

       
    request()->validate([
        'username' => ['required', 'string', 'max:255','unique:users', 'alpha_dash'],
        'password'=>['min:8','max:255'],
        'password_confirmation'=>['required','max:255','same:password'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'employee_number' => ['required', 'unique:users']
    ]);
        
     
       User::create([
           'username' => request('username'),
          'name' => request('name'),
         'employee_number' => request('employee_number'),
           'email' => request('email'),
          'password' => request('password'),
          'department_id' => request('department_id'),
          'job_id' => request('job_id'),
          'salario'=> request('salario'),
          'fecha_ingreso'=> request('fecha_ingreso')
            //'password' => Hash::make($data['password']),
         
        ]);


      
        session()->flash('user-added', 'Usuario nuevo agregado.');

        return back();
    }

   

    public function indexPassword(User $user){
        return view('admin.users.password',[
            'user'=>$user
        ]);
    }

    public function updatePassword(User $user){
        $inputs = request()->validate([

    
            'password'=>['min:8','max:255'],
            'password_confirmation'=>['required','max:255','same:password'],
          

        ]);


        $user->update($inputs);

        session()->flash('password-updated', 'Contraseña actualizada.');

        return back();
    }


}
