<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
Use App\Models\User;
Use App\Models\Externo;
Use App\Models\Vacante;
Use App\Models\Job;
Use App\Models\Role;
Use App\Models\Payslip;
Use App\Models\Sols;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //mostrar count the users registered para admin dashboard
        $aplica = false;
        $meses = 12;
       $users = User::all()->count();
       $departments = Department::all()->count();
       $employees = Employee::all()->count();
       $jobs = Job::all()->count();
       $vacantesExternas = Externo::all()->count();
       $roles = Role::all()->count();
       $solicitudes = Sols::where('statusrrhh', '=', '0')->count();

       $userSalary = Auth::user()->salario; 

       $salarioAnual = $meses * $userSalary;

       if ($salarioAnual >= 11000){
            $aplica = true;
       }

      
       $user = Auth::user()->marcaciones;
       $id = Auth::id(); 

       $userEarnings = Payslip::selectRaw('SUM(liquido_pagar) as liquido_pagar')->where('user_id', '=', $id)->get();
       $userRequests = Sols::where('user_id', '=', $id)->where('statusrrhh', '=', '0')->count();

       $vacantesDisponibles = Vacante::where('status', '=', '1')->count();
     
       $datetime = Carbon::now()->toDateTimeString();
       $cur_date = Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->isoFormat('YYYY-MM-DD'); 
       $horasLaborales = null;
       $horasAlmuerzo = null;
       $entradaAlmuerzo = 3;
       $salidaAlmuerzo = 4;
       $entrada = 1;
       $salida = 2;
       $entradaFeriadoFds = 5;
       $salidaFeriadoFds = 6;
       $entradaFecha = null;
       $salidaFecha = null;
       $entradaAlmuerzoFecha = null;
       $salidaAlmuerzoFecha = null;
       $entradaFeriadoFecha = null;
       $salidaFeriadoFecha = null;
       $totalDuracionFeriado = null;
       $totalDuracionLaboral = null;
       $totalDuracionAlmuerzo = null;
       $text = '<p class="text-danger"><strong>---</strong></p>';
       

       foreach($user as $user_marcaciones){

               $entradaFecha = $user_marcaciones->where('marcacion_id','=',$entrada)->where('user_id','=',$user_marcaciones->user_id)->whereDate('fecha_hora_marcacion', '=', $cur_date)->latest('fecha_hora_marcacion')->first(); 
               $salidaFecha = $user_marcaciones->where('marcacion_id','=',$salida)->where('user_id','=',$user_marcaciones->user_id)->whereDate('fecha_hora_marcacion', '=', $cur_date)->latest('fecha_hora_marcacion')->first();
               $entradaAlmuerzoFecha = $user_marcaciones->where('marcacion_id','=',$entradaAlmuerzo)->where('user_id','=',$user_marcaciones->user_id)->whereDate('fecha_hora_marcacion', '=', $cur_date)->latest('fecha_hora_marcacion')->first();
               $salidaAlmuerzoFecha = $user_marcaciones->where('marcacion_id','=',$salidaAlmuerzo)->where('user_id','=',$user_marcaciones->user_id)->whereDate('fecha_hora_marcacion', '=', $cur_date)->latest('fecha_hora_marcacion')->first();
               $entradaFeriadoFecha = $user_marcaciones->where('marcacion_id','=',$entradaFeriadoFds)->where('user_id','=',$user_marcaciones->user_id)->whereDate('fecha_hora_marcacion', '=', $cur_date)->latest('fecha_hora_marcacion')->first();
               $salidaFeriadoFecha = $user_marcaciones->where('marcacion_id','=',$salidaFeriadoFds)->where('user_id','=',$user_marcaciones->user_id)->whereDate('fecha_hora_marcacion', '=', $cur_date)->latest('fecha_hora_marcacion')->first();


          
           if($entradaFecha != null && $salidaFecha!= null){
               $tiempoEntrada = Carbon::parse($entradaFecha->fecha_hora_marcacion);
               $tiempoSalida = Carbon::parse($salidaFecha->fecha_hora_marcacion);
   
               $totalDuracionLaboral = $tiempoSalida->diff($tiempoEntrada)->format('%H:%i:%s');
           
           }
               
          
          
           if($entradaAlmuerzoFecha != null && $salidaAlmuerzoFecha !=null){
                 //para almuerzo
           $tiempoEntradaAlmuerzo = Carbon::parse($entradaAlmuerzoFecha->fecha_hora_marcacion);
           $tiempoSalidaAlmuerzo = Carbon::parse($salidaAlmuerzoFecha->fecha_hora_marcacion);

           $totalDuracionAlmuerzo = $tiempoSalidaAlmuerzo->diff($tiempoEntradaAlmuerzo)->format('%H:%i:%s');
           }

           if($entradaFeriadoFecha != null && $salidaFeriadoFecha !=null){
            //para feriados
            $tiempoEntradaFeriado = Carbon::parse($entradaFeriadoFecha->fecha_hora_marcacion);
            $tiempoSalidaFeriado = Carbon::parse($salidaFeriadoFecha->fecha_hora_marcacion);

            $totalDuracionFeriado = $tiempoSalidaFeriado->diff($tiempoEntradaFeriado)->format('%H:%i:%s');

          if($totalDuracionFeriado){
              $salidaFeriadoFecha->horas_trabajadas = $totalDuracionFeriado;
              $salidaFeriadoFecha->save();
          }

      }

         
       
       }
       
        return view('admin.index',
        ['users'=>$users],
        ['departments'=>$departments,
        'jobs'=>$jobs,
        'employees'=>$employees,
        'vacantesExternas'=>$vacantesExternas,
        'entradaAlmuerzo'=>$entradaAlmuerzo,
        'salidaAlmuerzo'=>$salidaAlmuerzo,
        'entrada'=>$entrada,
        'salida'=>$salida,
        'user'=>$user,
        'roles'=>$roles,
        'solicitudes'=>$solicitudes,
        'cur_date'=>$cur_date,
        'entradaFecha'=>$entradaFecha,
        'salidaFecha'=>$salidaFecha,
        'entradaAlmuerzoFecha'=>$entradaAlmuerzoFecha,
        'salidaAlmuerzoFecha'=>$salidaAlmuerzoFecha,
        'text'=>$text,
        'totalDuracionLaboral'=>$totalDuracionLaboral,
        'totalDuracionAlmuerzo'=>$totalDuracionAlmuerzo,
        'totalDuracionFeriado'=>$totalDuracionFeriado,
        'entradaFeriadoFecha'=>$entradaFeriadoFecha,
        'salidaFeriadoFecha'=>$salidaFeriadoFecha,
        'userEarnings'=>$userEarnings,
        'userRequests'=>$userRequests,
        'vacantesDisponibles'=>$vacantesDisponibles,
        'aplica'=>$aplica

    
        ],
       
      
    
        );


    }


    
}
