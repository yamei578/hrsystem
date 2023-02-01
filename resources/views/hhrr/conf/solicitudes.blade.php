<x-admin>

@section('content')

<h1>Solicitudes</h1>
@if(session('solicitudTipo-deleted'))
            <div class="alert alert-danger">{{session('solicitudTipo-deleted')}}</div>
@endif
@if(session('solicitudTipo-added'))
            <div class="alert alert-success">{{session('solicitudTipo-added')}}</div>
@endif

<div class="row">
        <div class="col-sm-3">
            <form method="post" action="{{route('tipo.solicitudes.store')}}">
                @csrf 

                <div class="form-group">
                    <label for="name">Nombre de solicitud</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name">
                    <div>
                        @error('name')
                        <span><strong>{{$message}}</strong></span>
                        @enderror
                    </div>

                </div>
                <div class="form-group">
                    <label for="codigo">Código</label>
                    <input class="form-control @error('codigo') is-invalid @enderror" type="text" name="codigo" >
                    <div>
                        @error('codigo')
                        <span><strong>{{$message}}</strong></span>
                        @enderror
                    </div>

                </div>
                <button type="submit" class="btn btn-primary btn-block">Crear</button><br>

            </form>
        </div>

        <div class="col-sm-12">
        <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tipos de solicitudes</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                   
                    <th>Nombre</th>
                    <th>Código</th>
                    <td>Acciones</td>
                </tr>

           </thead>
                <tfoot>
            
                </tfoot>
                <tbody>
                @foreach($solicitudes as $solicitud)

                <tr>
                   
                    <td><a href="{{route('confsolicitudes.edit', $solicitud->id)}}">{{$solicitud->name}}</a></td>
            
                    <td>{{$solicitud->codigo}}</td>
                    
                    <td>
                 
                    <!-- Inicio Button trigger modal -->

                        <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteModal_{{$solicitud->id}}" 
                        @if($solicitud->codigo == 01 || $solicitud->codigo == 02 || $solicitud->codigo == 03 || $solicitud->codigo == 04 || $solicitud->codigo == 05) disabled @endif
                        ><i class="fas fa-trash"></i></button>
                            <!-- Modal -->
                            <div id="deleteModal_{{$solicitud->id}}" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Confirmación</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            ¿Está seguro que desea eliminar {{$solicitud->name}}?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                    <form method="post" action="{{route('tiposolicitudes.destroy', $solicitud->id)}}">
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

    </div>

   


   
@endsection 



</x-admin>
