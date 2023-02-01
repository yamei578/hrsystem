
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">


<style>
  body{
    font-family: Arial, Helvetica, sans-serif;
    line-height: 1.5;
    text-align: justify;

}



    th, td {
                padding: 8px;
                background-color:none;
            }



</style>

<body>



<!-- inicio template --> 


  
<div class="container mt-5 mb-5">


    <div class="row">
        <div class="col-md-12">
            <div class="text-center lh-1 mb-2">
                <h6 class="fw-bold">ROL DE PAGOS INDIVIDUAL</h6> <span class="fw-normal">{{$fechaLaboralCompleta}}</span>
            </div><br><br>
       
            <div class="row">
                <div class="col-md-10" style="padding:8px;">
                    <div class="row">
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">Nombre colaborador</span> <small class="ms-2">{{$nombre}}</small> </div>
                        </div>
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">Número de cédula</span> <small class="ms-2">{{$cedula}}</small> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">Fecha de ingreso</span> <small class="ms-2">{{$fecha_ingreso}}</small> </div>
                        </div>
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">Cargo</span> <small class="ms-2">{{$cargo}}</small> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div> <span class="fw-bolder">Días laborados</span> <small class="ms-2">{{$payslip->dias_laborados}}</small> </div>
                        </div>
                    </div>
                   
                </div>
                <table class="mt-4 table table-bordered" style="padding-right: 10px;">
                    <thead class="text-white" style="background-color: #1d2e54;">
                        <tr>
                            <th scope="col">Ingresos</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Descuentos</th>
                            <th scope="col">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Sueldo</th>
                            <td>${{$payslip->sueldo_ganado}}</td>
                            <th scope="row">Aporte IESS</th>
                            <td>${{$payslip->aporte_iess}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Horas sup.</th>
                            <td>{{$payslip->horas_suplementarias}}</td>
                            <th scope="row">Préstamos Quirogr. IESS</th>
                            <td>${{$payslip->prestamos_quirografarios}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Horas extras</th>
                            <td>{{$payslip->horas_extras}}</td>
                            <th scope="row">Prést. Y Antic. Empresa</th>
                            <td>${{$payslip->anticipos_prestamos}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Valor Horas extras</th>
                            <td>${{$payslip->valor_horas_extras}}</td>
                           
                        </tr>
                        <tr>
                            <th scope="row">Comisiones</th>
                            <td>${{$payslip->comision}}</td>
                           
                        </tr>
                       
                     
                    </tbody>
                    <tfoot class="text-white" style="background-color: #1d2e54;">
                <tr class="border-top">
                            <th scope="row">Total Ingresos</th>
                            <td class="fw-bolder">${{$payslip->total_ingresos}}</td>
                            <td class="fw-bolder">Total Descuentos</td>
                            <td class="fw-bolder">${{$payslip->total_descuentos}}</td>
                        </tr>
            </tfoot>
                </table>
           
            </div>
            <div class="row">
                
                <div class="col-md-4"> <br> <span class="fw-bold">TOTAL A RECIBIR: ${{$payslip->liquido_pagar}}</span> </div>
                
            </div>
         
        </div>
    </div>
</div>



</body>

