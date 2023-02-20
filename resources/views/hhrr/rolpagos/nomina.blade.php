

<x-admin>

@section('content')


@if(session('mes-anio-agregado'))
            <div class="alert alert-success">{{session('mes-anio-agregado')}}</div>
@endif
@if(session('eliminado'))
            <div class="alert alert-danger">{{session('eliminado')}}</div>
@endif
<h1>Reporte de Nómina por Mes</h1>
<p>Debes escribir en formato mes y año: mm-yyyy</p>
<p>Ejemplo: 09-2023</p>
        <div class="row">
  
        <div class="col-sm-3">
            <form method="post" action="{{route('mesanio.store')}}">
                @csrf 

                <div class="form-group">
                    <label for="name">Mes/Año:</label>
                    <input class="form-control @error('mes_anio') is-invalid @enderror" type="text" name="mes_anio" placeholder="mm-yyyy">
                    <div>
                        @error('mes_anio')
                        <span><strong>{{$message}}</strong></span>
                        @enderror
                    </div>

                </div>
                <button type="submit" class="btn btn-primary btn-block">Agregar</button><br>

            </form>
        </div>
          
        <div class="col-sm-12">
     

        <div class="card shadow mb-4">
            
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">SUELDOS COLABORADORES CON VARIACIONES</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Mes/Año</th>
                    <th>Acciones</th>
                </tr>

           </thead>
                <tfoot>
            
                </tfoot>
                <tbody>
                    @foreach($monthYear as $payroll)
                <tr>
                    <td>

                        <a href="{{route('payroll.result', $payroll->id)}}" target="_blank">{{$payroll->mes_anio}}</a>

                    </td>
                    <td>
                       <!-- Inicio Button trigger modal -->

                       <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteModal_{{$payroll->id}}"><i class="fas fa-trash"></i></button>
                            <!-- Modal -->
                            <div id="deleteModal_{{$payroll->id}}" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Confirmación</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            ¿Está seguro que desea eliminar el rol del mes/año {{$payroll->mes_anio}} ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <form method="post" action="{{route('monthyear.destroy', $payroll->id)}}">
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



@endsection


</x-admin>
