@extends('components.admin')


@section('content')

@if(session('department-added'))
            <div class="alert alert-success">{{session('department-added')}}</div>
@endif


<div class="col-sm-3">
            <form method="post" action="{{route('department.store')}}">
                @csrf 

                <div class="form-group">
                    <label for="name">Nombre departamento</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name">
                    <div>
                        @error('name')
                        <span><strong>{{$message}}</strong></span>
                        @enderror
                    </div>

                </div>
                <div class="form-group">
               
                    <label for="">Supervisor/Jefe:</label>
                    <select class="form-control" name="user_id" id="user_id" required>
                        <option value="" disabled selected>Seleccionar</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}"> {{ $user->name }}
                            @endforeach
                        </select>
             
                </div>
                <button type="submit" class="btn btn-primary btn-block">Agregar</button>

            </form>
        </div>

<br>

<h4 class="h3 mb-0 text-gray-800">Departamentos:</h4>
@if(session('department-deleted'))
            <div class="alert alert-danger">{{session('department-deleted')}}</div>
    @endif
<br>

<div class="col-sm-12">
        <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Información departamentos</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Departamento</th>
                    <th>Supervisor</th>
                    <th>Acciones</th>
                </tr>

           </thead>
                <tfoot>
            
                </tfoot>
                <tbody>


                @foreach($departments as $department)
                
                <tr>
                    <td>{{$department->id}}</td>
                    <td><a href="{{route('departments.edit', $department->id)}}">{{$department->name}}</a></td>
                
                    <td>
                    @if($department->user)
                    {{$department->user->name}}
                    @endif
                    </td>
               
                    <td>


                        <!-- Inicio Button trigger modal -->

                        <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteDepartment_{{$department->id}}"><i class="fas fa-trash"></i></button>
                            <!-- Modal -->
                            <div id="deleteDepartment_{{$department->id}}" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModal2Label">Confirmación</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            ¿Está seguro que desea eliminar {{$department->name}}?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <form method="post" action="{{route('department.destroy', $department->id)}}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                        <button class="btn btn-danger">Eliminar</button>
                                                                </form>
                                                            </div>
                                                            </div>
                                                        </div>
                            </div>


                            <!-- fin Button trigger modal -->


                    </td>
            
            
                </tr>
                @endforeach 
                </tbody>
            </table>
        </div>
    </div>
</div>
        </div>

@endsection
 


