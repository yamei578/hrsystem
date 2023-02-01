
<x-admin>

@section('content')
@if(session('parametro-actualizado'))
            <div class="alert alert-success">{{session('parametro-actualizado')}}</div>
    @endif

<h1>Editar Parámetros rol de pagos</h1>

<div class="row">
    <div class="col-sm-6">


    <form method="post" action="{{route('rolpagos.update', $payrolls->id)}}">
        @csrf 
        @method('PUT')

        <p style="color:red;"><b>Escribir en formato decimal.</b></p>

        <div class="form-group">
            <label for="name">IESS</label>
            <input type="text" class="form-control" name="iess" value="{{$payrolls->iess}}" required>
        </div>
        <div class="form-group">
            <label for="name">Horas Suplementarias</label>
            <input type="text" class="form-control" name="horas_extras"  value="{{$payrolls->horas_extras}}" required>
        </div>
        <div class="form-group">
            <label for="name">Horas Extras</label>
            <input type="text" class="form-control" name="horas_feriados"  value="{{$payrolls->horas_feriados}}" required>
        </div>

        <button class="btn btn-primary">Actualizar</button>

    </form>

    </div>

</div>

@endsection 
</x-admin>