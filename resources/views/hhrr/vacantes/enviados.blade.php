<x-admin>

@section('content')
@if(session('vacanteaviso-eliminado'))
            <div class="alert alert-danger">{{session('vacanteaviso-eliminado')}}</div>
    @endif


<div class="form-group row">
  <a href="{{route('hhrr.vacantes.enviaraviso')}}">Enviar notificación vacante interna</a>
</div>

        <h1>Anuncios enviados:</h1><br>


<div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
    
                    <th>Departamento</th>
                    <th>Puesto de trabajo</th>
                    <th>Explicación</th>
                    <th>Status</th>
                    <th>Acciones</th>
                 
                </tr>

           </thead>
                <tfoot>
            
                </tfoot>
                <tbody>

                @if($vacantesInternos)
                @foreach($vacantesInternos as $vacanteInterno)
                <tr>
                    <td>{{$vacanteInterno->department->name}}</td>
                    <td>{{$vacanteInterno->job->name}}</td>
                    <td><a href="{{route('vacantes.internos.edit', $vacanteInterno->id)}}">{{Str::limit($vacanteInterno->explicacion,'50','... click para ver más')}}</a></td>
                  <td>
                  @if($vacanteInterno->status === 1)
                    Activo
                    @elseif($vacanteInterno->status === 2)
                    Inactivo
                    @else 
                    Activo
                    @endif

                  </td>
                    <td>
                    <form method="post" action="{{route('vacanteinterno.activar', $vacanteInterno->id)}}">
                    @csrf
                       @method('PUT')
                            <button class="btn btn-success form-group">Activar</button>

                    </form>
                    <form method="post" action="{{route('vacanteinterno.inactivar', $vacanteInterno->id)}}">
                    @csrf
                       @method('PUT')
                            <button class="btn btn-danger form-group">Inactivar</button>

                    </form>
                    </td>
                  
                   
                </tr>
                 
                @endforeach
                @endif
                </tbody>
            </table>
        </div>

@endsection


</x-admin>