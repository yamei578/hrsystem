
<x-admin>

@section('content')
@if(session('parametro-actualizado'))
            <div class="alert alert-success">{{session('parametro-actualizado')}}</div>
@endif



<div class="container">
<h1>Editar Parámetros rol de pagos</h1>
    <div class="col-sm-6">


    <form method="post" action="{{route('rolpagos.update', $payrolls->id)}}">
        @csrf 
        @method('PUT')

        <div class="form-group">
            <label for="name">IESS</label>
            <input type="text" class="form-control" name="iess" value="{{$payrolls->iess}}" required>
        </div>
        <div class="form-group">
            <label for="name">Horas Suplementarias</label>
            <input type="text" class="form-control" name="horas_extras"  value="{{number_format($payrolls->horas_extras,2)}}" required>
        </div>
        <div class="form-group">
            <label for="name">Horas Extras</label>
            <input type="text" class="form-control" name="horas_feriados"  value="{{number_format($payrolls->horas_feriados,2)}}" required>
        </div>
        <div class="form-group">
            <label for="name">Aporte Patronal</label>
            <input type="text" class="form-control" name="aporte_patronal"  value="{{$payrolls->aporte_patronal}}" required>
        </div>
        <div class="form-group">
            <label for="name">Fondo de Reserva</label>
            <input type="text" class="form-control" name="fondo_reserva"  value="{{$payrolls->fondo_reserva}}" required>
        </div>

        <button class="btn btn-primary">Actualizar</button>

    </form>

    </div>

</div><br>



@endsection 
</x-admin>