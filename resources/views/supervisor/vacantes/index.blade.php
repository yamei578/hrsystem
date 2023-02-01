<x-admin>

@section('content')



<div class="col-sm-12">
        <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Vacantes disponibles</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Departamento</th>
                    <th>Puesto de trabajo</th>
                    <th>Explicación</th>
                    <th>Estado</th>
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
                <td><a href="{{route('vacante.interno.aplicar', $vacanteInterno->id)}}">{{$vacanteInterno->explicacion}}</a></td>
                    <td>{{$vacanteInterno->status}}</td>
            <td>Aplicar</td>
            
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