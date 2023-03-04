<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Externo;
use App\Models\User;
use App\Models\Job;
use App\Models\Vacante;
use App\Models\Payslip;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use DB;

class HhrrColaboradoresController extends Controller
{


    
    public function index(){
       // return view('hhrr.colaboradores.index');

       /* $employees = Employee::all();
        $departamentos = Department::all();
        
        return view('hhrr.colaboradores.index',
        ['employees'=>$employees],
        ['departamentos'=>$departamentos],
    );*/


   // $jobs = Job::all();
    $employees = Employee::all();
    $departamentos = Department::all();
    $jobs = Job::all();
        return view('hhrr.colaboradores.index',
        ['employees'=>$employees,
        'departamentos'=>$departamentos,
        'jobs'=>$jobs
        ]);

    }

    public function inactivarColaborador($id){
        //inactivar colaborador -> 1 

          $employee = Employee::find($id);
          $employee->status=1;
          $employee->save();
  
  
          return redirect()->back();
       }

       public function activarColaborador($id){
        //activar colaborador -> 0
 
        $employee = Employee::find($id);
        $employee->status=0;
        $employee->save();
         return redirect()->back();
 
      }


    public function edit(Employee $employee){

        $departamentos = Department::all();
        $payslips = Payslip::all();
        $jobs = Job::all();
        $user_id = $employee->user_id;
        $users = User::all();
        $query = DB::table('payslips')->select('mes_anio','liquido_pagar','fecha_desde','fecha_hasta','payslips.id as id')->join('users','payslips.user_id','=','users.id')->where('user_id','=',$user_id)->get(); //ESTE

        foreach($query as $queries){
            $mes_anio = $queries->mes_anio;
            $liquido_pagar = $queries->liquido_pagar;
            $fecha_desde = $queries->fecha_desde;
            $fecha_hasta = $queries->fecha_hasta;
            $payslip= $queries->id;
        }

        return view('hhrr.colaboradores.edit',
        ['employee'=>$employee,
        'departamentos'=>$departamentos,
        'jobs'=>$jobs,
        'users'=>$users,
        'payslips'=>$payslips,
        'user_id'=>$user_id,
        'query'=>$query

        ]);

    }

    public function vacantesInternosIndex(){
        //devuelve vista del sidebar para HHRR vacantes internos
       // return view('hhrr.vacantes.internos');

        $vacancy = User::with('vacantes')->get();
       
        foreach($vacancy as $interna){
          
            foreach($interna->vacantes as $users){
               
          $users->pivot->vacante_id;
            }
            
        }
       
        return view('hhrr.vacantes.internos',
        [
        
        'vacancy'=>$vacancy
        ]);
    }

    public function vacantesExternosIndex(){
        //devuelve vista del sidebar para HHRR vacantes externos
        $jobs = Job::all();
        $externos = Externo::all();
  
          return view('hhrr.vacantes.solicitudesexternos',
          [
          'jobs'=>$jobs,
          'externos'=>$externos
          ]);
        //return view('hhrr.vacantes.solicitudesexternos');
    }

 

    public function vacantesInternosAviso(){
        //se encuentra formulario para enviar avisos a los colaboradores internos 
       // return view('hhrr.vacantes.enviaraviso');
        $departamentos = Department::all();
      
        $jobs = Job::all();
        return view('hhrr.vacantes.enviaraviso',
        [
        'departamentos'=>$departamentos,
        'jobs'=>$jobs
        ]);
    }

    public function vacantesInternosEnviados(){
        $departamentos = Department::all();
        $vacantesInternos = Vacante::all();
        $jobs = Job::all();
        return view('hhrr.vacantes.enviados',
        [
        'departamentos'=>$departamentos,
        'jobs'=>$jobs,
        'vacantesInternos'=>$vacantesInternos
        ]);
    }

    public function inactivar($id){
        //inactivar vacante
          $vacante = Vacante::find($id);
          $vacante->status=2;
          $vacante->save();
  
          
  
          return redirect()->back();
       }

       public function activar($id){
        //activar vacante
 
        $vacante = Vacante::find($id);
        $vacante->status=1;
        $vacante->save();
         return redirect()->back();
 
      }

    public function editVacante(Vacante $vacante){
        $departments = Department::all();
        $jobs = Job::all();
    
        return view('hhrr.vacantes.editenviados',
        ['vacante'=>$vacante,
        'departments'=>$departments,
        'jobs'=>$jobs
      
        ]);
    
    }

