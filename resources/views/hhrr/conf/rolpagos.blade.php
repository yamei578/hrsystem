
<x-admin>

@section('content')

@if(session('impuesto-agregado'))
            <div class="alert alert-success">{{session('impuesto-agregado')}}</div>
@endif

@if($payrolls->isEmpty())
<div>

        <form method="POST" action="{{route('rolpagos.store')}}">
        @csrf 
        <div class="form-group">
          <div class="col-3">
          <label for="">IESS</label>
          <input class="form-control" type="text" name="iess">
          </div>
          <div class="col-3">
          <div class="col-3">
          <label for="">Horas Suplementarias</label>
        <input class="form-control" type="text" name="horas_extras"><br>
          </div>
          <label for="">Horas Extras</label>
        <input class="form-control" type="text" name="horas_feriados"><br>
          </div>

          
          <button type="submit" class="btn btn-info">GUARDAR</button>
         
        </div>

        </form>


</div>
@endif


<div class="container">
<h1> Parámetros rol de pagos</h1>
        <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Parámetros</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>IESS</th>
                    <th>Horas Suplementarias</th>
                    <th>Horas Extras</th>
                    <th>Acciones</th>
                </tr>

           </thead>
                <tfoot>
            
                </tfoot>
                <tbody>

                @foreach($payrolls as $payroll)

                <tr>
                <td><a href="{{route('rolpagos.edit', $payroll->id)}}">{{$payroll->id}}</a></td>
                    <td>{{number_format($payroll->iess*100,2)}}%</a></td>
                    <td>{{number_format($payroll->horas_extras,2)}}</td>
                    <td>{{number_format($payroll->horas_feriados,2)}}</td>
                   
                    <td>
                    <form method="post" action="{{route('rolpagos.destroy', $payroll->id)}}">
                            @csrf
                            @method('DELETE')
                       
                            <button class="btn btn-danger btn-circle" disabled><i class="fas fa-trash"></i></button>

                        </form>
                  
                    </td>
            
            
                </tr>
                    
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
        </div>

  
</div>

<div class="container">
<h1>Impuesto a la renta</h1><br>
    <form method="post" action="{{route('impuestos.store')}}">
    @csrf 
        <div class="form-row">
            <div class="col-3">
            <input type="text" class="form-control" placeholder="Fracción Básica" name="fraccion_basica">
            </div>
            <div class="col-3">
            <input type="text" class="form-control" placeholder="Exceso Hasta" name="exceso_hasta">
            </div>
            <div class="col-3">
            <input type="text" class="form-control" placeholder="Impuesto Fracción Básica" name="impuesto_fraccion_basica">
            </div>
            <div class="col-3">
            <input type="text" class="form-control" placeholder="Impuesto Fracción Excedente %" name="impuesto_fraccion_excedente"><br>
            </div>
        
            <div class="container">
                <p style="color:#FF0000;"><b>Impuesto Fracción Excedente (%) </b>escribirlo en formato decimal.</p>
                <p>Ejemplo: 0.05 para 5%.</p>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
            
  

    </form>
</div><br>

<div class="container">


    <div class="card shadow mb-4">
         
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Tabla para pago del Impuesto a la Renta</h6>
         </div>
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                     <tr>
                         <th>Fracción Básica</th>
                         <th>Exceso hasta</th>
                         <th>Impuesto Fracción Básica</th>
                         <th>Impuesto Fracción Excedente</th>
                     </tr>
        
                </thead>
                     <tfoot>
                 
                     </tfoot>
                     <tbody>
                     @if(!$impuestos->isEmpty())
                        @foreach($impuestos as $impuesto)
                       
                     <tr>
                     <td>{{number_format($impuesto->fraccion_basica,0)}}</td>
                     <td>{{number_format($impuesto->exceso_hasta,0)}}</td>
                     <td>{{number_format($impuesto->impuesto_fraccion_basica,0)}}</td>
                     <td>{{number_format($impuesto->impuesto_fraccion_excedente*100,2)}}%</td>
                 
                     </tr>
             
        
                    @endforeach
                    @endif
                     </tbody>
                  
                 </table>
             </div>


</div>



</div>

@endsection 
</x-admin>