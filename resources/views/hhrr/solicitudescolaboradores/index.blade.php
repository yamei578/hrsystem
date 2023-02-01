<x-admin>



@section('content')


<br>

<h4 class="h3 mb-0 text-gray-800">Solicitudes Colaboradores:</h4>


<br>

<div class="col-sm-12">
        <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Solicitudes</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="solsColabs" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Colaborador</th>
                    <th>Fecha solicitud</th>
                    <th>Tipo de Solicitud</th>
                    <th>Fecha desde</th>
                    <th>Fecha hasta</th>
                    <th>Motivo</th>
                    <th>Monto</th>
                    <th>Gestionado por supervisor</th>
                    <th>Gestionado por RRHH</th>
                    <th>Acción</th>
                 
                </tr>

           </thead>
                <tfoot>
            
                </tfoot>
                <tbody>

                @if($solicitudesColaboradores)
                @foreach($solicitudesColaboradores as $solicitudColaboradores)

                <tr>
                   
                    <td>{{$solicitudColaboradores->user->name}}</td>
                    <td>{{$solicitudColaboradores->fecha_solicitud}}</td>
                    <td>
                    <a href="{{route('hhrr.solicitud.view', $solicitudColaboradores->id)}}">{{$solicitudColaboradores->solicitud->name}}</a>
                    </td>
                    <td>{{$solicitudColaboradores->fecha_desde}}</td>
                    <td>{{$solicitudColaboradores->fecha_hasta}}</td>
                    <td>{{$solicitudColaboradores->explicacion}}</td>
                    <td>{{$solicitudColaboradores->monto}}</td>
                    <td>
                    @if($solicitudColaboradores->onlyrrhh === 0) 
                        @if($solicitudColaboradores->status === 1)
                            Aprobado
                        @elseif($solicitudColaboradores->status === 2)
                            Rechazado
                        @else 
                            Pendiente acción
                        @endif
                    @endif
            
                    </td>
                    <td @if(($solicitudColaboradores->status == 1 || $solicitudColaboradores->status == 0) && $solicitudColaboradores->statusrrhh === 0) style="background-color: #FCFCE5" @endif>
                    @if($solicitudColaboradores->onlyrrhh === 0)
                        @if($solicitudColaboradores->status === 1)
                                @if($solicitudColaboradores->statusrrhh === 1)
                                    Aprobado
                                @elseif($solicitudColaboradores->statusrrhh === 2)
                                    Rechazado
                                @else 
                                    Pendiente acción
                                @endif
                        @else 
                            Solicitud rechazada o pendiente de gestionar por supervisor. No se puede gestionar.
                    @endif 
                    @elseif($solicitudColaboradores->statusrrhh === 1)
                        Aprobado 
                    @elseif($solicitudColaboradores->statusrrhh === 2)
                        Rechazado
                    @else 
                        Pendiente acción
                        
                    @endif
                    </td>
                    <td>
                        


                <!-- Inicio Button aprobar trigger modal -->

                        <button type="button" class="btn btn-success btn-circle btn-sm" data-toggle="modal" data-target="#aprobarSolicitud_{{$solicitudColaboradores->id}}" 
                       @if(($solicitudColaboradores->status == 2 || $solicitudColaboradores->statusrrhh == 1 || $solicitudColaboradores->status == 0) && $solicitudColaboradores->onlyrrhh == 0) disabled @endif
                        >
                        <i class="fas fa-check"></i></button>
                            <!-- Modal -->
                            <div id="aprobarSolicitud_{{$solicitudColaboradores->id}}" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Confirmación</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            ¿Está seguro que desea aprobar la solicitud del colaborador: {{$solicitudColaboradores->user->name}}. Tipo: {{$solicitudColaboradores->solicitud->name}}?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <form method="post" action="{{route('hhrr.solicitud.colaborador.aprobar', $solicitudColaboradores->id)}}">
                                                                @csrf
                                                                @method('PUT')
                                                                <button class="btn btn-info form-group">Aprobar</button>
                                                                </form>
                                                            </div>
                                                            </div>
                                                        </div>
                            </div>


                            <!-- fin Button aprobar modal -->


                    </form>


                        <!-- Inicio Button rechazar trigger modal -->

                        <button type="button" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#rechazarSolicitud_{{$solicitudColaboradores->id}}" 
                        @if(($solicitudColaboradores->status == 2 || $solicitudColaboradores->status == 0 || $solicitudColaboradores->statusrrhh == 2) && $solicitudColaboradores->onlyrrhh == 0) disabled @endif
                        >
                        <i class="fas fa-trash"></i></button>
                            <!-- Modal -->
                            <div id="rechazarSolicitud_{{$solicitudColaboradores->id}}" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Confirmación</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            ¿Está seguro que desea rechazar la solicitud del colaborador: {{$solicitudColaboradores->user->name}}. Tipo: {{$solicitudColaboradores->solicitud->name}}?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <form method="post" action="{{route('hhrr.solicitud.colaborador.rechazar', $solicitudColaboradores->id)}}">
                                                                @csrf
                                                                @method('PUT')
                                                                <button class="btn btn-info form-group">Confirmar</button>
                                                                </form>
                                                            </div>
                                                            </div>
                                                        </div>
                            </div>


                            <!-- fin Button aprobar modal -->




                    </td>



                </tr>

                @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
        </div>

@endsection


</x-admin>