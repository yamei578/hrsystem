<x-admin>


@section('content')

<style>
  
  .validationerror input {
      border: 1px solid #a00;
      background-color: #ffdddd;
      padding: 2px 1px;
  }
  
  .input-error{
    outline: 1px solid red;
  }
  
  .hidden { display: none; }
  
  
</style>


@if(session('employee-updated'))
            <div class="alert alert-success">{{session('employee-updated')}}</div>
@endif

@if(session('payslip-deleted'))
            <div class="alert alert-danger">{{session('payslip-deleted')}}</div>
@endif

<!-- Nav tabs -->


<form method="post" enctype="multipart/form-data" action="{{route('employees.update', $employee->id)}}">
                @csrf 
                @method('PUT')
                <div class="rod-sm-flex align-items-center justify-content-between mb-4w">
                  <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Guardar</button>
                </div><br>
   


<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#general">Datos Generales</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#cv">Curriculum</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#ficha">Ficha Médica</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#nomina">Roles de pago</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane container active" id="general"> <br><br>
  
<div class="row">
  <div class="col-4">
      <label for="">Usuario</label>
        <select class="form-control" name="user_id" id="user_id">
            <option value="" disabled selected>Seleccionar</option>
            @foreach($users as $user)
              <option value="{{$user->id}}" {{$employee->user_id == $user->id  ? 'selected' : ''}}> {{ $user->name }}</option>
            @endforeach
        </select>
  </div>