    public function vacantesInternosEnviadosActualizar(Vacante $vacante){


        $inputs = request()->validate([

           
            'department_id'=> ['required'],
            'job_id'=> ['required'],
            'explicacion'=>['required']

        ]);


        $vacante->update($inputs);

        session()->flash('vacante-actualizado', 'Se ha actualizado vacante.');

        return back();

    }

    public function create(){
        $departamentos = Department::all();
        $users = User::all();
        $jobs = Job::all();
        return view('hhrr.colaboradores.create',
        ['departamentos'=>$departamentos,
        'users'=>$users,
        'jobs'=>$jobs
        ]);
   
        /* $roles = Role::all();
        
   
         return view('admin.users.create',
         ['roles'=>$roles,
       
         ]);*/
     
        }

        public function store(){

            //crear employee nuevo
            $departamentos = Department::all();
            $jobs = Job::all();
            $users = User::all();


            request()->validate([
                'nombre'=>['required'],
                'avatar'=>['file']
            ]);

    
            Employee::create([
                'nombre' =>Str::ucfirst(request('nombre')),
                'employee_number' =>request('employee_number'),
                'numero' =>request('numero'),
                'email_personal' =>request('email_personal'),
                'email_empresa' =>request('email_empresa'),
                'direccion' =>request('direccion'),
                'salario' =>request('salario'),
                'avatar'=>request('avatar')->store('images'),
                'cuenta_bancaria' =>request('cuenta_bancaria'),
                'department_id'=>request('department_id'),
                'job_id'=>request('job_id'),
                'notas' =>request('notas'),
                'status'=> request('status'),
                'fecha_nacimiento' =>request('fecha_nacimiento'),
                'fecha_ingreso' =>request('fecha_ingreso'),
                'idiomas' =>request('idiomas'),
                'habilidades' =>request('habilidades'),
                'experiencia_laboral' =>request('experiencia_laboral'),
                'educacion' =>request('educacion'),
                'certificaciones_cursos' =>request('certificaciones_cursos'),
                'estatura' =>request('estatura'),
                'peso' =>request('peso'),
                'grupo_sanguineo' =>request('grupo_sanguineo'),
                'contacto_emergencia' =>request('contacto_emergencia'),
                'telefono_emergencia' =>request('telefono_emergencia'),
                'alergias' =>request('alergias'),
                'intolerancias' =>request('intolerancias'),
                'vacunas' =>request('vacunas'),
                'notas' =>request('notas'),
                'antecedentes_familiares' =>request('antecedentes_familiares'),
                'enfermedades_dolencias' =>request('enfermedades_dolencias'),
                'cirugias_transplantes' =>request('cirugias_transplantes'),
                'medicamentos' =>request('medicamentos'),
                'necesidades_especiales' =>request('necesidades_especiales'),
                'medico_contacto' =>request('medico_contacto'),
                'notas_medicas' =>request('notas_medicas'),
                'user_id'=>request('user_id')
                
            ]);
    
            
            session()->flash('employee-created', 'Colaborador creado.');
            return back();
         }

