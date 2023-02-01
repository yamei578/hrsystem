@extends('components.admin')


@section('content')


<form>
<div class="form-group row">
  <a href="{{route('hhrr.solicitudes.create')}}">Mandar solicitud</a>
</form>
</div>
<br>

<h4 class="h3 mb-0 text-gray-800">Mis solicitudes:</h4>
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
                    <th>Explicación</th>
                    <th>Status</th>
                 
                </tr>

           </thead>
                <tfoot>
            
                </tfoot>
                <tbody>

                @if($solicitudesColaboradores)
                @foreach($solicitudesColaboradores as $solicitudColaborador)

                <tr>
                    <td>{{$solicitudColaborador->solicitud->name}}</td>
                    <td>
                    {{ $solicitudColaborador->fecha_desde->format('Y-m-d') }}
                   
                
                    </td>
                    <td>{{$solicitudColaborador->fecha_hasta}}</td>
                    <td>{{$solicitudColaborador->explicacion}}</td>
                    <td>
                    @if($solicitudColaborador->status === 1)
                    Aprobado
                    @elseif($solicitudColaborador->status === 2)
                    Rechazado
                    @else 
                    Pendiente acción
                   @endif
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
 


