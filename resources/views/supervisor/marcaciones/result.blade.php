
@extends('components.admin')
@section('content')
<h1>Resultados</h1>



<br>
<div class="table-responsive">


<table class="table table-bordered" id="resultMarcs" width="100%" cellspacing="0">
                <thead>
                <tr>
                 
                    <th>Colaborador</th>
                    <th>Tipo de marcación</th>
                    <th>Fecha/Hora</th>
                    <th>Latitud</th>
                    <th>Longitud</th>
                    
                </tr>

           </thead>
                <tfoot>
            
                </tfoot>
             
                
                <tbody>
            
               
                @foreach($query as $queries)
                
                <tr>
            
                    <td>
                    {{$queries->name}}
                    </td>
                    <td>{{$queries->nombreMarcacion}}</td>
                    <td>{{$queries->fecha_hora_marcacion}}</td>
                    <td>{{$queries->latitud}}</td>
                    <td>{{$queries->longitud}}</td>
                    
            
            
                </tr>
                @endforeach
             
                </tbody>      
              
      
            </table>
          
        </div>
   
   


@endsection