<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payroll;
use App\Models\Payslip;
use App\Models\Monthyears;
use Carbon\Carbon;
use App\Models\Marc;
use App\Models\ConfigMarc;
use DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
class PDFController extends Controller
{
    //
    public function pdf(){

        //sueldos colaboradores sin variaciones

        $payrolls = Payroll::all();
  
        $users = User::all();
       
        foreach($payrolls as $payroll){
            $payroll_iess = $payroll->iess;
            $payroll_aporte_patronal = $payroll->aporte_patronal;
            $payroll_fondo_reserva = $payroll->fondo_reserva;
        }
        $today = Carbon::today()->toDateString();

        foreach($users as $user){
            $salarioUser = $user->salario;
            $payslipIessDiscount = $salarioUser*$payroll_iess;
            $salariosTotales = number_format((($user->sum('salario'))), 2);
            $payslipIessDiscountTotal = number_format((($user->sum('salario'))*$payroll_iess), 2);
            $payslipAportePatronal = $salarioUser*$payroll_aporte_patronal;
            $payslipFondoReserva = $salarioUser*$payroll_fondo_reserva;
            
            $payslipIessAporteTotal = number_format((($user->sum('salario'))*$payroll_aporte_patronal), 2);
            $payslipIessFondoTotal = number_format((($user->sum('salario'))*$payroll_fondo_reserva), 2);


            $salariosTotales2 = $user->sum('salario');
            $payslipIessDiscountTotal2 = $user->sum('salario')*$payroll_iess;
            $payslipAportePatronal2 = $user->sum('salario')*$payroll_aporte_patronal;
            $payslipFondoReserva2 = $user->sum('salario')*$payroll_fondo_reserva;

            $totalSalarios = $salariosTotales2  - $payslipAportePatronal2 - $payslipFondoReserva2;
      
      
        }
     
        $data = [
            'users'=>$users,
            'payslipIessDiscount'=>$payslipIessDiscount,
            'salarioUser'=>$salarioUser,
            'payroll_iess'=>$payroll_iess,
            'salariosTotales'=>$salariosTotales,
            'payslipIessDiscountTotal'=>$payslipIessDiscountTotal,
            'totalSalarios'=>$totalSalarios,
            'salariosTotales2'=>$salariosTotales2,
            'payslipIessDiscountTotal2'=>$payslipIessDiscountTotal2,
            'payroll_aporte_patronal'=>$payroll_aporte_patronal,
            'payroll_fondo_reserva'=>$payroll_fondo_reserva,
            'payslipAportePatronal'=>$payslipAportePatronal,
            'payslipFondoReserva'=>$payslipFondoReserva,
            'payslipIessAporteTotal'=>$payslipIessAporteTotal,
            'payslipIessFondoTotal'=>$payslipIessFondoTotal,
            'today'=>$today
        ];

        
        $pdf = \PDF::loadView('prueba',$data)->setPaper('a4','landscape');
        return $pdf->download('salarios_colaboradores.pdf');

    }


    public function pdfNomina(Monthyears $payroll){

        //reporte de nomina
        $monthYear = $payroll->mes_anio;
        $payslip = Payslip::select()->where('mes_anio', '=', $monthYear)->get();
    
        $sueldoGanado = Payslip::selectRaw('SUM(sueldo_ganado) as sueldo_ganado')->where('mes_anio', '=', $monthYear)->get();
        $valorHorasExtras = Payslip::selectRaw('SUM(valor_horas_extras) as valor_horas_extras')->where('mes_anio', '=', $monthYear)->get();
        $comision = Payslip::selectRaw('SUM(comision) as comision')->where('mes_anio', '=', $monthYear)->get();
        $totalIngresos = Payslip::selectRaw('SUM(total_ingresos) as total_ingresos')->where('mes_anio', '=', $monthYear)->get();
        $aporte = Payslip::selectRaw('SUM(aporte_iess) as aporte_iess')->where('mes_anio', '=', $monthYear)->get();
        $aportePatronal = Payslip::selectRaw('SUM(aporte_patronal) as aporte_patronal')->where('mes_anio', '=', $monthYear)->get();
        $prestamos = Payslip::selectRaw('SUM(prestamos_quirografarios) as prestamos_quirografarios')->where('mes_anio', '=', $monthYear)->get();
        $anticipos = Payslip::selectRaw('SUM(anticipos_prestamos) as anticipos_prestamos')->where('mes_anio', '=', $monthYear)->get();
        $totalDescuentos = Payslip::selectRaw('SUM(total_descuentos) as total_descuentos')->where('mes_anio', '=', $monthYear)->get();
        $liquido = Payslip::selectRaw('SUM(liquido_pagar) as liquido_pagar')->where('mes_anio', '=', $monthYear)->get();

     
        $data = [
            'payroll'=>$payroll,
            'payslip'=>$payslip,
            'sueldoGanado'=>$sueldoGanado,
            'valorHorasExtras'=>$valorHorasExtras,
            'aporte'=>$aporte,
            'totalDescuentos'=>$totalDescuentos,
            'liquido'=>$liquido,
            'totalIngresos'=>$totalIngresos,
            'comision'=>$comision,
            'prestamos'=>$prestamos,
            'anticipos'=>$anticipos,
            'aportePatronal'=>$aportePatronal
        ];

        
        $pdf = \PDF::loadView('nomina',$data)->setPaper('a4','landscape');
        return $pdf->download('salarios_colaboradores.pdf');

    }



