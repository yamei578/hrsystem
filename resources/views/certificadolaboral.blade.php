<style>
 
body{
    font-family: Arial, Helvetica, sans-serif;
    line-height: 30px;
    text-align: justify;
}

</style>



<body>


    
<div class="row">
    <div class="col-sm-12">
      
      <div class="card-header py-3">

    
      <p>Guayaquil, {{$fechaHoy}}</p>

      </div>

    </div>
  
        <h1 style="text-align:center; margin-top:100px; margin-bottom:50px;">C E R T I F I C A D O</h1>      
       <p>Certifico por medio de la presente que <b>{{$nombreColaborador}}</b> con cédula de identidad <b>No. {{$cedulaColaborador}}</b> labora bajo la 
        dependencia de la compañía <b>EMPRESA XYZ S.A.</b> desde el {{$fechaLaboralCompleta}} hasta la actualidad en el cargo de <b>{{$trabajoColaborador}}</b>
        percibiendo una remuneración mensual de ${{number_format($salario,2)}}.</p>

        <p>El interesado puede hacer uso de esta certificación para los fines que estime conveniente.</p>
</div>
</body>

