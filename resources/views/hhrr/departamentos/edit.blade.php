<x-admin>
@section('content')

@if(session('department-updated'))
            <div class="alert alert-success">{{session('department-updated')}}</div>
@endif
   
<h1>Editar departamento: {{$department->name}}</h1>

<div class="row">
    <div class="col-sm-6">


    <form method="post" action="{{route('departments.update', $department->id)}}">
        @csrf 
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre departamento</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$department->name}}">
        </div>
        <div class="form-group">
        <label for="jobSelect">Supervisor/Jefe</label>
                        <select class="form-control" id="user_id" name="user_id">
                                
                        <option value="" disabled selected>Seleccionar</option>
                        @foreach($users as $user)
                        <option value="{{$user->id}}" {{$department->user_id == $user->id  ? 'selected' : ''}}> {{ $user->name }}</option>
                        @endforeach
                        </select>
        </div>

        <button class="btn btn-primary">Actualizar</button>

    </form>

    </div>

</div>





@endsection
</x-admin>