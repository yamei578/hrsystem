

<x-admin>



@section('content')


@if(session('message'))
    <div class="alert alert-danger">{{session('message')}}</div>
@endif

<h1>Generar rol de pagos por colaborador</h1>
<br>
<form  method="get" action="{{route('employeespay.search')}}">
@csrf
<div class="form-row">

<div class="col-3">
    <label for="inputEmail3" >Colaborador:</label>
   
    <select class="form-control" name="user_id" required>
    <option value="" disabled selected>Seleccionar</option>
        @foreach($users as $user)
        <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
              
    </select>
  
</div>

<div class="col-3">
    <label for="birthday">Desde:</label>
    <input class="form-control" type="date"  name="fecha_desde" required>
    
</div>

<div class="col-3">
<label for="birthday">Hasta:</label>
    <input class="form-control @error('fecha_hasta') is-invalid @enderror" type="date"  name="fecha_hasta" required>

    @error('fecha_hasta')
  <span class="invalid-feedback" role="alert">
  <strong>{{ $message }}</strong>
  </span>
@enderror
</div>




</div><br>
<div class="row">
    <div class="form-group">
        <button class="btn btn-primary ">Generar rol</button>

    </div>

    </div>
<br><br>

</form>
         
  
@endsection





</x-admin>
