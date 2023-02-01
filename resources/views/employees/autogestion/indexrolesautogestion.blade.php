
@extends('components.admin')
@section('content')
<style>
  
    h6{
    font-family: Arial, Helvetica, sans-serif;
    line-height: 10;
    text-align: justify;
}
</style>
<h1>Roles disponibles</h1>
<p>Roles apareceran cuando Recursos Humanos lo haya generado.</p>
@if($user)
<div class="row-12">

<br>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
               <tr>
                   <th>Fecha Mes/Año</th>
                   <th>Fecha desde</th>
                   <th>Fecha hasta</th>
                   <th>Líquido a pagar</th>
               </tr>

          </thead>
               <tfoot>
           
               </tfoot>
               <tbody>
               @foreach($user as $user_payslips)
             
             
               <tr>
                  <td><a href="{{route('employee.payslip.show', $user_payslips->id)}}">{{$user_payslips->mes_anio}}</a></td>
                  <td>{{$user_payslips->fecha_desde}}</td>
                  <td>{{$user_payslips->fecha_hasta}}</td>
                  <td>{{$user_payslips->liquido_pagar}}</td>
              
                   
               </tr>
            @endforeach
               </tbody>
    </table>
</div>
</div>
@endif

@endsection