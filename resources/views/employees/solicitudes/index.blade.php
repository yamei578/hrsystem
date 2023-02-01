@extends('components.admin')


@section('content')


<form>
<div class="form-group row">
  <a href="{{route('hhrr.solicitudes.create')}}">Mandar solicitud</a>
</form>
</div>
<br>


@if(session('solicitud-deleted'))
            <div class="alert alert-danger">{{session('solicitud-deleted')}}</div>
    @endif

<h4 class="h3 mb-0 text-gray-800">Mis solicitudes:</h4><br>
<p>Una vez aprobada o rechazada la solicitud por RRHH, esta no podrá ser retirada. En caso de necesitar atención, contactar a talentohumano@empresaXYZ.com</p>
<br>

<div class="col-sm-12">
        <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Solicitudes</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Tipo de solicitud</th>
                    <th>Fecha desde</th>
                    <th>Fecha hasta</th>
                    <th>Motivo</th>
                    <th>Monto</th>
                    <th>Gestionado por supervisor</th>
                    <th>Gestionado por RRHH</th>
                    <th>Acciones</th>

                 
                </tr>

           </thead>
                <tfoot>
            
                </tfoot>
                <tbody>

                @if($solicitudesColaboradores)
                @foreach($solicitudesColaboradores as $solicitudColaborador)

                <tr>
                    <td>
                        
                        <a href="{{route('colaborador.solicitud.edit', $solicitudColaborador->id)}}">{{$solicitudColaborador->solicitud->name}}</a>
                    </td>
                    <td>{{Carbon\Carbon::parse($solicitudColaborador->fecha_desde)->format('Y-m-d')}}</td>
                    <td>{{Carbon\Carbon::parse($solicitudColaborador->fecha_hasta)->format('Y-m-d')}}</td>
                    <td>{{$solicitudColaborador->explicacion}}</td>
                    <td>{{$solicitudColaborador->monto}}</td>
                    <td>
                    @if($solicitudColaborador->onlyrrhh === 0)
                        @if($solicitudColaborador->status === 1)
                            Aprobado
                        @elseif($solicitudColaborador->status === 2)
                            Rechazado
                        @else 
                            Pendiente acción
                        @endif
                    @endif

                    </td>
                    
                    <td>
                    @if($solicitudColaborador->onlyrrhh === 0)
                        @if($solicitudColaborador->status === 1)
                                @if($solicitudColaborador->statusrrhh === 1)
                                    Aprobado
                                @elseif($solicitudColaborador->statusrrhh === 2)
                                    Rechazado
                                @else 
                                    Pendiente acción
                                @endif
                        @else 
                                Si tu solicitud fue rechazada por tu supervisor o está pendiente de revisión, no podemos gestionarla.
                        @endif
                    @elseif($solicitudColaborador->statusrrhh === 1)
                        Aprobado 
                    @elseif($solicitudColaborador->statusrrhh === 2)
                        Rechazado
                    @else
                        Pendiente acción 
                    @endif
                    </td>
                    <td>
                       

   <!-- Inicio Button trigger modal -->

                        <button type="button" class="btn btn-danger btn-circle" 
                        data-toggle="modal" data-target="#deleteSol_{{$solicitudColaborador->id}} " 
        
                        @if ($solicitudColaborador->statusrrhh === 1 || $solicitudColaborador->statusrrhh === 2) disabled @endif><i class="fas fa-trash"></i></button>
                            <!-- Modal -->
                            <div id="deleteSol_{{$solicitudColaborador->id}}" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Confirmación</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            ¿Está seguro que desea eliminar su solicitud de tipo: {{$solicitudColaborador->solicitud->name}}?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <form method="post" action="{{route('solicitud.destroy', $solicitudColaborador->id)}}">
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
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
        </div>

@endsection
 


