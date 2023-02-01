<x-admin>

@section('content')

<h1>Tipo de Marcaciones</h1>

@if(session('marcacionTipo-deleted'))
            <div class="alert alert-danger">{{session('marcacionTipo-deleted')}}</div>
@endif
@if(session('marcacionType-added'))
            <div class="alert alert-success">{{session('marcacionType-added')}}</div>
@endif


<div class="row">
        <div class="col-sm-3">
            <form method="post" action="{{route('tipo.marcaciones.store')}}">
                @csrf 

                <div class="form-group">
                    <label for="name">Marcación nombre</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name">
                    <div>
                        @error('name')
                        <span><strong>{{$message}}</strong></span>
                        @enderror
                    </div>

                </div>
                <div class="form-group">
                    <label for="name">Código</label>
                    <input class="form-control @error('codigo') is-invalid @enderror" type="text" name="codigo" >
                    <div>
                        @error('name')
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
        <h6 class="m-0 font-weight-bold text-primary">Marcaciones</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
            
                   
                    <th>Tipo Marcacion</th>
                    <th>Código</th>
                    <td>Acciones</td>
                </tr>

           </thead>
                <tfoot>
            
                </tfoot>
                <tbody>
             
                @foreach($marcaciones as $marcacion)

                <tr>
                 
                    <td><a href="{{route('confmarcaciones.edit', $marcacion->id)}}">{{$marcacion->name}}</a></td>
                    <td>{{$marcacion->codigo}}</td> 
                    <td>
                
<!-- Inicio Button trigger modal -->

                    <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteModal_{{$marcacion->id}}" 
                        @if($marcacion->codigo == 1 || $marcacion->codigo == 2 || $marcacion->codigo == 3 || $marcacion->codigo == 4 || $marcacion->codigo == 5 || $marcacion->codigo == 6) disabled @endif
                        ><i class="fas fa-trash"></i></button>
                            <!-- Modal -->
                            <div id="deleteModal_{{$marcacion->id}}" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Confirmación</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            ¿Está seguro que desea eliminar {{$marcacion->name}}?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <form method="post" action="{{route('tipomarcaciones.destroy', $marcacion->id)}}">
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