</div>
<br><br>


  <div class="row">
  
  <div class="col-4">
      <img class="rounded-circle" name="avatar" src="{{asset($employee->avatar)}}" alt="" height="200px" width="200px"><br>
      <input type="file" value="{{$employee->avatar}}" name="avatar" class="form-control-file" id="">
  </div>
   
  </div>
  <br>

    <div class="row">
       
        <div class="col-sm-4">
          <label for="nombre">Nombre completo</label>
          <input type="text" class="form-control" name="nombre" id="nombre" value="{{$employee->nombre}}" required>
        </div>
   

 
    <div class="col-sm-4">
      <label for="employee_number">Cédula de Identidad</label>
     <!-- <input type="text" class="form-control" name="employee_number" id="employee_number" value="{{$employee->employee_number}}">-->


      <input id="cedula" type="text"  required maxlength="10" class="form-control @error('employee_number') is-invalid @enderror" name="employee_number" value="{{$employee->employee_number}}">
                                <p class="errorExternal2 hidden" id="wrong-cedula">Debe escribir 10 digitos.</p><br>
                                @error('employee_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          


    </div>

    <div class="col-sm-4">
        <label for="">Fecha Nacimiento</label>
        <input type="date" class="form-control" name="fecha_nacimiento" required value="{{$employee->fecha_nacimiento}}" placeholder="yyyy/mm/dd">
      </div>
 

    </div><br>


    <div class="row">

      <div class="col-sm-4">
        <label for="">Teléfono</label>
       <!-- <input type="text" class="form-control" name="numero" id="numero" value="{{$employee->numero}}">-->
        <input type="text" class="form-control required" id="numero" name="numero" maxlength="10" value="{{$employee->numero}}" required >
        <p class="errorExternal2 hidden" id="wrong-phone">Debe escribir 10 digitos.</p><br>


      </div>

      <div class="col-sm-4">
        <label for="">Fecha de ingreso</label>
        <input type="date" class="form-control" name="fecha_ingreso" value="{{$employee->fecha_ingreso}}" placeholder="yyyy/mm/dd" required>
    </div>
 
    </div><br>
  
 
      <div class="row">

         
        
        <div class="col-sm-6">
        <label for="" >Email Personal</label>
          <input type="email" class="form-control" name="email_personal" id="email_personal" value="{{$employee->email_personal}}" required>
        </div>
     
  
        <div class="col-sm-6">
        <label for="" >Email Empresa</label>
          <input type="email" class="form-control" name="email_empresa" id="email_empresa" value="{{$employee->email_empresa}}" required>
        </div>
     
      </div><br>

  
  <div class="form-group row">
    
    <div class="col-sm-12">
    <label for="">Dirección domicilio</label>
     <textarea class="form-control" name="direccion" required id="direccion" cols="5" rows="3">{{$employee->direccion}}</textarea>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Salario $</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" name="salario" id="salario" value="{{$employee->salario}}" required>
    </div>
    <label for="inputEmail3" class="col-sm-2 col-form-label">Cuenta Bancaria</label>
    <div class="col-sm-5">
     <textarea class="form-control" name="cuenta_bancaria" id="cuenta_bancaria" cols="3" rows="3" required>{{$employee->cuenta_bancaria}}</textarea>
    </div>
  </div>


  <div class="row">
    <div class="col-6">
 
    <label for="departmentSelect">Departamento</label>
    <select class="form-control" required name="department_id" id="department_id">
        
    <option value="" disabled selected>Seleccionar</option>
    @foreach($departamentos as $departamento)
        <option value="{{$departamento->id}}" {{$employee->department_id == $departamento->id  ? 'selected' : ''}}> {{ $departamento->name }}</option>
       
        @endforeach
    </select>
    </div>
    <div class="col-6">
      

    <label for="jobSelect">Cargo</label>
    <select class="form-control" id="job_id" name="job_id" required>
    <option value="" disabled selected>Seleccionar</option>
      @foreach($jobs as $job)
      
      <option value="{{$job->id}}" {{$employee->job_id == $job->id  ? 'selected' : ''}}> {{ $job->name }}</option>
      @endforeach
    </select>
 
    </div>

    
  </div>
  <br>

 

 
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Notas importantes</label>
    <div class="col-sm-10">
     <textarea class="form-control" name="notas" id="notas" cols="5" rows="3" required>{{$employee->notas}}</textarea >
    </div>
  </div>
  <div class="col-sm-3">
          

               
        </div>





  </div>
  <div class="tab-pane container fade" id="cv">
    <br>


  <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="inputEmail4">Idiomas</label>
                               <textarea class="form-control" required name="idiomas" cols="20" rows="1">{{$employee->idiomas}}</textarea>
                                </div>
                                
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="inputEmail4">Habilidades</label>
                               <textarea class="form-control" required name="habilidades" id="" cols="20" rows="4">{{$employee->habilidades}}</textarea>
                                </div>
                                
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="inputEmail4">Experiencia Laboral</label>
                               <textarea class="form-control" required name="experiencia_laboral" id="" cols="20" rows="4">{{$employee->experiencia_laboral}}</textarea>
                                </div>
                                
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="inputEmail4">Educación</label>
                               <textarea class="form-control" required name="educacion" id="" cols="20" rows="4">{{$employee->educacion}}</textarea>
                                </div>
                                
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="inputEmail4">Certificaciones/Cursos</label>
                               <textarea class="form-control" required name="certificaciones_cursos" id="" cols="20" rows="4">{{$employee->certificaciones_cursos}}</textarea>
                                </div>
                                
                            </div>











  </div>
  <div class="tab-pane container fade" id="ficha"> <br>
        <h6>Es importante no omitir ningún dato. Esta información es vital. Si considera que hay información adicional que el equipo de salud deba conocer, por favor agregarlo en notas. </h6><br>
        <h6>Esta información será para uso exclusivo del equipo de salud.</h6>
        <hr>

        <div class="form-row">
            <div class="col">
                <label for="">Estatura</label>
                <input type="text" class="form-control" placeholder="mts" name="estatura" value="{{$employee->estatura}}" required>
            </div>
            <div class="col">
                <label for="">Peso</label>
                <input type="text" class="form-control" placeholder="lbs" name="peso" value="{{$employee->peso}}" required>
            </div>
             <div class="col">
                <label for="">Grupo sanguíneo</label>
                <input type="text" class="form-control" name="grupo_sanguineo" value="{{$employee->grupo_sanguineo}}" required>
            </div>
        </div><br>
        <div class="form-row">
            <div class="col">
                <label for="">En caso de emergencia comunicarse con</label>
                <input type="text" class="form-control" placeholder="Nombre"  name="contacto_emergencia" value="{{$employee->contacto_emergencia}}" required>
            </div>
            <div class="col">
                <label for="">Teléfono contacto de emergencia</label>
                <input type="text" maxlength="10" class="form-control"  name="telefono_emergencia" value="{{$employee->telefono_emergencia}}" required>
            </div>
        </div><br>
        <div class="form-row">
           
            <div class="col">
                <label for="">Alergias</label>
                <textarea class="form-control" name="alergias" id="alergias" cols="3" rows="3" required>{{$employee->alergias}}</textarea>
            </div>
            <div class="col">
                <label for="">Intolerancias</label>
                <textarea class="form-control" name="intolerancias" id="intolerancias" cols="3" rows="3" required>{{$employee->intolerancias}}</textarea>
            </div>
            <div class="col">
                <label for="">Vacunas</label>
                <textarea class="form-control" name="vacunas" id="vacunas" cols="3" rows="3" required>{{$employee->vacunas}}</textarea>
            </div>
            
        </div><br>
        <div class="form-row">  
               <label for="">Antecedentes familiares</label>
               <textarea class="form-control" name="antecedentes_familiares" id="antecedentes_familiares" cols="3" rows="3" required>{{$employee->antecedentes_familiares}}</textarea>
       </div><br>
        <div class="form-row">  
               <label for="">Enfermedades/Dolencias</label>
               <textarea class="form-control" name="enfermedades_dolencias" id="enfermedades_dolencias" cols="3" rows="3" required>{{$employee->enfermedades_dolencias}}</textarea>
       </div><br>

        <div class="form-row">  
               <label for="">Cirugias y Transplantes</label>
               <textarea class="form-control" name="cirugias_transplantes" id="cirugias_transplantes" cols="3" rows="3" required>{{$employee->cirugias_transplantes}}</textarea>
       </div><br>
       <div class="form-row">  
               <label for="">Medicamentos</label>
               <textarea class="form-control" name="medicamentos" id="medicamentos" cols="3" rows="3" required>{{$employee->medicamentos}}</textarea>
       </div><br>
       <div class="form-row">  
               <label for="">Necesidades Especiales (médicas, religiosas o alimenticias)</label>
               <textarea class="form-control" name="necesidades_especiales" id="necesidades_especiales" cols="3" rows="3" required>{{$employee->necesidades_especiales}}</textarea>
       </div><br>
       <div class="form-row">  
               <label for="">Contacto y nombre de su médico</label> 
               <textarea class="form-control" name="medico_contacto" id="medico_contacto" cols="3" rows="3" required>{{$employee->medico_contacto}}</textarea>
       </div><br>
       <div class="form-row">  
               <label for="">NOTAS MEDICAS</label>
               <textarea class="form-control" name="notas_medicas" id="notas_medicas" cols="3" rows="3" required>{{$employee->notas_medicas}}</textarea>
       </div><br>
      
      
     
       
  </div>


</form>

<div class="tab-pane container fade" id="nomina"> <br><br>
 
       
       <div class="card shadow mb-4">
           
   <div class="card-header py-3">
       <h6 class="m-0 font-weight-bold text-primary">ROLES GENERADOS</h6>
   </div>
 
   @if($query)
  
   <div class="card-body">
       <div class="table-responsive">
           <table class="table table-bordered" id="dataTable"  width="100%" cellspacing="1">
               <thead>
               <tr>
                   <th>Fecha Mes/Año</th>
                   <th>Fecha desde</th>
                   <th>Fecha hasta</th>
                   <th>Líquido a pagar</th>
                   <th>Acciones</th>
      
               </tr>

          </thead>
               <tfoot>
           
               </tfoot>
               <tbody>

             
               @foreach($query as $queries)
             
               <tr>
                  <td><a href="{{route('payslip.edit', $queries->id)}}">{{$queries->mes_anio}}</a></td>
                  <td>{{$queries->fecha_desde}}</td>
                  <td>{{$queries->fecha_hasta}}</td>
                  <td>{{$queries->liquido_pagar}}</td>
                  <td>

                        <!-- Inicio Button trigger modal -->

                        <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteModal_{{$queries->id}}"><i class="fas fa-trash"></i></button>
                            <!-- Modal -->
                            <div id="deleteModal_{{$queries->id}}" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Confirmación</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            ¿Está seguro que desea eliminar el rol del mes/año {{$queries->mes_anio}} ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <form method="post" action="{{route('payslip.destroy', $queries->id)}}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                        <button class="btn btn-danger">Eliminar</button>
                                                                    </form>
                                                            </div>
                                                            </div>
                                                        </div>
                            </div>


                            <!-- fin Button trigger modal -->

                    </td>
                   
               </tr>
            
              @endforeach
              @endif
               </tbody>
           </table>
          
       </div>
       </div>
       
       </div>
   
</div>
</div>


<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>

<script>

function setInputFilter(textbox, inputFilter, errMsg) {
["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop", "focusout"].forEach(function(event) {
textbox.addEventListener(event, function(e) {
if (inputFilter(this.value)) {
  // Accepted value
  if (["keydown","mousedown","focusout"].indexOf(e.type) >= 0){
    this.classList.remove("input-error");
    this.setCustomValidity("");
  }
  this.oldValue = this.value;
  this.oldSelectionStart = this.selectionStart;
  this.oldSelectionEnd = this.selectionEnd;
} else if (this.hasOwnProperty("oldValue")) {
  // Rejected value - restore the previous one
  this.classList.add("input-error");
  this.setCustomValidity(errMsg);
  this.reportValidity();
  this.value = this.oldValue;
  this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
} else {
  // Rejected value - nothing to restore
  this.value = "";
}
});
});
}

setInputFilter(document.getElementById("cedula"), function(value) {
return /^\d*$/.test(value); }, "Solo números positivos");
setInputFilter(document.getElementById("numero"), function(value) {
  return /^\d*$/.test(value); }, "Solo números positivos");


$(document).ready(function(){
$('#wrong-cedula').hide();
$('#wrong-phone').hide();


});
$('#cedula').keyup(function(e){
if($(this).val().length === 10){
e.preventDefault();
$('#wrong-cedula').slideUp();
} else {
$('#wrong-cedula').slideDown();
}

});


$('#numero').keyup(function(e){
	if($(this).val().length === 10){
  	e.preventDefault();
    $('#wrong-phone').slideUp();
  } else {
  	$('#wrong-phone').slideDown();
  }
  	
});


</script>      

@endsection 




</x-admin>