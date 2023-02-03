

<x-admin>


@section('content')

@if(session('payslip-updated'))
            <div class="alert alert-success">{{session('payslip-updated')}}</div>
    @endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  jQuery(function($) {
  $(document).on('change', function() {

    //sueldo ganado
    var sueldo = document.getElementById('sueldoNominal');
    var totalDias = document.getElementById('diasTrabajados');
    let diasLaborales = 30;
    
    var extraextraresultEl = parseFloat((sueldo.value)/diasLaborales) * parseFloat(totalDias.value);
    $('#sueldoGanado').val(extraextraresultEl.toFixed(2));

    //total hrs extras
    var horasSuplementarias = document.getElementById('horas50');
    var horasExtraordinarias = document.getElementById('horas100');
    let valorSuplementarias = 1.5;
    let valorExtraordinarias = 2;

    var totalHorasExtras = parseFloat((horasSuplementarias.value)*valorSuplementarias) + parseFloat((horasExtraordinarias.value)*valorExtraordinarias);
    $('#totalHoras').val(totalHorasExtras.toFixed(2));

    //valor hrs extras
    let dias = 8;
    var valor = parseFloat((sueldo.value/diasLaborales)/8)*totalHorasExtras;
    $('#valorHoras').val(valor.toFixed(2));
    
    // total ingresos
    var comision = document.getElementById('comisionValor');
    var totalIngresos = parseFloat(comision.value) + parseFloat(extraextraresultEl) + parseFloat(valor);
    $('#totalDeIngresos').val(totalIngresos.toFixed(2));

    //aporte iess 
    let porcentajeIess = 0.0945;
    var totalIess = parseFloat(totalIngresos * porcentajeIess);
    $('#aporteTotal').val(totalIess.toFixed(2));
    $('#aporteTotal2').val(totalIess.toFixed(2));

    //prestamos y anticipos ===== total descuentos!
    var prestamosValor = document.getElementById('prestamos');
    var anticiposValor = document.getElementById('anticipos');
    var totalDescuentos = parseFloat(prestamosValor.value) + parseFloat(anticiposValor.value) + parseFloat(totalIess);
    $('#aporteTotal2').val(totalDescuentos.toFixed(2));

    //liquido a pagar
    var liquidoTotal = parseFloat(totalIngresos) - parseFloat(totalDescuentos);
    $('#liquidoAPagar').val(liquidoTotal.toFixed(2));

  });
});
</script>
<style>
  .inputs{
    border: none;
    width: 90px;
    text-align: center;
  }
</style>


<p>Los campos de color azul, son editables.</p>
<p><b>Una vez revisado/editado el rol, dar click en "Actualizar rol generado del colaborador".</b></p>

<br>
          <div class="col-sm-12">
       
        
          <div class="card shadow mb-4">
              
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">SUELDO COLABORADOR: {{$payslip->nombre}}</h6>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="" width="100%" cellspacing="1">
                  <thead>
                  <tr>
                      <th>Mes/Año</th>
                      <th>Colaborador</th>
                      <th>Días trabajados</th>
                      <th>Sueldo Nominal</th>
                      <th>Sueldo Ganado</th>
                      <th>Horas 50%</th>
                      <th>Horas 100%</th>
                      <th>Total hrs extras</th>
                      <th>Valor hrs extras</th>
                      <th>Comisión</th>
                      <th>Total ingresos</th>
                      <th>Aporte IESS</th>
                      <th>Préstamos quirografarios</th>
                      <th>Anticipo y préstamos</th>
                      <th>Total descuentos</th>
                      <th>Líquido a pagar</th>
                  </tr>
  
             </thead>
                  <tfoot>
              
                  </tfoot>
                  <tbody>
                
                  <form method="post" action="{{route('payslip.update', $payslip->id)}}">
                      @csrf 
                      @method('PUT')
                  <tr>
                     <td><input type="text" class="inputs" readonly value="{{$payslip->mes_anio}}" name="fecha_payroll"></td>
                     <td><input type="text" class="inputs" readonly value="{{$payslip->nombre}}" name="nombre"></td>
                     <td><input class="inputs" style="background-color: #D7E5FD" type="text" id="diasTrabajados" name="dias_trabajados" value="{{$payslip->dias_laborados}}"></td>
                     <td><input readonly class="inputs" type="text" id="sueldoNominal" value="{{$payslip->sueldo_nominal}}" name="sueldo_nominal"></td>
                     <td><input readonly class="inputs" type="text" value="{{$payslip->sueldo_ganado}}" id="sueldoGanado" name="sueldo_ganado"></td>
                     <td><input type="text" style="background-color: #D7E5FD;" class="inputs" value="{{$payslip->horas_suplementarias}}" id="horas50" name="horas_50"></td>
                     <td><input type="text" style="background-color: #D7E5FD" class="inputs" value="{{$payslip->horas_extras}}" id="horas100" name="horas_100"></td>
                     <td><input type="text" class="inputs" id="totalHoras" readonly value="{{$payslip->total_horas_extras}}" name="total_horas"></td>
                     <td><input type="text" class="inputs" readonly value="{{$payslip->valor_horas_extras}}" id="valorHoras" name="valor_horas"></td>
                    
                     <td><input type="text" class="inputs" style="background-color: #D7E5FD" value="{{$payslip->comision}}"  id="comisionValor" name="comision_valor"></td>
                     <td><input type="text" class="inputs" readonly value="{{$payslip->total_ingresos}}" name="total_ingresos" id="totalDeIngresos"></td>
                     <td><input type="text" class="inputs" value="{{$payslip->aporte_iess}}" name="aporte_total" id="aporteTotal"></td>
                     <td><input type="text" class="inputs" style="background-color: #D7E5FD" value="{{$payslip->prestamos_quirografarios}}" id="prestamos" name="prestamos"></td>
                     <td><input type="text" class="inputs" style="background-color: #D7E5FD" value="{{$payslip->anticipos_prestamos}}" id="anticipos" name="anticipos"></td>
                     <td><input type="text" class="inputs" readonly value="{{$payslip->total_descuentos}}" name="total_descuentos" id="aporteTotal2"></td>
                     <td><input type="text" class="inputs" readonly value="{{$payslip->liquido_pagar}}" name="liquido_pagar" id="liquidoAPagar"></td>
                      
                  </tr>
                  <input type="text" name="user_id" value="{{$payslip->user_id}}" hidden="true">
                  <input type="text" name="fecha_desde" value="{{$payslip->fecha_desde}}" hidden="true">
                  <input type="text" name="fecha_hasta" value="{{$payslip->fecha_hasta}}" hidden="true">
               
                    <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Actualizar rol generado del colaborador</button><br>
                  </form>
                  </tbody><br>
              </table>
             
          </div>
          </div>
          
          </div>
        
          </div>    
       


@endsection





</x-admin>
