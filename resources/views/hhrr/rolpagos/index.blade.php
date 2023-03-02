

<x-admin>



@section('content')

        <div class="row">
          
        <div class="col-sm-12">
     
        <div class="toolbar hidden-print">
                    <div class="text-end">
                    <a href="{{route('descargarPDF')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generar Reporte PDF</a>
                     
                    </div>
                    <hr>
        </div>
        <div class="card shadow mb-4">
            
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Reporte Costo Empleado</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Colaborador</th>
                    <th>Salario</th>
                    <th>Aporte Patronal</th>
                    <th>Fondo de Reserva</th>
                    <th>Costo Total</th>
                </tr>

           </thead>
                <tfoot>
            
                </tfoot>
                <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>${{number_format(($user->salario), 2)}}</td>
                
                    <td>${{ number_format($payslipAportePatronal = (($user->salario)*$payroll_aporte_patronal), 2) }}</td>
                    <td>${{ number_format($payslipFondoReserva = (($user->salario)*$payroll_fondo_reserva), 2) }}</td>
        
                    <td>${{ number_format($total = (($user->salario)-$payslipAportePatronal-$payslipFondoReserva), 2) }}</td>
                    
                  
            
                </tr>
        

                @endforeach
                </tbody>
                <tr>
               
                    <td><p><strong>TOTAL</strong></p></td>
                    
                    <td>
                        
                    <p><strong>
                   
                    ${{$salariosTotales}}
            
                    </strong></p>
                
                    </td>

                   
                    <td>
                        
                        <p><strong>
                        ${{$payslipIessAporteTotal}}
                       
                
                        </strong></p>
                    
                    </td>
                    <td>
                        
                        <p><strong>
                       
                        ${{$payslipIessFondoTotal}}
                
                        </strong></p>
                    
                    </td>

                    <td>
                        
                        <p><strong>
                       
                        ${{number_format($totalSalarios, 2)}}
                
                        </strong></p>
                    
                    </td>


               
                </tr>
            </table>
        </div>
        </div>
     
          
        </div>

       




@endsection





</x-admin>
