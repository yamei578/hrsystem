@extends('components.admin')
<script>


function renderTime(){
    var myDate = new Date();
    var year = myDate.getFullYear();
    if(year < 1000){
        year += 1900
    }
    var day = myDate.getDay();
    var month = myDate.getMonth();
    var daym = myDate.getDate();
    var dayArray = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
    var monthArray = new Array("January","February","March","April","May","June","July","August","September","October","November","December");


    //time 
    var currentTime = new Date();
    var h = currentTime.getHours();
    var m = currentTime.getMinutes();
    var s = currentTime.getSeconds();

    if(h == 24){
        h = 0;
    } else if (h > 12) {
        h = h - 0;
    }

    if(h<10){
        h = "0" + h;
    }
    var myClock = document.getElementById("clockDisplay");
    //myClock.textContent = "" +dayArray[day]+ " "+daym+ " " +monthArray[month]+ " " +year+" | " +h+ ":" +m+ ":" +s;
    //myClock.innerText = "" +dayArray[day]+ " "+daym+ " " +monthArray[month]+ " " +year+" | " +h+ ":" +m+ ":" +s;
    myClock.textContent = year+"-"+[month+1]+"-"+[daym]+" "+h+":"+m+":"+s;
    myClock.innerText = year+"-"+[month+1]+"-"+[daym]+" "+h+":"+m+":"+s;

    setTimeout("renderTime(),1000");
    
}
renderTime();

    
</script>

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h4 class="h3 mb-0 text-gray-800">Registrar marcación</h4><br>

</div>

@if(session('marcacion-guardada'))
            <div class="alert alert-success">{{session('marcacion-guardada')}}</div>
    @endif

    
<form method="post" action="{{route('colaborador.marcaciones.store')}}">
@csrf 
 

  <div class="form-group row">


  <label class="col-sm-2 col-form-label">Fecha/Hora</label>
    <div class="col-sm-3">
     
    <textarea class="container border-left-primary form-control" name="fecha_hora_marcacion" id="clockDisplay" readonly></textarea><br>

    </div>
</div>
  

    <div class="form-group row">
    <label for="marcacion_id" class="col-sm-2 col-form-label">Tipo de Marcación</label>
    <div class="col-sm-3">
       
    <select class="form-control" name="marcacion_id" id="marcacion_id">
        @foreach($marcaciones as $marcacion)
        <option value="{{$marcacion->id}}" 
        > {{ $marcacion->name }}
        @endforeach

    </select>
    </div>
    </div>


    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Marcar</button>
    </div>
  
</form>
<br>

<div class="row">
<div class="col-sm-4">
    <div class="card">
      <div class="card-body border-left-primary">
      <h5 class="card-title">Marcación de hoy:</h5>
     
       
        <p class="card-text" id="entradaFecha">Entrada: 
        @if($entradaFecha)
            {{$entradaFecha->fecha_hora_marcacion}}
        @else 
        {!! $text !!}

        @endif</p>
        <p class="card-text" id="salidaFecha">Salida: 
        @if($salidaFecha)
            {{$salidaFecha->fecha_hora_marcacion}}
        @else 
        {!! $text !!}

        @endif</p>
        <p class="card-text" id="totalLaboral">Tiempo: 
      
        {{$totalDuracionLaboral}}

        </p>
 
      </div>
    
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
  
      <div class="card-body border-left-primary">
        <h5 class="card-title"> Almuerzo de hoy:</h5>
       
        <p class="card-text">Entrada: 
            @if($entradaAlmuerzoFecha)
            {{$entradaAlmuerzoFecha->fecha_hora_marcacion}}
            @else 
        {!! $text !!}
            @endif</p>
       
        <p class="card-text">Salida: 
            @if($salidaAlmuerzoFecha) 
            {{$salidaAlmuerzoFecha->fecha_hora_marcacion}}
            @else 
        {!! $text !!}
            @endif </p>

            <p class="card-text" id="totalAlmuerzo">Tiempo: 
       
        {{$totalDuracionAlmuerzo}}

        </p>
     
      </div>
    </div>
    
  </div>
  <div class="col-sm-4">
    <div class="card">
  
      <div class="card-body border-left-primary">
        <h5 class="card-title">Feriados/Fds:</h5>
       
        <p class="card-text">Entrada: 
            @if($entradaFeriadoFecha)
            {{$entradaFeriadoFecha->fecha_hora_marcacion}}
            @else 
        {!! $text !!}
            @endif</p>
       
        <p class="card-text">Salida: 
            @if($salidaFeriadoFecha) 
            {{$salidaFeriadoFecha->fecha_hora_marcacion}}
            @else 
        {!! $text !!}
            @endif </p>

            <p class="card-text" id="totalAlmuerzo">Tiempo: 
       
        {{$totalDuracionFeriado}}

        </p>
     
      </div>
    </div>
    
  </div>

</div>

<br>


<h4 class="h3 mb-0 text-gray-800">Historial de marcaciones</h4>
<br>



<div class="col-sm-12">
        <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Marcaciones</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="historialMarcs" width="100%" cellspacing="0">
                <thead>
                <tr>
                  
                    <th>Colaborador</th>
                    <th>Tipo de marcación</th>
                    <th>Fecha/Hora</th>
                   
                </tr>

           </thead>
                <tfoot>
            
                </tfoot>
                <tbody>

                @if($marcacionesColaboradores)
                @foreach($marcacionesColaboradores as $marcacionColaborador)

                <tr>
                 
                    <td>{{$marcacionColaborador->user->name}}</td>
                    <td>{{$marcacionColaborador->marcacion->name}}</td>
                   
                    <td>{{$marcacionColaborador->fecha_hora_marcacion}}</td>
            
                </tr>
        
                @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
        </div>

@endsection
 


