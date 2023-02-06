<x-admin>

@section('content')


@if(session('vacante-detached'))
            <div class="alert alert-danger">{{session('vacante-detached')}}</div>
@endif

<h1>Aplicantes internos nuevos:</h1><br>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Aplicantes internos nuevos</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Nombre colaborador</th>
                    <th>Puesto al que aplica</th>
                    <th>Departamento al que aplica</th>
                 
                </tr>

           </thead>
                <tfoot>
            
                </tfoot>
                
                <tbody>
                @foreach($vacancy as $interna)
                @foreach($interna->vacantes as $users)
                 
                        <tr>
                            <td>
                        {{$interna->name}}
                            </td>
                            <td>
                            {{$users->job->name}}
                            </td>
                            <td>
                           
                    {{$users->department->name}}
                                
                            </td>
             
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>




@endsection


</x-admin>