@extends('components.admin')


@section('content')




<div class="col-sm-3">
            <form method="post" action="{{route('puestostrabajo.store')}}">
                @csrf 

                <div class="form-group">
                    <label for="name">Nombre puesto de trabajo</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name">
                    <div>
                        @error('name')
                        <span><strong>{{$message}}</strong></span>
                        @enderror
                    </div>

                </div>
             
                <button type="submit" class="btn btn-primary btn-block">Agregar</button>

            </form>
        </div>

<br>

<h4 class="h3 mb-0 text-gray-800">Puestos de trabajo:</h4>
@if(session('job-deleted'))
            <div class="alert alert-danger">{{session('job-deleted')}}</div>
@endif
@if(session('job-added'))
            <div class="alert alert-success">{{session('job-added')}}</div>
@endif
<br>

<div class="col-sm-12">
        <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Información puestos de trabajo</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Puesto de trabajo</th>
                
                    <th>Departamento</th>
                    <th>Acciones</th>
                </tr>

           </thead>
                <tfoot>
            
                </tfoot>
                <tbody>

                @foreach($jobs as $job)

                <tr>
                    <td>{{$job->id}}</td>
                    <td><a href="{{route('puestostrabajo.edit', $job->id)}}">{{$job->name}}</a></td>
                  
                    <td>
                    @foreach($job->departments as $department_job)    
                    {{$department_job->name}}
                    @endforeach
                    </td>
                    <td>

            

                        <!-- Inicio Button trigger modal -->

                        <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deletePuesto_{{$job->id}}"><i class="fas fa-trash"></i></button>
                            <!-- Modal -->
                            <div id="deletePuesto_{{$job->id}}" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModal2Label">Confirmación</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            ¿Está seguro que desea eliminar {{$job->name}}?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <form method="post" action="{{route('puestostrabajo.destroy', $job->id)}}">
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
 


