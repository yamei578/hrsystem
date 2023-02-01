@extends('components.admin')


@section('content')


<form>
<div class="form-group row">
  <a href="{{route('hhrr.colaboradores.create')}}">Crear nuevo perfil de colaborador</a>
</form>
</div>
<br>

<h4 class="h3 mb-0 text-gray-800">Colaboradores:</h4>
<br>

<div class="col-sm-12">
        <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Información colaboradores</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Departamento</th>
                    <th>Cargo</th>
                    <th>Cédula de identidad</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>

           </thead>
                <tfoot>
            
                </tfoot>
                <tbody>

                @foreach($employees as $employee)

                <tr>
                    <td><a href="{{route('employee.edit', $employee->id)}}">{{$employee->nombre}}</a></td>
                    <td>{{$employee->department->name}}</td>
                    <td>
                    {{$employee->job->name}}
                    </td>
                
                    <td>{{$employee->employee_number}}</td>
                    <td>
                        @if($employee->status == 0)
                        Activo 
                        @else 
                        Inactivo
                        @endif
                    </td>
                    <td>
                        
                    <div class="form-row">
                            <div class="col-4">
                               
                                  <!-- Inicio Button activar trigger modal -->

                        <button type="button" class="btn btn-success btn-circle btn-sm" data-toggle="modal" data-target="#activateEmployee_{{$employee->id}}" @if ($employee->status == 0) disabled @endif><i class="fas fa-check"></i></button>
                            <!-- Modal -->
                            <div id="activateEmployee_{{$employee->id}}" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Confirmación</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            ¿Está seguro que desea activar {{$employee->nombre}}?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <form method="post" action="{{route('colaborador.activar', $employee->id)}}">
                                                                @csrf
                                                                @method('PUT')
                                                                        <button class="btn btn-success">Activar</button>
                                                                    </form>
                                                            </div>
                                                            </div>
                                                        </div>
                            </div>


                            <!-- fin Button trigger modal -->

                            </div>

                             <!-- Inicio Button inactivar trigger modal -->

                            <button type="button" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#inactiveEmployee_{{$employee->id}}" @if ($employee->status == 1) disabled @endif><i class="fas fa-trash"></i></button>
                                        <!-- Modal -->
                                        <div id="inactiveEmployee_{{$employee->id}}" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Confirmación</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            ¿Está seguro que desea inactivar {{$employee->nombre}}?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <form method="post" action="{{route('colaborador.inactivar', $employee->id)}}">
                                @csrf
                                @method('PUT')
                                                                        <button class="btn btn-danger">Inactivar</button>
                                                                    </form>
                                                            </div>
                                                            </div>
                                                        </div>
                                        </div>


                            <!-- fin Button trigger modal -->


                            </div>
                       
                       
                        </div>
                
                
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
 


