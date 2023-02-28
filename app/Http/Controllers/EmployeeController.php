<?php

namespace App\Http\Controllers;
use App\Http\Controllers\RolPagosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ConfigMarc;
use App\Models\ConfigSol;
use App\Models\Marc;
use App\Models\User;
use App\Models\Payslip;
use App\Models\Sols;
use App\Models\Role;
use App\Models\Vacante;
use App\Models\Impuesto;
use App\Models\EmployeeTax;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Job;
use DB;
use Carbon\Carbon;
use Stevebauman\Location\Position;
use Stevebauman\Location\Drivers\Driver;



class EmployeeController extends Controller
{
    //

    public function indexMarcacionesEmployees(Request $request){

        $ip = $request->ip();
      
        $data = \Location::get($ip);
        //retorna vista de sidebar index marcaciones de rol colaboradores
        //tiempo laboral

       
         //tiempo almuerzo
      
        $tiempoAlmuerzo = DB::select('select salida.user_id as user, salida.fecha_hora_marcacion as salida, entrada.fecha_hora_marcacion as entrada,
        TIMEDIFF(salida.fecha_hora_marcacion, entrada.fecha_hora_marcacion)
        from marcs salida, marcs entrada 
        where salida.marcacion_id = 3 and entrada.marcacion_id = 2
        and salida.fecha_hora_marcacion > entrada.fecha_hora_marcacion 
        and date(salida.fecha_hora_marcacion) = date(entrada.fecha_hora_marcacion)
        and salida.user_id = entrada.user_id');


        $user = Auth::user()->marcaciones;
        $marcaciones = ConfigMarc::all();
        $marcacionesColaboradores = Marc::all();
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
        $text = '<p class="text-danger"><strong>No has marcado.</strong></p>';

        foreach($user as $user_marcaciones){

                $entradaFecha = $user_marcaciones->where('marcacion_id','=',$entrada)->where('user_id','=',$user_marcaciones->user_id)->whereDate('fecha_hora_marcacion', '=', $cur_date)->latest('fecha_hora_marcacion')->first(); 
                $salidaFecha = $user_marcaciones->where('marcacion_id','=',$salida)->where('user_id','=',$user_marcaciones->user_id)->whereDate('fecha_hora_marcacion', '=', $cur_date)->latest('fecha_hora_marcacion')->first();
                $entradaAlmuerzoFecha = $user_marcaciones->where('marcacion_id','=',$entradaAlmuerzo)->where('user_id','=',$user_marcaciones->user_id)->whereDate('fecha_hora_marcacion', '=', $cur_date)->latest('fecha_hora_marcacion')->first();
                $salidaAlmuerzoFecha = $user_marcaciones->where('marcacion_id','=',$salidaAlmuerzo)->where('user_id','=',$user_marcaciones->user_id)->whereDate('fecha_hora_marcacion', '=', $cur_date)->latest('fecha_hora_marcacion')->first();
                $entradaFeriadoFecha = $user_marcaciones->where('marcacion_id','=',$entradaFeriadoFds)->where('user_id','=',$user_marcaciones->user_id)->whereDate('fecha_hora_marcacion', '=', $cur_date)->latest('fecha_hora_marcacion')->first();
                $salidaFeriadoFecha = $user_marcaciones->where('marcacion_id','=',$salidaFeriadoFds)->where('user_id','=',$user_marcaciones->user_id)->whereDate('fecha_hora_marcacion', '=', $cur_date)->latest('fecha_hora_marcacion')->first();

    
                /*$tiempoLaboral = DB::select('select salida.user_id as user, salida.fecha_hora_marcacion as salida, entrada.fecha_hora_marcacion as entrada,
                TIMEDIFF(salida.fecha_hora_marcacion, entrada.fecha_hora_marcacion) as diff
                from marcs salida, marcs entrada 
                where salida.marcacion_id = 4 and entrada.marcacion_id = 1
                and salida.fecha_hora_marcacion > entrada.fecha_hora_marcacion 
                and date(salida.fecha_hora_marcacion) = date(entrada.fecha_hora_marcacion)
                and salida.user_id = entrada.user_id');*/

              

                //$tiempoEntrada = $entradaFecha->fecha_hora_marcacion;

           /* $tiempoEntrada = Carbon::parse($entradaFecha->fecha_hora_marcacion)->format('H:i:s');
            $tiempoSalida = Carbon::parse($salidaFecha->fecha_hora_marcacion)->format('H:i:s');*/
            //para hora laboral
           
            if($entradaFecha != null && $salidaFecha!= null){
                $tiempoEntrada = Carbon::parse($entradaFecha->fecha_hora_marcacion);
                $tiempoSalida = Carbon::parse($salidaFecha->fecha_hora_marcacion);
    
                $totalDuracionLaboral = $tiempoSalida->diff($tiempoEntrada)->format('%H:%i:%s');

                if($totalDuracionLaboral){
                    $salidaFecha->horas_trabajadas = $totalDuracionLaboral;
                   
                    $salidaFecha->save();
                }
            
            }
                
           
           
            if($entradaAlmuerzoFecha != null && $salidaAlmuerzoFecha !=null){
                  //para almuerzo
            $tiempoEntradaAlmuerzo = Carbon::parse($entradaAlmuerzoFecha->fecha_hora_marcacion);
            $tiempoSalidaAlmuerzo = Carbon::parse($salidaAlmuerzoFecha->fecha_hora_marcacion);

            $totalDuracionAlmuerzo = $tiempoSalidaAlmuerzo->diff($tiempoEntradaAlmuerzo)->format('%H:%i:%s');

                if($totalDuracionAlmuerzo){
                    $salidaAlmuerzoFecha->horas_trabajadas = $totalDuracionAlmuerzo;
                    $salidaAlmuerzoFecha->save();
                }

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
        
        
        return view('employees.marcaciones.index',
        ['marcaciones'=>$marcaciones,
        'marcacionesColaboradores'=>$user,
        'entradaAlmuerzo'=>$entradaAlmuerzo,
        'salidaAlmuerzo'=>$salidaAlmuerzo,
        'entrada'=>$entrada,
        'salida'=>$salida,
        'user'=>$user,
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
        'data'=> $data

     
        ]);

    }

    public function indexSolicitudesColaboradores(){

        $user = Auth::user()->solicitudes;
        $solicitudes = ConfigSol::all();
        $solicitudesColaboradores = Sols::all();


        return view('employees.solicitudes.index',
        ['solicitudes'=>$solicitudes,
        'solicitudesColaboradores'=>$user,
        ]);

       /* $solicitudes = ConfigSol::all();
        return view('employees.solicitudes.index',['solicitudes'=>$solicitudes]);*/
    }

    public function editSolicitud(Sols $solicitud){
      
        $sols = ConfigSol::all();

        return view('employees.solicitudes.edit',
        ['solicitud'=>$solicitud,
        'sols'=>$sols
        ]);
    }

    public function destroy(Sols $solicitud){

        $solicitud->delete();

        session()->flash('solicitud-deleted', 'Solicitud retirada');

        return back();


    }

    public function indexVacanteInterno(Vacante $vacante){
    //COLABORADOR VACANTE INTERNO DONDE SE VEN TODAS LAS VACANTES

        $vacantes = User::find(Auth::user()->id)->vacantes()->get();
        $user = Auth::user()->vacantesinternos;
        $vacantesInternos = Vacante::all();
        return view('employees.vacante.index',
        ['vacantesInternos'=>$vacantesInternos,
        'vacantes'=>$vacantes,
        'vacante'=>$vacante,
        ]);

    }

    public function indexVacanteInternoVer(Vacante $vacante){

        //ver vacante interno colaborador
        $departments = Department::all();
        $jobs = Job::all();
        $user = User::all();
        $text = '<div class="alert alert-warning" role="alert">Ya aplicaste para esta vacante.</div>';
      //  $user = Auth::user()->vacantesinternos;
      $vacantes = User::find(Auth::user()->id)->vacantes()->get();
        //$vacante = Vacante::all();
        $userVacantes = Auth::user()->vacantes();
        return view('employees.vacante.aplicar',
        ['vacante'=>$vacante,
        'departments'=>$departments,
        'jobs'=>$jobs,
        'user'=>$user,
        'text'=>$text,
        'userVacantes'=>$userVacantes,
        'vacantes'=>$vacantes
        ]);
        
  
    }


    public function attach(User $user){
        $user = Auth::user();
        $user->vacantes()->attach(request('vacante'));
        session()->flash('vacante-enviado', 'Has aplicado al puesto de trabajo.');
        return back();
    }

    public function detach(User $user){
        $user = Auth::user();
        $user->vacantes()->detach(request('vacante'));
        session()->flash('vacante-eliminado', 'Tu solicitud se ha retirado.');
        return back();
    }



    //marcaciones 

    public function storeMarcaciones(){


        $user = Auth::user();
        $user->marcaciones()->create(
            [
                'user_id'=>$user->id,
                'marcacion_id'=>request('marcacion_id'),
                'fecha_hora_marcacion'=>request('fecha_hora_marcacion'),
                'latitud'=>request('latitud'),
                'longitud'=>request('longitud')
            ]


        );

        request()->validate([
            'marcacion_id'=>['required'],
            'fecha_hora_marcacion'=>['required']
        ]);

        session()->flash('marcacion-guardada', 'Has registrado tu marcación');

        return back();
    }

    //AUTOGESTION ROLES

        public function indexRolesColaboradores(){
            $user = Auth::user()->payslips;


            return view('employees.autogestion.indexrolesautogestion',[
                'user'=>$user
            ]);

    
        }


        public function showEmployeePayslip(Payslip $payslip){
           // $user = Auth::user()->payslips;


            return view('employees.autogestion.showpayslip',[
                'payslip'=>$payslip
            ]);

    
        }

    //AUTOGESTION CERTIFICADOS

    public function indexCertificadosColaboradores(){
  
        $user = Auth::user();

        return view('employees.autogestion.certificados',[
            'user'=>$user
        ]);

    }

    //AUTOGESTION FORMULARIO GASTOS IMPUESTO A LA RENTA

    public function indexTaxForm(){
        $userTaxes = Auth::user()->taxes;
        $aplica = false;
        $meses = 12;
        $userSalary = Auth::user()->salario; 

        $salarioAnual = $meses * $userSalary;

        if ($salarioAnual >= 11000){
             $aplica = true;
        }

        return view('employees.autogestion.indexformulario',[
            'aplica'=>$aplica,
            'userTaxes'=>$userTaxes
        ]);
    }

    public function indexFormularioImpuestoRenta(){

        $aplica = false;
        $meses = 12;
        $userSalary = Auth::user()->salario; 

        $salarioAnual = $meses * $userSalary;

        if ($salarioAnual >= 11000){
             $aplica = true;
        }

        $config_payroll = DB::table('payrolls')->select('iess')->get();
        $impuestos = DB::table('impuestos')->get(); //traer toda la tabla

        foreach($config_payroll as $config_pay){
            $iessToInt = $config_pay->iess;
        
           }
            $iessToInt2 = floatval($iessToInt);

            $calculoIess = $salarioAnual * $iessToInt2;
            $baseImponibleInicial = $salarioAnual - $calculoIess;

            $baseImponibleFinal = request('baseImponible');
            $vestimenta = request('vestimenta');
            $anio = request('anio');
            $sueldo_anual = request('sueldo_anual');
            $total_ingresos = request('total_ingresos');
            $alimentacion = request('alimentacion');
            $vivienda = request('vivienda');
            $recreacion = request('recreacion');
            $salud = request('salud');
            $total_deduccion_personales = request('total_deduccion_personales');
            $deduccion_iess = request('deduccion_iess');
            $otrosGastos = request('otrosGastos');
            $total_deducciones = request('total_deducciones');
            $deduccion_iess = request('deduccion_iess');
          
            $fraccionBasica = DB::select("select fraccion_basica, impuesto_fraccion_basica, impuesto_fraccion_excedente from impuestos where '$baseImponibleFinal' between fraccion_basica and exceso_hasta");
     
            foreach($fraccionBasica as $fraccionBasica2){
             $fraccionBasicaTotal = $fraccionBasica2->fraccion_basica;
             $impuestoFraccionBasica = $fraccionBasica2->impuesto_fraccion_basica;
             $impuestoFraccionExcedente = $fraccionBasica2->impuesto_fraccion_excedente;
            }
     
            $fraccionExcedente = $baseImponibleFinal - $fraccionBasicaTotal;
            $valorMultiplicado = $fraccionExcedente * $impuestoFraccionExcedente;
            $impuestoAPagar = $valorMultiplicado + $impuestoFraccionBasica;

           
        

        return view('employees.autogestion.formulario',[
            'userSalary'=>$userSalary,
            'aplica'=>$aplica,
            'salarioAnual'=>$salarioAnual,
            'calculoIess'=>$calculoIess,
            'baseImponibleInicial'=>$baseImponibleInicial,
            'impuestos'=>$impuestos,
            'impuestoAPagar'=>$impuestoAPagar,
            'vestimenta'=>$vestimenta,
            'anio'=>$anio,
            'sueldo_anual'=>$sueldo_anual,
            'total_ingresos'=>$total_ingresos,
            'alimentacion' => $alimentacion,
            'vivienda' => $vivienda,
            'recreacion' => $recreacion,
            'salud' => $salud,
            'total_deduccion_personales' => $total_deduccion_personales,
            'deduccion_iess' => $deduccion_iess,
            'otrosGastos' => $otrosGastos,
            'total_deducciones' => $total_deducciones,
            'deduccion_iess' => $deduccion_iess,
            'baseImponibleFinal'=>$baseImponibleFinal
        ]);
    }

    public function calculateTax(){

        $aplica = false;
        $meses = 12;
        $userSalary = Auth::user()->salario; 

        $salarioAnual = $meses * $userSalary;

        if ($salarioAnual >= 11000){
             $aplica = true;
        }

        $config_payroll = DB::table('payrolls')->select('iess')->get();
        $impuestos = DB::table('impuestos')->get(); //traer toda la tabla

        foreach($config_payroll as $config_pay){
            $iessToInt = $config_pay->iess;
        
           }
            $iessToInt2 = floatval($iessToInt);

            $calculoIess = $salarioAnual * $iessToInt2;
            $baseImponibleInicial = $salarioAnual - $calculoIess;

           $baseImponibleFinal = request('baseImponible');
           $vestimenta = request('vestimenta');
           $anio = request('anio');
           $sueldo_anual = request('sueldo_anual');
           $total_ingresos = request('total_ingresos');
           $alimentacion = request('alimentacion');
           $vivienda = request('vivienda');
           $recreacion = request('recreacion');
           $salud = request('salud');
           $total_deduccion_personales = request('total_deduccion_personales');
           $deduccion_iess = request('deduccion_iess');
           $otrosGastos = request('otrosGastos');
           $total_deducciones = request('total_deducciones');
           $deduccion_iess = request('deduccion_iess');
              
            $fraccionBasica = DB::select("select fraccion_basica, impuesto_fraccion_basica, impuesto_fraccion_excedente from impuestos where '$baseImponibleFinal' between fraccion_basica and exceso_hasta");
     
            foreach($fraccionBasica as $fraccionBasica2){
             $fraccionBasicaTotal = $fraccionBasica2->fraccion_basica;
             $impuestoFraccionBasica = $fraccionBasica2->impuesto_fraccion_basica;
             $impuestoFraccionExcedente = $fraccionBasica2->impuesto_fraccion_excedente;
            }
     
            $fraccionExcedente = $baseImponibleFinal - $fraccionBasicaTotal;
            $valorMultiplicado = $fraccionExcedente * $impuestoFraccionExcedente;
            $impuestoAPagar = $valorMultiplicado + $impuestoFraccionBasica;

           
        

        return view('employees.autogestion.formulario',[
            'userSalary'=>$userSalary,
            'aplica'=>$aplica,
            'salarioAnual'=>$salarioAnual,
            'calculoIess'=>$calculoIess,
            'baseImponibleInicial'=>$baseImponibleInicial,
            'impuestos'=>$impuestos,
            'impuestoAPagar'=>$impuestoAPagar,
            'vestimenta'=>$vestimenta,
            'anio'=>$anio,
            'sueldo_anual'=>$sueldo_anual,
            'total_ingresos'=>$total_ingresos,
            'alimentacion' => $alimentacion,
            'vivienda' => $vivienda,
            'recreacion' => $recreacion,
            'salud' => $salud,
            'total_deduccion_personales' => $total_deduccion_personales,
            'deduccion_iess' => $deduccion_iess,
            'otrosGastos' => $otrosGastos,
            'total_deducciones' => $total_deducciones,
            'deduccion_iess' => $deduccion_iess,
            'baseImponibleFinal'=>$baseImponibleFinal

        ]);
    }

    public function storeTax(){
        $user = Auth::user();

        $user->taxes()->create(
            [
                'user_id'=>$user->id,
                'anio'=>request('anio'),
                'sueldo_anual'=>request('sueldo_anual'),
                'total_ingresos'=>request('total_ingresos'),
                'alimentacion'=>request('alimentacion'),
                'vivienda'=>request('vivienda'),
                'recreacion'=>request('recreacion'),
                'vestimenta'=>request('vestimenta'),
                'salud'=>request('salud'),
                'total_deduccion_personales'=>request('total_deduccion_personales'),
                'deduccion_iess'=>request('deduccionIess'),
                'otros_gastos'=>request('otrosGastos'),
                'total_deducciones'=>request('total_deducciones'),
                'base_imponible'=>request('baseImponible'),
                'impuesto_por_pagar'=>request('impuestoAPagar')
            ]


        );

      //  session()->flash('tax-added', 'Se ha guardado tu formulario de impuestos a la renta.');

        return redirect('colaborador/autogestion/formulario/impuesto/renta/index')->with('tax-added','Se ha guardado tu formulario de impuestos a la renta.');
      //  return view ('employees.autogestion.formulario');
    
    }

    public function editTaxes(EmployeeTax $taxes){



        return view('employees.autogestion.editformulario',
        ['taxes'=>$taxes
        ]);
    }

    public function destroyTaxes(EmployeeTax $taxes){

        $taxes->delete();

        session()->flash('tax-deleted', 'Se ha eliminado el registro.');

        return back();


    }

    

}