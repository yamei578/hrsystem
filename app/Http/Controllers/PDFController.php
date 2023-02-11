<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payroll;
use App\Models\Payslip;
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
        }
        $today = Carbon::today()->toDateString();

        foreach($users as $user){
            $salarioUser = $user->salario;
            $payslipIessDiscount = $salarioUser*$payroll_iess;
            $salariosTotales = number_format((($user->sum('salario'))), 2);
            $payslipIessDiscountTotal = number_format((($user->sum('salario'))*$payroll_iess), 2);




            $salariosTotales2 = $user->sum('salario');
            $payslipIessDiscountTotal2 = $user->sum('salario')*$payroll_iess;

            $totalSalarios = $salariosTotales2 - $payslipIessDiscountTotal2;
      
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
        'today'=>$today
        ];

        
        $pdf = \PDF::loadView('prueba',$data);
        return $pdf->download('salarios_colaboradores.pdf');

    }


    public function certificadoLaboral(){
        $tipo = request('tipo_certificado');

        setlocale(LC_ALL, 'es_EC');
       
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

    
        setlocale(LC_ALL, 'es_EC');
       
        
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
