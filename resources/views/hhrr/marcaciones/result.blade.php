
@extends('components.admin')
@section('content')
<h1>Resultados</h1>

<div class="row-12">

<div class="col-3">
<button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generar Reporte PDF</button>
</div>


<br>
<div class="table-responsive">
<table class="table table-bordered" id="resultMarcs" width="100%" cellspacing="0">
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
            
               
                @foreach($query as $queries)
                <tr>
                   
                    <td>
                    {{$queries->name}}
                    </td>
                    <td>{{$queries->nombreMarcacion}}</td>
                    <td>{{$queries->fecha_hora_marcacion}}</td>
                    
            
            
                </tr>
                @endforeach
             
                </tbody>      
              
      

            </table>
        </div>
        </div>


@endsection