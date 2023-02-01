<x-admin>

@section('content')




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
                    <th>Acciones</th>
                </tr>

           </thead>
                <tfoot>
            
                </tfoot>
               <!-- {{$vacanteInterna}} -->
                <tbody>
                   @if($vacanteInterna)
                   @foreach($vacanteInterna as $vacantes)
                   @foreach($vacantes->users as $users_vacantes) 
                        <tr>
                      
                            <td>
                              
                                {{$users_vacantes->name}}
                           
                            </td>
                            <td>
                                {{$users_vacantes->job->name}}
                            </td>
                            <td>
                                {{$users_vacantes->department->name}}
                            </td>

                            <td>
                    <div class="form-group row">
                        <div class="col-3">
                            <form method="post" action="">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Está seguro que desea eliminar este aplicante?');"><i class="fas fa-trash"></i></button>

                            </form>
                        </div>  

                   
</div>

         
                    </td>
                        
                        @endforeach
                    @endforeach
                   @endif
                   
                </tbody>
            </table>
        </div>
    </div>
</div>




@endsection


</x-admin>