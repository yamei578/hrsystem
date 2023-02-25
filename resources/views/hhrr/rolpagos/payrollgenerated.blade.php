

<x-admin>


@section('content')

@if(session('payslip-agregado'))
            <div class="alert alert-success">{{session('payslip-agregado')}}</div>
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
   

    var valorSuplementarias = document.getElementById('supToInt2').value;
    var valorExtraordinarias = document.getElementById('extrasToInt2').value;
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
    //let porcentajeIess = 0.0945;
    var porcentajeIess = document.getElementById('iessToInt2').value;
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



@if($query != null)

<h1>Rol de pagos generado.</h1>
<p>Los campos de color azul, son editables.</p>
<p><b>Una vez revisado/editado el rol, dar click en "Guardar rol generado del colaborador".</b></p>

<br>
          <div class="col-sm-12">
       
        
          <div class="card shadow mb-4">
              
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">SUELDOS COLABORADORES CON VARIACIONES</h6>
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
                  <form action="{{route('insert.payslip')}}" method="POST">
                            @csrf 
                  <tr>
                     <td><input type="text" class="inputs" readonly value="{{$fechaPayroll}}" name="fecha_payroll"></td>
                     <td><input type="text" class="inputs" readonly value="{{$colaboradorNombre}}" name="nombre"></td>
                     <td><input class="inputs" style="background-color: #D7E5FD" type="text" id="diasTrabajados" name="dias_trabajados" value="{{$diasLaboralesMes}}"></td>
                     <td><input readonly class="inputs" type="text" id="sueldoNominal" value="{{($sueldoNominal)}}" name="sueldo_nominal"></td>
                     <td><input readonly class="inputs" type="text" value="{{($sueldoGanado)}}" id="sueldoGanado" name="sueldo_ganado"></td>
                     <td><input type="text" style="background-color: #D7E5FD;" class="inputs" value="{{$horas50}}" id="horas50" name="horas_50"></td>
                     <td><input type="text" style="background-color: #D7E5FD" class="inputs" value="{{$horasExtrasToInt2}}" id="horas100" name="horas_100"></td>
                     <td><input type="text" class="inputs" id="totalHoras" readonly value="{{$totalHorasExtrasYSup}}" name="total_horas"></td>
                     <td><input type="text" class="inputs" readonly value="{{($valorHorasExtras)}}" id="valorHoras" name="valor_horas"></td>
                    
                     <td><input type="text" class="inputs" style="background-color: #D7E5FD" value="0"  id="comisionValor" name="comision_valor"></td>
                     <td><input type="text" class="inputs" readonly value="{{($totalIngresos)}}" name="total_ingresos" id="totalDeIngresos"></td>
                     <td><input type="text" class="inputs" readonly value="{{($descuentoIess)}}" name="aporte_total" id="aporteTotal"></td>
                     <td><input type="text" class="inputs" style="background-color: #D7E5FD" value="0" id="prestamos" name="prestamos"></td>
                     <td><input type="text" class="inputs" style="background-color: #D7E5FD" value="0" id="anticipos" name="anticipos"></td>
                     <td><input type="text" class="inputs" readonly value="{{($totalDescuentos)}}" name="total_descuentos" id="aporteTotal2"></td>
                     <td><input type="text" class="inputs" readonly value="{{($liquidoAPagar)}}" name="liquido_pagar" id="liquidoAPagar"></td>
                      
                  </tr>
                  <input type="text" name="user_id" value="{{$user_id}}" hidden="true">
                  <input type="text" name="fecha_desde" value="{{$fecha_desde}}" hidden="true">
                  <input type="text" name="fecha_hasta" value="{{$fecha_hasta}}" hidden="true">
                  <input type="text" id="iessToInt2" value="{{$iessToInt2}}" hidden="true">
                  <input type="text" id="supToInt2" value="{{$supToInt2}}" hidden="true">
                  <input type="text" id="extrasToInt2" value="{{$extrasToInt2}}" hidden="true">
                  <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Guardar rol generado del colaborador</button><br>
                  </form>
                  </tbody><br>
              </table>
             
          </div>
          </div>
          
          </div>
        
          </div>
          @endif

    
       


@endsection





</x-admin>
