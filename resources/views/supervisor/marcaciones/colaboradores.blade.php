
@extends('components.admin')
@section('content')
<h1>Buscar marcaciones</h1>

<div class="row-12">



<form action="{{route('search.marcacion')}}" method="post" >
@csrf

<div class="col-5">
<label for="">Colaborador:</label>
<select class="form-control" name="user_id" id="user_id" required>
    <option value="" disabled selected>Seleccionar</option>
        @foreach($users as $user)
        @if(auth()->user()->department_id === $user->department_id)
        <option value="{{$user->id}}"> {{ $user->name }}
        @endif
        @endforeach
    </select>
</div>

<div class="col-5">
    <label for="birthday">Desde:</label>
    <input class="form-control" type="date"  name="fromDate" required id="fromDate">
</div>

<div class="col-5">
<label for="birthday">Hasta:</label>
    <input class="form-control @error('toDate') is-invalid @enderror" type="date"  name="toDate" required id="toDate">
    @error('toDate')
  <span class="invalid-feedback" role="alert">
  <strong>{{ $message }}</strong>
  </span>
@enderror
</div>


</div><br>

<div class="row">
<div class="col-5">
<button type="submit" id="search" class="btn btn-primary form-control">Buscar</button>

</div>
</div>
</form>





@endsection