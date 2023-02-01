<x-admin>
@section('content')

@if(session('permission-updated'))
            <div class="alert alert-success">{{session('permission-updated')}}</div>
    @endif
   
<h1>Editar permiso: {{$permission->name}}</h1>

<div class="row">
    <div class="col-sm-6">


    <form method="post" action="{{route('permissions.update', $permission->id)}}">
        @csrf 
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$permission->name}}">
        </div>

        <button class="btn btn-primary">Actualizar</button>

    </form>

    </div>

</div><br>



@endsection
</x-admin>