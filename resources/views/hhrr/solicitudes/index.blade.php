<x-admin>

<style>
  #hidden_div {
    display: none;
}
#hidden_div_monto {
    display: none;
}

</style>

@section('content')
@if(session('request-created'))
            <div class="alert alert-success">{{session('request-created')}}</div>
    @endif

<h1>Formulario de solicitudes</h1>


<form method="POST" action="{{route('solicitudes.store')}}">
@csrf 
    <div class="form-row">
   
  <div class="col-3">
    <label>Tipo de solicitud</label>
    <select class="form-control" name="solicitud_id" id="requestOption" required>
    <option value="" disabled selected>Seleccionar</option>
      @foreach($solicitudes as $solicitud)
      <option value="{{$solicitud->id}}" id="select">{{$solicitud->name}}
      @endforeach 
    </select>
  </div>
  <div class="col-3">
  <label>Fecha de solicitud</label>
        <input type="date" class="form-control" name="fecha_solicitud" required>
  </div>
    </div><br>

    <div id="hidden_div" style="display: none;">
  <div class="form-row">
      <div class="col-3">
        <label>Fecha de permiso inicio</label>
        <input type="date" class="form-control" name="fecha_desde">
      </div>
      <div class="col-3">
        <label>Fecha de permiso fin</label>
        <input type="date" class="form-control" name="fecha_hasta">
      </div>
  </div>

</div>
  
 
 
  <div class="form-group">
   
    <div id="hidden_div_monto" style="display: none;">
    <div class="col-3">
      <label>Monto $</label>
      <input type="text" class="form-control" name="monto">
    </div>
    <div class="col-3">
      <label>Cuotas</label>
      <input type="text" class="form-control" name="cuotas">
    </div>
     
    </div>

    <label>Observaciones/Motivos:</label>
    <textarea class="form-control" name="explicacion" rows="3"></textarea>
  </div>

  <button type="submit" class="btn btn-primary mb-2">Enviar solicitud</button>
</form>

<script>

  //campos visibles permisos de viaje/medico
document.getElementById('requestOption').addEventListener('change', function () {
    var style = this.value == 2 || this.value == 3 || this.value == 4 ? 'block' : 'none';
    console.log(style);
    document.getElementById('hidden_div').style.display = style;
});

//campos visibles montos prestamos
document.getElementById('requestOption').addEventListener('change', function () {
    var style = this.value == 5 || this.value == 6 ? 'block' : 'none';
    console.log(style);
    document.getElementById('hidden_div_monto').style.display = style;
});

</script>

@endsection

</x-admin>