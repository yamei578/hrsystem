@extends('components.admin')

    

@section('content')
<script>
    // Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#dataTable').DataTable();

});
</script>

<style>
  .g-bg-secondary {
    background-color: #fafafa !important;
}

.u-shadow-v18 {
    box-shadow: 0 5px 10px -6px rgba(0, 0, 0, 0.15);
}

.g-color-gray-dark-v4 {
    color: #777 !important;
}

.g-font-size-12 {
    font-size: 0.85714rem !important;
}

.media-comment {
    margin-top:20px
}
</style>

<div class="container-fluid">
    <h1>Dashboard de: @if(Auth::check())
        {{ auth()->user()->name }}
        @endif</h1>


        @if(auth()->user()->userHasRole('Admin'))

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">

                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Usuarios registrados
                        </div>
                        @if($users)
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users }}</div>
                        @endif
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">

                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Roles disponibles</div>
                        @if($roles)
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $roles }}</div>
                        @endif
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endif

@if(auth()->user()->userHasRole('Human Resources'))

<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">

                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Departamentos disponibles
                        </div>
                        @if($departments)
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $departments }}</div>
                        @endif
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">

                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Puestos de trabajo
                        disponibles</div>
                    @if($jobs)
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jobs }}</div>
                    @endif
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">

                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Vacantes externas:</div>
                    @if($vacantesExternas)
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $vacantesExternas }}</div>
                    @endif
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">

                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Solicitudes pendientes:</div>
                    @if($solicitudes)
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $solicitudes }}</div>
                    @endif
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>




</div>



@endif


@if(!auth()->user()->userHasRole('Admin'))

@if($aplica)
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">AVISO IMPORTANTE: Impuesto a la Renta</h6>
        </div>
        <div class="card-body">
            Porfavor llenar formulario de gastos para impuesto a la renta en caso de no haberlo hecho: <a
                href="{{ route('autogestion.colaboradores.formulario.impuesto.index') }}">Ir a
                formulario.</a>
        </div>
    </div>
@endif

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total de Ganancias</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @if(!$userEarnings->isEmpty())
                                @foreach($userEarnings as $earnings)
                                    ${{ number_format($earnings->liquido_pagar,2) }}
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>


    </div>

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Solicitudes pendientes</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $userRequests }}
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>


</div>

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Vacantes Internas disponibles
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <a href="{{ route('colaborador.vacante.index') }}"
                                target="_blank">{{ $vacantesDisponibles }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>


</div>





<div class="row">
    <div class="col-sm-6">

        <div class="card">
            <div class="card-body border-left-primary">
                <h5 class="card-title">Marcaciones de hoy:</h5>



                <p class="card-text" id="entradaFecha">Entrada:
                    @if($entradaFecha)
                        {{ $entradaFecha->fecha_hora_marcacion }}
                    @else
                        {!! $text !!}

                    @endif</p>
                    <p class="card-text" id="salidaFecha">Salida:
                        @if($salidaFecha)
                            {{ $salidaFecha->fecha_hora_marcacion }}
                        @else
                            {!! $text !!}

                        @endif</p>
                        <p class="card-text" id="totalLaboral">Tiempo:

                            {{ $totalDuracionLaboral }}

                        </p>

            </div>

        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">

            <div class="card-body border-left-primary">
                <h5 class="card-title"> Marcaciones de Almuerzo:</h5>

                <p class="card-text"> Inicio:
                    @if($entradaAlmuerzoFecha)
                        {{ $entradaAlmuerzoFecha->fecha_hora_marcacion }}
                    @else
                        {!! $text !!}
                    @endif</p>

                    <p class="card-text">Fin:
                        @if($salidaAlmuerzoFecha)
                            {{ $salidaAlmuerzoFecha->fecha_hora_marcacion }}
                        @else
                            {!! $text !!}
                        @endif</p>

                        <p class="card-text" id="totalAlmuerzo">Tiempo:

                            {{ $totalDuracionAlmuerzo }}

                        </p>

            </div>
        </div>

    </div>
   

</div>

@endif
</div>







@endsection
 


