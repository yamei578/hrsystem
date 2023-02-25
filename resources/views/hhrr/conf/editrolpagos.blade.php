
<x-admin>

@section('content')
@if(session('parametro-actualizado'))
            <div class="alert alert-success">{{session('parametro-actualizado')}}</div>
    @endif



<div class="container">
<h1>Editar Parámetros rol de pagos</h1>
    <div class="col-sm-6">


    <form method="post" action="{{route('rolpagos.update', $payrolls->id)}}">
        @csrf 
        @method('PUT')

        <div class="form-group">
            <label for="name">IESS</label>
            <input type="text" class="form-control" name="iess" value="{{$payrolls->iess}}" required>
        </div>
        <div class="form-group">
            <label for="name">Horas Suplementarias</label>
            <input type="text" class="form-control" name="horas_extras"  value="{{number_format($payrolls->horas_extras,2)}}" required>
        </div>
        <div class="form-group">
            <label for="name">Horas Extras</label>
            <input type="text" class="form-control" name="horas_feriados"  value="{{number_format($payrolls->horas_feriados,2)}}" required>
        </div>

        <button class="btn btn-primary">Actualizar</button>

    </form>

    </div>

</div><br>




<div class="container">
<h1>Impuesto a la renta</h1><br>
<form>
  <div class="form-row">
    <div class="col-3">
      <input type="text" class="form-control" placeholder="Fracción Básica">
    </div>
    <div class="col-3">
      <input type="text" class="form-control" placeholder="Exceso Hasta">
    </div>
    <div class="col-3">
      <input type="text" class="form-control" placeholder="Impuesto Fracción Básica">
    </div>
    <div class="col-3">
      <input type="text" class="form-control" placeholder="Impuesto Fracción Excedente %"><br>
    </div>
   
    <div class="container">
        <button class="btn btn-primary">Agregar</button>
    </div>
    
  

</form>
</div>

</div><br>


<div class="container">
     

     <div class="card shadow mb-4">
         
 <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary">Tabla para pago del Impuesto a la Renta</h6>
 </div>
 <div class="card-body">
     <div class="table-responsive">
         <table class="table table-bordered" id="impuestos" width="100%" cellspacing="0">
             <thead>
             <tr>
                 <th>Fracción Básica</th>
                 <th>Exceso hasta</th>
                 <th>Impuesto Fracción Básica</th>
                 <th>Impuesto Fracción Excedente</th>
                 <th>Acciones</th>
             </tr>

        </thead>
             <tfoot>
         
             </tfoot>
             <tbody>
               
             <tr>
                 <td>
                 </td>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td>
                    <!-- Inicio Button trigger modal -->

                    <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target=""><i class="fas fa-trash"></i></button>
                         <!-- Modal -->
                         <div id="" class="modal fade" role="dialog">
                                                     <div class="modal-dialog">
                                                         <div class="modal-content">
                                                         <div class="modal-header">
                                                             <h5 class="modal-title" id="deleteModalLabel">Confirmación</h5>
                                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                             <span aria-hidden="true">&times;</span>
                                                             </button>
                                                         </div>
                                                         <div class="modal-body">
                                                         ¿Está seguro que desea eliminar el rol del mes/año ?
                                                         </div>
                                                         <div class="modal-footer">
                                                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                             <form method="post" action="">
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
     

         
             </tbody>
          
         </table>
     </div>
     </div>

@endsection 
</x-admin>