    public function certificadoLaboral(){
        $tipo = request('tipo_certificado');

        setlocale(LC_ALL, 'es_EC.UTF-8');
       
        $user = Auth::user();

        
     
        $fechaLaboral = $user->fecha_ingreso;

        $date = Carbon::createFromFormat('Y-m-d', $fechaLaboral);

        $spanishMonth = $date->formatLocalized('%B');
        $year = $date->format('Y');
        $day = $date->format('d');

        $fechaLaboralCompleta = $day . " de " . ucfirst($spanishMonth) . " " . $year;

        $nombreColaborador = ucwords($user->name);
        $trabajoColaborador = ucwords($user->job->name);
        $cedulaColaborador = $user->employee_number;
        $salario = $user->salario;

    
        $today = Carbon::today()->toDateString();
        $date2 = Carbon::createFromFormat('Y-m-d', $today);

        $spanishMonth2 = $date2->formatLocalized('%B');
        $year2 = $date2->format('Y');
        $day2 = $date2->format('d');

        $fechaHoy = $day2 . " de " . ucfirst($spanishMonth2) . " " . $year2;
        
     
        $data = [

        'fechaHoy'=>$fechaHoy,
        'fechaLaboralCompleta'=>$fechaLaboralCompleta,
        'nombreColaborador'=>$nombreColaborador,
        'trabajoColaborador'=>$trabajoColaborador,
        'cedulaColaborador'=>$cedulaColaborador,
        'salario'=>$salario
        ];

        if($tipo == 1) {
            $pdf = \PDF::loadView('certificadolaboral',$data);
            return $pdf->download('certificado_laboral.pdf');
    
        }
        else{
            $pdf = \PDF::loadView('certificadopasantias',$data);
            return $pdf->download('certificado_pasantias.pdf');
        }
       
    }


    public function payslipPDF(Payslip $payslip){

        //payroll

    
        setlocale(LC_ALL, 'es_EC.UTF-8');
       
        
        $fechaPayroll = $payslip->mes_anio;

        $date = Carbon::createFromFormat('m-Y', $fechaPayroll);

        $spanishMonth = $date->formatLocalized('%B');
        $year = $date->format('Y');
      

        $fechaLaboralCompleta = ucfirst($spanishMonth) . " " . $year;
       
        $nombre = ucwords($payslip->nombre);
        $string = str_replace(' ', '', $nombre);

        $cargo = ucwords($payslip->user->job->name);
        $cedula = $payslip->user->employee_number;
        $fecha_ingreso = $payslip->user->fecha_ingreso;

        $data = [
           'payslip'=>$payslip,
            'nombre'=>$nombre,
            'fechaLaboralCompleta'=>$fechaLaboralCompleta,
            'cargo'=>$cargo,
            'cedula'=>$cedula,
            'fecha_ingreso'=>$fecha_ingreso
        ];

        
        $pdf = \PDF::loadView('payroll',$data);
        return $pdf->download('payroll-'. "$string" .'.pdf');

    }



   

}
