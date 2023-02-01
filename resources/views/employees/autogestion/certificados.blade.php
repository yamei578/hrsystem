
@extends('components.admin')
@section('content')
<h1>CERTIFICADOS</h1>


<div class="row-12">

<form method="post" action="{{route('descargarLaboral')}}">
    @csrf 
<div class="col-5">
<label for="">Tipo:</label>
<select class="form-control" name="tipo_certificado" required>
    <option value="" disabled selected>Seleccionar</option>
      
            <option value="1">Laboral</option>
            <option value="2">Pasantías</option>
       
    </select>
</div>

</div><br>

<div class="col-3">
<button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generar Reporte PDF</button>
</div>

</form>




@endsection