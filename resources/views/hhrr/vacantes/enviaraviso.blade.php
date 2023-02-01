<x-admin>

@section('content')
@if(session('vacante-creado'))
            <div class="alert alert-success">{{session('vacante-creado')}}</div>
@endif

<h1>Formulario de enviar aviso vacante interna</h1>


<form method="POST" action="{{route('vacanteinterno.store')}}">
@csrf 
    <div class="form-row">
    <div class="col-4">
    <label for="exampleFormControlInput1">Departamento</label>
    <select class="form-control" name="department_id" id="department_id">
                                
     <option value="" disabled selected>Seleccionar</option>
    @foreach($departamentos as $departamento)
    <option value="{{$departamento->id}}"> {{ $departamento->name }}
                                
     @endforeach
   </select>
  </div>
  <div class="col-4">
    <label for="exampleFormControlInput1">Puesto de trabajo</label>
    <select class="form-control" id="job_id" name="job_id">
       <option value="" disabled selected>Seleccionar</option>
       @foreach($jobs as $job)
        <option value="{{$job->id}}"> {{$job->name}}
        @endforeach
    </select>
  </div>

<div class="col-4">
<label>Status</label>
    <select name="status" class="form-control" id="status">
      <option value="1">Activo</option>
      <option value="2">Inactivo</option>
    </select>
</div>

    </div><br>
 
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Explicación puesto de trabajo:</label>
    <textarea class="form-control" name="explicacion" id="exampleFormControlTextarea1" rows="15"></textarea>
  </div>
  <button type="submit" class="btn btn-primary mb-2">Enviar notificacion</button>
</form>


@endsection

</x-admin>