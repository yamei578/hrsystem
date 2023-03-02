<style>
 
body{
    font-family: Arial, Helvetica, sans-serif;
    line-height: 1.2;
    text-align: justify;
}
.table {
  width: 100%;
  margin-bottom: 1rem;
  color: #212529;
}

.table th,
.table td {
  padding: 0.75rem;
  vertical-align: top;
  border-top: 1px solid #dee2e6;
}

.table thead th {
  vertical-align: bottom;
  border-bottom: 2px solid #dee2e6;
}

.table tbody + tbody {
  border-top: 2px solid #dee2e6;
}

.table-sm th,
.table-sm td {
  padding: 0.3rem;
}

.table-bordered {
  border: 1px solid #dee2e6;
}

.table-bordered th,
.table-bordered td {
  border: 1px solid #dee2e6;
}

.table-bordered thead th,
.table-bordered thead td {
  border-bottom-width: 2px;
}

.table-borderless th,
.table-borderless td,
.table-borderless thead th,
.table-borderless tbody + tbody {
  border: 0;
}


</style>



<body>


    
<div class="row">
        <div class="col-sm-12">
      
    <div class="card-header py-3">

       <!-- <img src="/Users/yameilama/Desktop/vumi_hr_system/public/vumilatina_logo.png" alt="" width="200px" >-->
    <p>Tipo de reporte: Costo Empleado</p>
    <p>Fecha de reporte: {{$today}}</p>

    </div>

       

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
</body>

