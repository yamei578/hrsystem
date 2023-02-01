<x-admin>

@section('content')

@if(session('vacante-actualizado'))
            <div class="alert alert-success">{{session('vacante-actualizado')}}</div>
    @endif

<h1>Editar Vacante:</h1>


<form method="post" action="{{route('vacantes.internos.actualizar', $vacante)}}" enctype="multipart/form-data">
@csrf 
        @method('PUT')


    <div class="form-row">
    <div class="col-4">
   
    <label for="exampleFormControlInput1">Departamento</label>
    <select  class="form-control" name="department_id" id="department_id">
       
         @foreach($departments as $department)
        <option  value="{{$department->id}}" {{$vacante->department_id == $department->id  ? 'selected' : ''}}> {{ $department->name }}</option>
         @endforeach
        </select>
  </div>
  <div class="col-4">
    <label for="job_id">Puesto de trabajo</label>
    <select  class="form-control" name="job_id" id="job_id">
       
       @foreach($jobs as $job)
      <option  value="{{$job->id}}" {{$vacante->job_id == $job->id  ? 'selected' : ''}}> {{ $job->name }}</option>
       @endforeach
      </select>
  </div>

    </div><br>
  <div class="form-group">
    <label for="explicacion">Explicación puesto de trabajo:</label>

    <textarea  name="explicacion" class="form-control" rows="15">{{$vacante->explicacion}}</textarea>
 

  </div>
  <button type="submit" class="btn btn-primary mb-2">Actualizar</button>

</form>

@endsection

</x-admin>