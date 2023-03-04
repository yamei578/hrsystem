
@extends('components.admin')
@section('content')
<meta name="_token" content="{{ csrf_token() }}"/>

<style>
    a:link {
        text-decoration: none;
    }


    a:visited {
        text-decoration: none;
    }


    a:hover {
        text-decoration: none;
    }


    a:active {
        text-decoration: none;
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    jQuery(function ($) {
        $(document).on('change', function () {


            var alimentacion = document.getElementById('alimentacion');
            var vivienda = document.getElementById('vivienda');
            var recreacion = document.getElementById('recreacion');
            var vestimenta = document.getElementById('vestimenta');
            var salud = document.getElementById('salud');
            var deduccionIess = document.getElementById('deduccionIess');
            var otrosGastos = document.getElementById('otrosGastos');
            var baseImponible = document.getElementById('baseImponible');
            var sueldo = document.getElementById('sueldo');


            //gastos personales
            var totalesPersonales = parseFloat(alimentacion.value) + parseFloat(vivienda.value) +
                parseFloat(recreacion.value) + parseFloat(vestimenta.value) + parseFloat(salud.value);

            if (totalesPersonales) {
                $('#totalPersonales').val(totalesPersonales.toFixed(2));
            }

            //deducciones

            var totalDeducciones = parseFloat(deduccionIess.value) + parseFloat(otrosGastos.value) +
                parseFloat(totalesPersonales)

            if (totalDeducciones) {
                $('#totalDeducciones').val(totalDeducciones.toFixed(2));
            }

            //base imponible
            var imponibleNuevo = parseFloat(sueldo.value) - totalDeducciones;
            if (imponibleNuevo) {
                $('#baseImponible').val(imponibleNuevo.toFixed(2));
            }

            //saco impuesto de renta


        });
    });
</script>

<div class="container-fluid">
    <h1>Formulario Gastos Impuesto a la Renta</h1><br>

    @if(session('tax-added'))
            <div class="alert alert-success">{{session('tax-added')}}</div>
    @endif



        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Instrucciones</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">

                    <p>- Los conceptos de ingresos corresponden a montos anuales.</p>
                    <p>- Ningún campo puede estar vacío.</p>
                    <p><strong>Tabla de impuestos a la renta para personas naturales</strong></p>

                    @if($impuestos)
                        <div class="table-responsive">
                            <table class="table table-bordered" id="taxTable">
                                <thead>
                                    <th>Fracción básica</th>
                                    <th>Exceso hasta</th>
                                    <th>Impuesto Fracción Básica</th>
                                    <th>% Impuesto Fracción Excedente</th>
                                </thead>
                                <tfoot>

                                </tfoot>
                                <tbody>
                                    @foreach($impuestos as $impuesto)
                                        <tr>

                                            <td id="fraccionBasica">{{ number_format($impuesto->fraccion_basica,2) }}</td>
                                            <td id="excesoHasta">{{ number_format($impuesto->exceso_hasta,2) }}</td>
                                            <td id="impuestoBasico">{{ number_format($impuesto->impuesto_fraccion_basica,2) }}</td>
                                            <td id="impuestoExcedente">{{ number_format($impuesto->impuesto_fraccion_excedente*100,2) }}%
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <form action="{{route('calculateTax')}}" method="get" enctype="multipart/form-data" id="formId">
        @csrf
        

        <h5 class="m-0 font-weight-bold text-primary">Año</h5>
        <hr>
            <p>Ingresar año en formato: yyyy</p>
            <p>Ejemplo: 2023</p>
        <input type="text" name="anio" class="form-control col-md-3" value="{{$anio}}" required><br>

        <h5 class="m-0 font-weight-bold text-primary">Ingresos</h5>
        <hr>

        <div class="row">
            <div class="col-12 col-md-4">
                <label for="">Sueldos y salarios en dependencia laboral</label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" value="{{ $salarioAnual }}" id="sueldo" name="sueldo_anual" readonly>
            </div>
        </div>


        <div class="row">
            <div class="col-12 col-md-4">
                <label for=""><strong>Total Ingresos</strong></label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" value="{{ $salarioAnual }}" name="total_ingresos" readonly>
            </div>
        </div>




        <h5 class="m-0 font-weight-bold text-primary">Gastos Personales</h5>
        <hr>

        <div class="row">
            <div class="col-12 col-md-4">
                <label for="">Alimentación</label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" id="alimentacion" name="alimentacion" value="{{$alimentacion}}" required>
            </div>
        </div>


        <div class="row">
            <div class="col-12 col-md-4">
                <label for="">Vivienda</label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" id="vivienda"  name="vivienda" value="{{$vivienda}}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-4">
                <label for="">Educación, arte y cultura</label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" id="recreacion"  name="recreacion" value="{{$recreacion}}" required>
            </div>
        </div>
       
        <div class="row">
            <div class="col-12 col-md-4">
                <label for="">Vestimenta</label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" id="vestimenta"  name="vestimenta" value="{{$vestimenta}}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-4">
                <label for="">Salud</label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" id="salud"  name="salud" value="{{$salud}}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-4">
                <label for=""><strong>Total Deducción por Gastos Personales</strong></label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" readonly id="totalPersonales" name="total_deduccion_personales" value="{{$total_deduccion_personales}}">
            </div>
        </div>


        <h5 class="m-0 font-weight-bold text-primary">Deducciones</h5>
        <hr>

        <div class="row">
            <div class="col-12 col-md-4">
                <label for="">Deducción IESS</label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" value="{{ $calculoIess }}" id="deduccionIess" name="deduccionIess" readonly>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-4">
                <label for="">Otros gastos y deducciones</label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" id="otrosGastos" name="otrosGastos" value="{{ $otrosGastos }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-4">
                <label for=""><strong>Total Deducciones</strong></label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" value="{{ $total_deduccion_personales }}" id="totalDeducciones" name="total_deducciones" readonly>
            </div>
        </div>



        <h5 class="m-0 font-weight-bold text-primary">Cálculo del Impuesto a la Renta</h5>
        <hr>
        
        <div class="row">
            <div class="col-12 col-md-4">
                <label for="">Base Imponible</label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" value="{{ $baseImponibleFinal }}" id="baseImponible" name="baseImponible" readonly>
            </div>
        </div>


        <div class="row">
            <div class="col-12 col-md-4">
                <label for=""><strong>Impuesto a la Renta por Pagar</strong></label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" value="{{$impuestoAPagar}}" name="impuestoAPagar" id="impuestoAPagar" readonly>
            </div>
        </div>



        <div class="rod-sm-flex align-items-center justify-content-between mb-4w">
        
            
            <button  class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" id="calculateButton">Calcular</button>
       
           
        </div><br>

        </form>

        <form action="{{route('store.tax')}}" method="post">
        @csrf
        <input type="text" value="{{$impuestoAPagar}}" name="impuestoAPagar" hidden="true">
        <input type="text" name="anio" class="form-control col-md-3" value="{{$anio}}" hidden="true">
        <input type="text" class="form-control" value="{{ $salarioAnual }}" id="sueldo" name="sueldo_anual" readonly hidden="true">
        <input type="text" class="form-control" id="alimentacion" name="alimentacion" value="{{$alimentacion}}" hidden="true">
        <input type="text" class="form-control" value="{{ $baseImponibleFinal }}" id="baseImponible" name="baseImponible" readonly hidden="true">
        <input type="text" class="form-control" id="vivienda"  name="vivienda" value="{{$vivienda}}" hidden="true">
        <input type="text" class="form-control" id="recreacion"  name="recreacion" value="{{$recreacion}}" hidden="true">
        <input type="text" class="form-control" id="vestimenta"  name="vestimenta" value="{{$vestimenta}}" hidden="true">
        <input type="text" class="form-control" id="salud"  name="salud" value="{{$salud}}" hidden="true">
        <input type="text" class="form-control" readonly id="totalPersonales" name="total_deduccion_personales" value="{{$total_deduccion_personales}}" hidden="true">
        <input type="text" class="form-control" value="{{ $calculoIess }}" id="deduccionIess" name="deduccionIess" readonly hidden="true">
        <input type="text" class="form-control" id="otrosGastos" name="otrosGastos" value="{{ $otrosGastos }}" hidden="true">
        <input type="text" class="form-control" value="{{ $total_deduccion_personales }}" id="totalDeducciones" name="total_deducciones" readonly hidden="true">
        <input type="text" class="form-control" value="{{ $salarioAnual }}" name="total_ingresos" readonly hidden="true">


        <div class="rod-sm-flex align-items-center justify-content-between mb-4w">
        <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Guardar</button>
        </div><br>
        </form>
       
      




       

</div>





@endsection