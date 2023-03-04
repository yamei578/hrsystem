

<x-admin>

@section('content')


<h1>Reporte de Nómina: {{$payroll->mes_anio}}</h1>
@if(!$payslip->isEmpty())
        <div class="row">
          
        <div class="col-sm-12">
     
        <div class="toolbar hidden-print">
                    <div class="text-end">
                    <a href="{{route('descargarPDFNomina', $payroll)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generar Reporte PDF</a>
                     
                    </div>
                    <hr>
        </div>
        <div class="card shadow mb-4">
            
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">SUELDOS COLABORADORES CON VARIACIONES</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Colaborador</th>
                    <th>Sueldo Ganado</th>
                    <th>Valor Horas Extras</th>
                    <th>Comisión</th>
                    <th>Total Ingresos</th>
                    <th>Aporte IESS</th>
                    <th>Impuesto a la Renta</th>
                    <th>Prestamos Qui.</th>
                    <th>Anticipos/Prestamos</th>
                    <th>Total descuentos</th>
                    <th>Líquido a pagar</th>
               
                </tr>

           </thead>
                <tfoot>
            
                </tfoot>
                <tbody>
                   
                    @foreach($payslip as $payroll)
                <tr>
                    
                    <td>{{$payroll->nombre}}</td>
                    <td>{{$payroll->sueldo_ganado}}</td>
                  
                    <td>{{$payroll->valor_horas_extras}}</td>
                    <td>{{$payroll->comision}}</td>
                    <td>{{$payroll->total_ingresos}}</td>
                    <td>{{$payroll->aporte_iess}}</td>
                    <td>{{$payroll->aporte_patronal}}</td>
                    <td>{{$payroll->prestamos_quirografarios}}</td>
                    <td>{{$payroll->anticipos_prestamos}}</td>
                    <td>{{$payroll->total_descuentos}}</td>
                    <td>{{$payroll->liquido_pagar}}</td>
                    
                  
            
                </tr>

              

                @endforeach
              
                </tbody>
                <tr>
               
                    <td><p><strong>TOTAL</strong></p></td>
                    
                    <td>
                    @foreach($sueldoGanado as $sueldo)
                        <p><strong>
                    
                            ${{number_format($sueldo->sueldo_ganado,2)}}
                
                        </strong></p>
                    @endforeach
                    </td>

                    <td>
                     @foreach($valorHorasExtras as $horasExtras)
                        <p><strong>
                       
                        ${{number_format($horasExtras->valor_horas_extras,2)}}
                
                        </strong></p>
                    
                        @endforeach
                    </td>
                    <td>
                    @foreach($comision as $comisionTotal)
                       
                    <p><strong>

                    ${{number_format($comisionTotal->comision,2)}}

                        </strong></p>

                    @endforeach
                    </td>
                    <td>
                     @foreach($totalIngresos as $total)
                        <p><strong>
                       
                        ${{number_format($total->total_ingresos,2)}}
                
                        </strong></p>
                    
                        @endforeach
                    </td>

                    <td>
                    @foreach($aporte as $iess)
                       
                    <p><strong>

                    ${{number_format($iess->aporte_iess,2)}}

                        </strong></p>

                    @endforeach
                    </td>
                    <td>
                    @foreach($aportePatronal as $patronal)
                       
                    <p><strong>

                    ${{number_format($patronal->aporte_patronal,2)}}

                        </strong></p>

                    @endforeach
                    </td>
                    <td>
                    @foreach($prestamos as $prest)
                       
                    <p><strong>

                    ${{number_format($prest->prestamos_quirografarios,2)}}

                        </strong></p>

                    @endforeach
                    </td>
                    <td>
                    @foreach($anticipos as $ant)
                       
                    <p><strong>

                    ${{number_format($ant->anticipos_prestamos,2)}}

                        </strong></p>

                    @endforeach
                    </td>

                    <td>
                    @foreach($totalDescuentos as $descuentos)
                        <p><strong>

                        ${{number_format($descuentos->total_descuentos,2)}}

                        </strong></p>
                        @endforeach
                    </td>

                    <td>
                    @foreach($liquido as $pagar)
                        <p><strong>

                        ${{number_format($pagar->liquido_pagar,2)}}

                        </strong></p>
                        @endforeach
                    </td>


                   
                </tr>
            </table>
        </div>
        </div>
     
          
        </div>

        @else 
            <h5>No se encontraron resultados. Deben existir roles generados.</h5>
        @endif


@endsection





</x-admin>
