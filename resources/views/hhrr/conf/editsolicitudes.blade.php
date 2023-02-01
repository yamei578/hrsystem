<x-admin>
@section('content')

@if(session('solicitudType-updated'))
            <div class="alert alert-success">{{session('solicitudType-updated')}}</div>
    @endif
   
<h1>Editar tipo de solicitud: {{$solicitudes->name}}</h1>

<div class="row">
    <div class="col-sm-6">


    <form method="post" action="{{route('confsolicitudes.update', $solicitudes->id)}}">
        @csrf 
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" name="name"  value="{{$solicitudes->name}}">
        </div>
        <div class="form-group">
            <label for="name">Código</label>
            <input type="text" class="form-control" name="codigo" value="{{$solicitudes->codigo}}">
        </div>

        <button class="btn btn-primary">Actualizar</button>

    </form>

    </div>

</div>

@endsection

</x-admin>