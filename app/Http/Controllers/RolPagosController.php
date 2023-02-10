<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Models\Marc;
use App\Models\Payroll;
use App\Models\Payslip;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;
use Session;




class RolPagosController extends Controller
{
    //
    public function index(){
        //index de configuraciones
        $payrolls = Payroll::all();
       return view('hhrr.conf.rolpagos',
    [
        'payrolls'=>$payrolls
    ]);

       /* $employees = Employee::all();
        return view('hhrr.conf.rolpagos',
        ['employees'=>$employees,
        ]);*/
    }

    public function indexRolPagos(){
        //index de modulo rol de pagos HHRR muestra salarios sin variaciones
        $payrolls = Payroll::all();
        $employeeController = new EmployeeController();
        $userController = new UserController();
    
        $users = User::all();
      
       
        foreach($payrolls as $payroll){
            $payroll_iess = $payroll->iess;
        }

        foreach($users as $user){
            $salarioUser = $user->salario;
            $payslipIessDiscount = $salarioUser*$payroll_iess;
            $salariosTotales = number_format((($user->sum('salario'))), 2);
            $payslipIessDiscountTotal = number_format((($user->sum('salario'))*$payroll_iess), 2);




            $salariosTotales2 = $user->sum('salario');
            $payslipIessDiscountTotal2 = $user->sum('salario')*$payroll_iess;

            $totalSalarios = $salariosTotales2 - $payslipIessDiscountTotal2;
      
        }


        //$users_salary = $users->salario;
        return view('hhrr.rolpagos.index',
        ['users'=>$users,
        'payslipIessDiscount'=>$payslipIessDiscount,
        'salarioUser'=>$salarioUser,
        'payroll_iess'=>$payroll_iess,
        'salariosTotales'=>$salariosTotales,
        'payslipIessDiscountTotal'=>$payslipIessDiscountTotal,
        'totalSalarios'=>$totalSalarios,
        'salariosTotales2'=>$salariosTotales2,
        'payslipIessDiscountTotal2'=>$payslipIessDiscountTotal2
       
        ]);
        

    }

    public function store(){
        request()->validate([
            'iess'=>['required'],
            'horas_extras'=>['required'],
            'horas_feriados'=>['required']
        ]);

        Payroll::create([
            'iess'=>request('iess'),
            'horas_extras'=>request('horas_extras'),
            'horas_feriados'=>request('horas_extras')
        ]);

        
 
        return back();
    }

    public function destroy(Payroll $payrolls){

        $payrolls->delete();
    
        session()->flash('eliminado', 'Se ha eliminado.');
    
        return back();
    
    
    }


 public function edit(Payroll $payrolls){

    return view('hhrr.conf.editrolpagos',
    ['payrolls'=>$payrolls
  
    ]);

}

public function update(Payroll $payrolls){

    $payrolls->iess = request('iess');
    $payrolls->horas_extras = request('horas_extras');
    $payrolls->horas_feriados = request('horas_feriados');

    if($payrolls->isDirty('iess') || $payrolls->isDirty('horas_extras') || $payrolls->isDirty('horas_feriados')){
     // si tenemos algo que hacer update
     session()->flash('parametro-actualizado', 'Se actualizó.');
     $payrolls->save();
    } else {
     session()->flash('parametro-actualizado', 'No hay nada que actualizar');
     
    }

    return back();

 }

