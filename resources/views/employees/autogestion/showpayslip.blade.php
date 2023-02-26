
@extends('components.admin')
@section('content')

<style>
    .label-ingresos{
        border-top: 1px solid; 
        padding-top: 20px;
        border-color:#1d2e54;
    }
</style>

<div class="container">

<div class="toolbar hidden-print">
                    <div class="text-end">
                    <a href="{{route('descargarPayslipPDF',$payslip)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generar Reporte PDF</a>
                     
                    </div>
                    <hr>
        </div>
        
            <h1 style="color:#1d2e54;">ROL DE PAGOS INDIVIDUAL {{$payslip->mes_anio}}</h1><hr>
            <div class="row">
                <div class="col-sm">
                    <h5 style="color:#ed8210;"><u>INGRESOS</u></h5>
                </div>
                <div class="col-sm">
                    <h5 style="color:#ed8210;"><u>DESCUENTOS</u></h5>
                </div>
               
            </div>

            <div class="row">
                <div class="col-sm">
                    <p><b>Sueldo</b></p>
                    <p><b>Horas suplementarias</b></p>
                    <p><b>Horas extraordinarias</b></p>
                    <p><b>Valor Horas extras</b></p>
                    <p><b>Comisiones</b></p>
                    <h6><b>TOTAL INGRESOS</b></h6>
                </div>
                <div class="col-sm">
                    <p>${{$payslip->sueldo_ganado}}</p>
                    <p>{{$payslip->horas_suplementarias}}</p>
                    <p>{{$payslip->horas_extras}}</p>
                    <p>${{$payslip->valor_horas_extras}}</p>
                    <p>${{$payslip->comision}}</p>
                    <p><b>${{$payslip->total_ingresos}}</b></p>
                </div>
                <div class="col-sm">
                    <p><b>Aporte IESS</b></p>
                    <p><b>Préstamos Quirogr. IESS</b></p>
                    <p><b>Prést. Y Antic. Empresa</b></p>
                    <h6><b>TOTAL EGRESOS</b></h6>
                 
                </div>
                <div class="col-sm">
                    <p>${{$payslip->aporte_iess}}</p>
                    <p>${{$payslip->prestamos_quirografarios}}</p>
                    <p>${{$payslip->anticipos_prestamos}}</p>
                    <p><b>${{$payslip->total_descuentos}}</b></p>
                  
                </div>
               
            </div>

            <div class="row label-ingresos">
                <div class="col-sm">
                    <h6><b>TOTAL A RECIBIR</b></h6>
                </div>
                <div class="col-sm">
                    <h6><b>${{$payslip->liquido_pagar}}</b></h6>
                </div>
            </div>
        
        </div>

@endsection