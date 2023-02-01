<x-admin>
@section('content')

@if(session('marcacionType-updated'))
            <div class="alert alert-success">{{session('marcacionType-updated')}}</div>
    @endif
   
<h1>Editar tipo de marcación: {{$marcaciones->name}}</h1>

<div class="row">
    <div class="col-sm-6">


    <form method="post" action="{{route('confmarcaciones.update', $marcaciones->id)}}">
        @csrf 
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" name="name"  value="{{$marcaciones->name}}">
        </div>

        <div class="form-group">
            <label for="name">Código</label>
            <input type="text" class="form-control" name="codigo"  value="{{$marcaciones->codigo}}">
        </div>

        <button class="btn btn-primary">Actualizar</button>

    </form>

    </div>

</div>

@endsection
</x-admin>