<x-admin>

@section('content')

<h1>Aplicantes externos nuevos:</h1><br>

@if(session('externo-eliminado'))
            <div class="alert alert-danger">{{session('externo-eliminado')}}</div>
@endif



<div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Puesto al que aplica</th>
                    <th>Correo Electrónico</th>
                    <th>Teléfono</th>
                    <th>Estado proceso</th>
                    <th>Acciones</th>
                 
                </tr>

           </thead>
                <tfoot>
            
                </tfoot>
                <tbody>
                @foreach($externos as $externo)
            
                <tr>
                
                    <td><a href="{{route('externos.edit', $externo)}}">{{$externo->nombre}}</a></td>
                    <td>{{$externo->job->name}}</td>
                    <td>{{$externo->email_personal}}</td>
                    <td>{{$externo->numero}}</td>
                    <td>
                    @if($externo->proceso_status === 0) 
                        Aplicante nuevo
                        @elseif($externo->proceso_status === 1)
                        Contactado
                    @else
                        Entrevistado     
                    @endif

                    </td>
                    <td>
                    <div class="form-group row">
                        <div class="col-3">
                           

                             <!-- Inicio Button rechazar trigger modal -->

                        <button type="button" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#deleteVacante_{{$externo->id}}"><i class="fas fa-trash"></i></button>
                                    <!-- Modal -->
                                    <div id="deleteVacante_{{$externo->id}}" class="modal fade" role="dialog">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="deleteModalLabel">Confirmación</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                    ¿Está seguro que desea eliminar al vacante {{$externo->nombre}}?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                        <form method="post" action="{{route('externos.destroy', $externo->id)}}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                                <button class="btn btn-danger">Eliminar vacante</button>
                                                                            </form>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                    </div>


                                    <!-- fin Button rechazar modal -->


                        </div>
                       

                   
                    </div>
                   
                    </td>
                 
                   
                </tr>
                 
                @endforeach
                </tbody>
            </table>
        </div>


@endsection 


</x-admin>