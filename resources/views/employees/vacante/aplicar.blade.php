<x-admin>

@section('content')

@if(session('vacante-enviado'))
            <div class="alert alert-success">{{session('vacante-enviado')}}</div>
    @endif
    @if(session('vacante-eliminado'))
            <div class="alert alert-warning">{{session('vacante-eliminado')}}</div>
    @endif

<h1>Vacante disponible:</h1>
@if($vacantes->contains($vacante))
{!! $text !!}
@endif



    <div class="form-row">
    <div class="col-4">
   
    <label for="">Departamento</label>
    <select disabled class="form-control" name="department_id" id="department_id">
       
         @foreach($departments as $department)
        <option  value="{{$department->id}}" {{$vacante->department_id == $department->id  ? 'selected' : ''}}> {{ $department->name }}</option>
         @endforeach
        </select>
  </div>
  <div class="col-4">
    <label for="">Puesto de trabajo</label>
    <select disabled class="form-control" name="job_id" id="job_id">
       
       @foreach($jobs as $job)
      <option  value="{{$job->id}}" {{$vacante->job_id == $job->id  ? 'selected' : ''}}> {{ $job->name }}</option>
       @endforeach
      </select>
  </div>
  <div class="col-4">
    <label for="">Status</label>
      <input class="form-control"type="text" readonly value="@if($vacante->status == 1)
        Activo
      @else
        Inactivo
      @endif "
      >
  </div>
    </div><br>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Explicación puesto de trabajo:</label>

    <textarea readonly class="form-control" rows="12">{{$vacante->explicacion}}</textarea>
 

  </div>
  <div class="form-row">
  <form method="post" action="{{route('users.vacante.attach',$vacante)}}">
                                        @method('PUT')
                                        @csrf 
                                        <input type="hidden" name="vacante" value="{{$vacante->id}}">
                                        <button style="margin: 10px;" class="btn btn-success mb-2"
                                        @if($vacantes->contains($vacante))
                                        disabled
                                        @endif
                                        
                                        >
                                Aplicar</button>
                                </form>

 <form method="post" action="{{route('users.vacante.detach',$vacante)}}">
                                        @method('PUT')
                                        @csrf 
                                        <input type="hidden" name="vacante" value="{{$vacante->id}}">
                                <button  style="margin: 10px;" class="btn btn-danger mb-2">
                                Quitar aplicación</button>
                                </form>

  </div>
  
 
                                
                               
                        
                

@endsection

</x-admin>