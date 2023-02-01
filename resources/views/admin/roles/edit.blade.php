<x-admin>
@section('content')


@if(session('role-updated'))
            <div class="alert alert-success">{{session('role-updated')}}</div>
    @endif
   
<h1>Editar rol: {{$role->name}}</h1>

<div class="row">
    <div class="col-sm-6">


    <form method="post" action="{{route('roles.update', $role->id)}}">
        @csrf 
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" @if($role->name==('Admin') || $role->name==('Human Resources') || $role->name==('Employee') || $role->name==('Supervisor'))
                            readonly
                            @endif class="form-control" name="name" id="name" value="{{$role->name}}">
        </div>

        <button class="btn btn-primary" @if($role->name==('Admin') || $role->name==('Human Resources') || $role->name==('Employee') || $role->name==('Supervisor'))
                            onclick="return false;"
                            @endif >Actualizar</button>

    </form>

    </div>

</div><br>

<!-- permission -->
@if($permissions->isNotEmpty())
<div class="col-12">
                             
                             <div class="card shadow mb-4">
                             <div class="card-header py-3">
                                     <h6 class="m-0 font-weight-bold text-primary">Permisos</h6>
                             </div>
                             <div class="card-body">
                                     <div class="table-responsive">
                                     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                             <thead>
                                             <tr>
                                             <th>Opciones</th>
                                            
                                             <th>Nombre permiso</th>
                                             <th>Asignar</th>
                                             <th>Quitar</th>
                                             </tr>
             
                                     </thead>
                                     
                                             <tbody>
                                  
                                     @foreach($permissions as $permission)
                                             <tr>
                                             <td><input type="checkbox" disabled
                                                    @foreach($role->permissions as $role_permission)
                                                    @if($role_permission->slug == $permission->slug)
                                                            checked
                                                    @endif
                                                    @endforeach
                                            
                                            ></td>
                                    
                                             <td>{{$permission->name}}</td>
                                       
                                             <td>
                                             
                                             <form method="post" action="{{route('permission.role.attach',$role)}}">
                                                     @method('PUT')
                                                     @csrf 
                                                     <input type="hidden" name="permission" value="{{$permission->id}}">
                                             <button class="btn btn-success btn-circle" @if($role->permissions->contains($permission))
                                disabled
                                @endif> <i class="fas fa-check"></i></button>
                                             </form>
                                     
                                     
                                             </td>
                                             <td>
                                             
                                             <form method="post" action="{{route('permission.role.detach',$role)}}">
                                                     @method('PUT')
                                                     @csrf 
                                                     <input type="hidden" name="permission" value="{{$permission->id}}">
                                             <button class="btn btn-danger btn-circle" @if(!$role->permissions->contains($permission) || $role->name==('Admin'))
                                disabled
                                @endif><i class="fas fa-trash"></i></button>
                                             </form>
                                     
                                             </td>
                                             </tr>
                                  @endforeach
                                             </tbody>
                                     </table>
                                     </div>
                             </div>
                             </div>
</div>
@endif


@endsection
</x-admin>