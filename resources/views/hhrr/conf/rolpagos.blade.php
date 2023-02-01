
<x-admin>

@section('content')


<h1> Parámetros rol de pagos</h1>
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


<div class="col-sm-12">
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
                    <td>{{number_format($payroll->horas_extras*100,0)}}%</td>
                    <td>{{number_format($payroll->horas_feriados*100,0)}}%</td>
                   
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
</div>

@endsection 
</x-admin>