 public function indexPorColaborador(){
    //index de modulo rol de pagos HHRR muestra salarios sin variaciones
    $payrolls = Payroll::all();
    $employeeController = new EmployeeController();
    $userController = new UserController();

    $users = User::all();
  
   


    //$users_salary = $users->salario;
    return view('hhrr.rolpagos.colaborador',
    ['users'=>$users
   
    ]);
    

}


public function payrollEmployee(){
    try{
        $users = User::all();

        $datetime = Carbon::now()->toDateTimeString(); //todays datetime
        $cur_date = Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->isoFormat('DD'); //only day from datetime
    
        request()->validate([
            'fecha_desde'=>['required'],
            'fecha_hasta'=>['required','after_or_equal:fecha_desde'],
        ]);
    
        $fecha_desde = request('fecha_desde');
        $fecha_hasta= request('fecha_hasta');
        $user_id = request('user_id');
       
        $fechaPayroll = Carbon::createFromFormat('Y-m-d', $fecha_desde)->isoFormat('MM-YYYY'); 
        $diasLaboralesMes = 30;
        $horasLaboralesMes = 160;
        $porcentajeSuplementarias = 1.5;
        $porcentajeExtras = 2;
        $horasDiarias = 8;
        
    
      $marcacionesColaboradores = Marc::all();
    
        foreach($marcacionesColaboradores as $marcaciones){
           $marcaciones->fecha_hora_marcacion;
        }
    
       //$hola = Marc::where('user_id','=',$user_id)->whereBetween('fecha_hora_marcacion',[$fecha_desde,Carbon::parse($fecha_hasta)->endOfDay()])->count();
       $query = DB::table('marcs')->select('users.name','marcs.fecha_hora_marcacion','config_marcs.name as nombreMarcacion','users.salario','marcs.horas_trabajadas')->whereDate('fecha_hora_marcacion', '>=', $fecha_desde)->whereDate('fecha_hora_marcacion', '<=', $fecha_hasta)->join('users','marcs.user_id','=','users.id')->join('config_marcs','marcs.marcacion_id','=','config_marcs.id')->where('user_id','=',$user_id)->where('marcs.marcacion_id','=','2')->get(); //ESTE
    
       $queryHorasSup = DB::table('marcs')->selectRaw('SUM(HOUR(marcs.horas_trabajadas)) as horasTotales')->whereDate('fecha_hora_marcacion', '>=', $fecha_desde)->whereDate('fecha_hora_marcacion', '<=', $fecha_hasta)->join('users','marcs.user_id','=','users.id')->join('config_marcs','marcs.marcacion_id','=','config_marcs.id')->where('user_id','=',$user_id)->where('marcs.marcacion_id','=','2')->get(); //ESTE
       $queryHorasExtras = DB::table('marcs')->selectRaw('SUM(HOUR(marcs.horas_trabajadas)) as horasTotales')->whereDate('fecha_hora_marcacion', '>=', $fecha_desde)->whereDate('fecha_hora_marcacion', '<=', $fecha_hasta)->join('users','marcs.user_id','=','users.id')->join('config_marcs','marcs.marcacion_id','=','config_marcs.id')->where('user_id','=',$user_id)->where('marcs.marcacion_id','=','6')->get(); //ESTE
    
       $config_payroll = DB::table('payrolls')->select('iess')->get();
    
       $queryHorasSup2 = DB::table('marcs')->selectRaw('(HOUR(marcs.horas_trabajadas)) as horasTotales')->whereDate('fecha_hora_marcacion', '>=', $fecha_desde)->whereDate('fecha_hora_marcacion', '<=', $fecha_hasta)->join('users','marcs.user_id','=','users.id')->join('config_marcs','marcs.marcacion_id','=','config_marcs.id')->where('user_id','=',$user_id)->where('marcs.marcacion_id','=','2')->get()->toArray(); //ESTE
    
       //inicio horas 50%
       $collection = collect($queryHorasSup2);
       $resta = $collection->map(function ($item, $key) {
            $horasDiarias = 8;
            $horasSolas = $item->horasTotales;
           return ($horasSolas - $horasDiarias);
          
        });
        $horas50 = array_sum($resta->all());
        // DD(array_sum($resta));
    
        //fin horas 50%
    
       foreach($queryHorasSup as $horasQuery){
        //para sacar horas suplementarias 50%
        $horasToInt = $horasQuery->horasTotales;
    
       }
       $horasToInt2 = intval($horasToInt);
    
       foreach($queryHorasExtras as $horasExtrasQuery){
        //para sacar horas extras 100%
        $horasExtrasToInt = $horasExtrasQuery->horasTotales;
    
       }
       $horasExtrasToInt2 = intval($horasExtrasToInt);
    
       foreach($queryHorasSup2 as $queriesHorasSup2){
        //para sacar horas extras 50% REALES
         $horasReales = $queriesHorasSup2->horasTotales;
        //$horasReales2 = intval($horasReales);
        $arrayHoras = $horasReales - $horasDiarias;
       
        
       // $numbers[] = array_push($nuevo);
       // print_r(array_sum($numbers));
        //xwprint_r(array_push($nuevo));
       }
    
      
    
       foreach($config_payroll as $config_pay){
        $iessToInt = $config_pay->iess;
    
       }
        $iessToInt2 = floatval($iessToInt);
       
    
       $totalDiasLaborados = $query->count();
      
    
        foreach($query as $queries){
        
            $sueldoNominal = $queries->salario;
            $colaboradorNombre = $queries->name;
        
           //$totalHorasExtras = $queries->horas_trabajadas->count();
         }
       //PENSAR ESTO!! $sueldoGanado = $sueldoNominal/$diasLaboralesMes*$totalDiasLaborados;
        $sueldoGanado = $sueldoNominal/$diasLaboralesMes*30;
    
        //CALCULO 
        $horasSuplementariasTotal = $horasToInt2-$horasLaboralesMes;  
        $totalHorasExtrasYSup = ($horas50*$porcentajeSuplementarias)+($horasExtrasToInt2*$porcentajeExtras);
        $valorHorasExtras = ($sueldoNominal/30)/(8)*$totalHorasExtrasYSup;
        $totalIngresos = $sueldoGanado+$valorHorasExtras;
        $descuentoIess = $totalIngresos*$iessToInt2;
        $totalDescuentos = $descuentoIess;
        $liquidoAPagar = $totalIngresos-$totalDescuentos;
        return view('hhrr.rolpagos.payrollgenerated',
        ['query'=>$query,
        'fecha_desde'=>$fecha_desde,
        'fecha_hasta'=>$fecha_hasta,
        'users'=>$users,
        'fechaPayroll'=>$fechaPayroll,
        'totalDiasLaborados'=>$totalDiasLaborados,
        'sueldoGanado'=>$sueldoGanado,
        'horasSuplementariasTotal'=>$horasSuplementariasTotal,
        'totalHorasExtrasYSup'=>$totalHorasExtrasYSup,
        'valorHorasExtras'=>$valorHorasExtras,
        'totalIngresos'=>$totalIngresos,
        'descuentoIess'=>$descuentoIess,
        'totalDescuentos'=>$totalDescuentos,
        'liquidoAPagar'=>$liquidoAPagar,
        'horasExtrasToInt2'=>$horasExtrasToInt2,
        'colaboradorNombre'=>$colaboradorNombre,
        'sueldoNominal'=>$sueldoNominal,
        'diasLaboralesMes'=>$diasLaboralesMes,
        'horas50'=>$horas50,
        'user_id'=>$user_id,
        'fecha_desde'=>$fecha_desde,
        'fecha_hasta'=>$fecha_hasta,
        'iessToInt2'=>$iessToInt2
        ]);
      
    }
    catch(\Exception $e){ 
     
    return redirect('hhrr/rolpagos/colaborador')->with('message','No se encontraron resultados. El colaborador debe tener marcaciones para generar el rol.');

    }
   
    
  
}

public function insertPayslip(){
   
   
    Payslip::create([
        'user_id'=>request('user_id'),
        'nombre'=>request('nombre'),
        'fecha_desde'=>request('fecha_desde'),
        'fecha_hasta'=>request('fecha_hasta'),
        'mes_anio'=>request('fecha_payroll'),
        'sueldo_nominal'=>request('sueldo_nominal'),
        'sueldo_ganado'=>request('sueldo_ganado'),
        'dias_laborados'=>request('dias_trabajados'),
        'horas_suplementarias'=>request('horas_50'),
        'horas_extras'=>request('horas_100'),
        'total_horas_extras'=>request('total_horas'),
        'valor_horas_extras'=>request('valor_horas'),

        'comision'=>request('comision_valor'),
        'total_ingresos'=>request('total_ingresos'),
        'aporte_iess'=>request('aporte_total'),
        'prestamos_quirografarios'=>request('prestamos'),
        'anticipos_prestamos'=>request('anticipos'),
        'total_descuentos'=>request('total_descuentos'),
        'liquido_pagar'=>request('liquido_pagar')
       
    ]);

    session()->flash('payslip-agregado', 'Se guardó el rol del colaborador.');

    return back();
    
}


}