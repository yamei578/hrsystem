
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



        <h5 class="m-0 font-weight-bold text-primary">Año</h5>
        <hr>
        
        <input type="text" name="anio" class="form-control col-md-3" readonly value="{{$taxes->anio}}"><br>

        <h5 class="m-0 font-weight-bold text-primary">Ingresos</h5>
        <hr>

        <div class="row">
            <div class="col-12 col-md-4">
                <label for="">Sueldos y salarios en dependencia laboral</label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" value="{{ number_format($taxes->sueldo_anual,2) }}" id="sueldo" name="sueldo_anual" readonly>
            </div>
        </div>


        <div class="row">
            <div class="col-12 col-md-4">
                <label for=""><strong>Total Ingresos</strong></label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" value="{{ number_format($taxes->total_ingresos,2) }}" name="total_ingresos" readonly>
            </div>
        </div>




        <h5 class="m-0 font-weight-bold text-primary">Gastos Personales</h5>
        <hr>

        <div class="row">
            <div class="col-12 col-md-4">
                <label for="">Alimentación</label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" id="alimentacion" name="alimentacion" value="{{number_format($taxes->alimentacion,2)}}" readonly>
            </div>
        </div>


        <div class="row">
            <div class="col-12 col-md-4">
                <label for="">Vivienda</label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" id="vivienda"  name="vivienda" value="{{number_format($taxes->vivienda,2)}}" readonly>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-4">
                <label for="">Educación, arte y cultura</label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" id="recreacion"  name="recreacion" value="{{number_format($taxes->recreacion,2)}}" readonly>
            </div>
        </div>
       
        <div class="row">
            <div class="col-12 col-md-4">
                <label for="">Vestimenta</label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" id="vestimenta"  name="vestimenta" value="{{number_format($taxes->vestimenta,2)}}" readonly>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-4">
                <label for="">Salud</label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" id="salud"  name="salud" value="{{number_format($taxes->salud,2)}}" readonly>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-4">
                <label for=""><strong>Total Deducción por Gastos Personales</strong></label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" readonly id="totalPersonales" name="total_deduccion_personales" value="{{number_format($taxes->total_deduccion_personales,2)}}">
            </div>
        </div>


        <h5 class="m-0 font-weight-bold text-primary">Deducciones</h5>
        <hr>

        <div class="row">
            <div class="col-12 col-md-4">
                <label for="">Deducción IESS</label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" value="{{number_format($taxes->deduccion_iess,2) }}" id="deduccionIess" name="deduccionIess" readonly>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-4">
                <label for="">Otros gastos y deducciones</label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" id="otrosGastos" name="otrosGastos" value="{{ number_format($taxes->otros_gastos,2) }}" readonly>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-4">
                <label for=""><strong>Total Deducciones</strong></label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" value="{{ number_format($taxes->total_deducciones,2) }}" id="totalDeducciones" name="total_deducciones" readonly>
            </div>
        </div>



        <h5 class="m-0 font-weight-bold text-primary">Cálculo del Impuesto a la Renta</h5>
        <hr>
        
        <div class="row">
            <div class="col-12 col-md-4">
                <label for="">Base Imponible</label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" value="{{ number_format($taxes->base_imponible,2) }}" id="baseImponible" name="baseImponible" readonly>
            </div>
        </div>


        <div class="row">
            <div class="col-12 col-md-4">
                <label for=""><strong>Impuesto a la Renta por Pagar</strong></label>
            </div>
            <div class="col-6 col-md-4" style="margin-bottom: 30px;">
                <input type="text" class="form-control" value="{{number_format($taxes->impuesto_por_pagar,2)}}" name="impuestoAPagar" id="impuestoAPagar" readonly>
            </div>
        </div>



   

</div>





@endsection