         public function update(Employee $employee){
          
           
            if(request('avatar')){
                $employee->avatar = request('avatar')->store('images');
            }

            //actualizar employee

            $employee->nombre = Str::ucfirst(request('nombre'));
            $employee->employee_number = request('employee_number');
            $employee->numero = request('numero');
            $employee->email_personal = request('email_personal');
            $employee->email_empresa = request('email_empresa');
            $employee->direccion = request('direccion');
            $employee->salario = request('salario');
            $employee->cuenta_bancaria = request('cuenta_bancaria');
            $employee->notas = request('notas');
            $employee->fecha_nacimiento = request('fecha_nacimiento');
           
            $employee->fecha_ingreso = request('fecha_ingreso');
            $employee->idiomas = request('idiomas');
            $employee->department_id = request('department_id');
            $employee->status = request('status');
            $employee->job_id = request('job_id');
            $employee->habilidades = request('habilidades');
            $employee->experiencia_laboral = request('experiencia_laboral');
            $employee->educacion = request('educacion');
            $employee->certificaciones_cursos = request('certificaciones_cursos');
            $employee->estatura = request('estatura');
            $employee->peso = request('peso');
            $employee->grupo_sanguineo = request('grupo_sanguineo');
            $employee->contacto_emergencia = request('contacto_emergencia');
            $employee->telefono_emergencia = request('telefono_emergencia');
            $employee->alergias = request('alergias');
            $employee->intolerancias = request('intolerancias');
            $employee->vacunas = request('vacunas');
            $employee->antecedentes_familiares = request('antecedentes_familiares');
            $employee->enfermedades_dolencias = request('enfermedades_dolencias');
            $employee->cirugias_transplantes = request('cirugias_transplantes');
            $employee->medicamentos = request('medicamentos');
            $employee->necesidades_especiales = request('necesidades_especiales');
            $employee->medico_contacto = request('medico_contacto');
            $employee->notas_medicas = request('notas_medicas');
            $employee->user_id = request('user_id');
     
            if($employee->isDirty('nombre') || $employee->isDirty('numero') || $employee->isDirty('avatar') || $employee->isDirty('email_personal') 
            || $employee->isDirty('email_empresa') || $employee->isDirty('direccion') || $employee->isDirty('salario') || $employee->isDirty('cuenta_bancaria') 
            || $employee->isDirty('notas') || $employee->isDirty('fecha_nacimiento') || $employee->isDirty('fecha_ingreso') || $employee->isDirty('idiomas') || $employee->isDirty('habilidades')
            || $employee->isDirty('experiencia_laboral') || $employee->isDirty('educacion') || $employee->isDirty('certificaciones_cursos') || $employee->isDirty('estatura') || $employee->isDirty('peso') || $employee->isDirty('grupo_sanguineo')
            || $employee->isDirty('contacto_emergencia') || $employee->isDirty('telefono_emergencia') || $employee->isDirty('alergias') || $employee->isDirty('intolerancias') || $employee->isDirty('vacunas') || $employee->isDirty('antecedentes_familiares')
            || $employee->isDirty('enfermedades_dolencias') || $employee->isDirty('cirugias_transplantes') || $employee->isDirty('medicamentos') || $employee->isDirty('necesidades_especiales') 
            || $employee->isDirty('medico_contacto') || $employee->isDirty('notas_medicas') || $employee->isDirty('department_id') || $employee->isDirty('employee_number') || $employee->isDirty('job_id') || $employee->isDirty('status') || $employee->isDirty('user_id')){

            session()->flash('employee-updated', 'Colaborador actualizado: '. request('nombre'));
             $employee->save(); 
            }
           
             // si tenemos algo que hacer update
            else {
                session()->flash('employee-updated', 'Nada ha sido actualizado.');
            }
            
            
        
     
            return back();
        }

        public function editPayslip(Payslip $payslip){
        
            return view('hhrr.colaboradores.editpayslip',[
                'payslip'=>$payslip
            ]);
         
        }

        public function updatePayslip(Payslip $payslip){
            $payslip->dias_laborados = request('dias_trabajados');
            $payslip->horas_suplementarias = request('horas_50');
            $payslip->horas_extras = request('horas_100');
            $payslip->comision = request('comision_valor');
            $payslip->prestamos_quirografarios = request('prestamos');
            $payslip->anticipos_prestamos = request('anticipos');
            $payslip->sueldo_ganado = request('sueldo_ganado');
            $payslip->total_horas_extras = request('total_horas');
            $payslip->valor_horas_extras = request('valor_horas');
            $payslip->total_ingresos = request('total_ingresos');
            $payslip->aporte_iess = request('aporte_total');
            $payslip->aporte_patronal = request('aporte_patronal');
            $payslip->total_descuentos = request('total_descuentos');
            $payslip->liquido_pagar = request('liquido_pagar');
      

            if($payslip->isDirty('dias_trabajados') || $payslip->isDirty('horas_50') || $payslip->isDirty('horas_100') || $payslip->isDirty('comision_valor') || $payslip->isDirty('prestamos') 
            || $payslip->isDirty('anticipos') || $payslip->isDirty('sueldo_ganado') || $payslip->isDirty('total_horas') || $payslip->isDirty('valor_horas') || $payslip->isDirty('total_ingresos') || $payslip->isDirty('aporte_total') ||
            $payslip->isDirty('total_descuentos') || $payslip->isDirty('liquido_pagar') || $payslip->isDirty('aporte_patronal')){

                session()->flash('payslip-updated', 'Rol de pagos actualizado.');
                $payslip->save();
            }
           
             // si tenemos algo que hacer update
            else {
                session()->flash('payslip-updated', 'Nada ha sido actualizado.');
            }
            return back();
        }


        public function destroyPayslip(Payslip $payslip){

            $payslip->delete();
    
            session()->flash('payslip-deleted', 'Rol eliminado: '. $payslip->mes_anio);
    
            return back();
    
    
        }
    
}
