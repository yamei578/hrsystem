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


<h1>Solicitud</h1>


<div class="form-row">
    <div class="col-3">
    <label>Colaborador</label>
                <input type="text" class="form-control" readonly name="user_id" id="user_id" value="{{$solicitud->user->name}}">
    </div>
   
    <div class="col-3">
            <label>Tipo de solicitud</label>
                <select disabled class="form-control" name="solicitud_id"required>
                
                    @foreach($sols as $sol)
                        <option value="{{$sol->id}}" id="select" {{$solicitud->solicitud_id == $sol->id  ? 'selected' : ''}}> {{ $sol->name }}</option>
                    @endforeach
            
                </select>
    </div>

    <div class="col-3">
            <label>Fecha de solicitud</label>
                <input type="date" class="form-control" readonly name="fecha_solicitud" id="fecha_solicitud" value="{{$solicitud->fecha_solicitud}}">
    </div>

</div><br>

@if($solicitud->solicitud_id == 2 || $solicitud->solicitud_id == 3 ||$solicitud->solicitud_id == 4)
   
  <div class="form-row">
        <div class="col-3">
                <label>Fecha de permiso inicio</label>
                <input type="date" class="form-control" readonly name="fecha_desde" value="{{$solicitud->fecha_desde}}">
        </div>
      <div class="col-3">
            <label>Fecha de permiso fin</label>
            <input type="date" class="form-control" readonly name="fecha_hasta" value="{{$solicitud->fecha_hasta}}">
      </div>
  </div><br>


@endif
  
 
@if($solicitud->solicitud_id == 5 || $solicitud->solicitud_id == 6)
 
  <div class="form-row">
   
    <div class="col-3">
        <label>Monto $</label>
        <input type="text" readonly class="form-control" name="monto" value="{{$solicitud->monto}}">
    </div>
    <div class="col-3">
        <label>Cuotas</label>
        <input type="text" readonly class="form-control" name="cuotas" value="{{$solicitud->cuotas}}">
    </div>
</div><br>

@endif 

    <label>Observaciones/Motivos:</label>
    <textarea class="form-control" name="explicacion" readonly rows="3">{{$solicitud->explicacion}}</textarea>
 

@endsection

</x-admin>