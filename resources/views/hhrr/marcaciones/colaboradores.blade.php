
@extends('components.admin')
@section('content')
<h1>Buscar marcaciones</h1>


<div class="row-12">

<form method="post" action="{{route('hhrr.search.marcaciones')}}">
@csrf
<div class="col-5">
<label for="">Colaborador:</label>
<select class="form-control" name="user_id" id="user_id" required>
    <option value="" disabled selected>Seleccionar</option>
        @foreach($users as $user)
            <option value="{{$user->id}}"> {{ $user->name }}
        @endforeach
    </select>
</div>

<div class="col-3">
    <label for="from">Desde:</label>
    <input class="form-control" type="date" id="from" name="dateFrom" required>
</div>

<div class="col-3">
<label for="to">Hasta:</label>
    <input class="form-control @error('dateTo') is-invalid @enderror" type="date" id="to" name="dateTo" required>

@error('dateTo')
  <span class="invalid-feedback" role="alert">
  <strong>{{ $message }}</strong>
  </span>
@enderror
</div>

</div><br>

<div class="col-3">
<button type="submit" class="btn btn-primary form-control">Buscar</button>
</div>
</form>
<!--
<br>
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Colaborador</th>
                    <th>Tipo de marcación</th>
                    <th>Fecha/Hora</th>
                  
                </tr>

           </thead>
                <tfoot>
            
                </tfoot>
                <tbody>

                @if($marcacionesColaboradores)
                @foreach($marcacionesColaboradores as $marcacionColaborador)

                <tr>
                    <td>{{$marcacionColaborador->id}}</td>
                    <td>{{$marcacionColaborador->user->name}}</td>
                    <td>{{$marcacionColaborador->marcacion->name}}</td>
                    <td>{{$marcacionColaborador->fecha_hora_marcacion}}</td>
              
            
            
                </tr>
        
                @endforeach
                @endif
                </tbody>
            </table>
        </div>
-->


@endsection