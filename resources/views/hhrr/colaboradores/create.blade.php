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
@if(session('employee-created'))
            <div class="alert alert-success">{{session('employee-created')}}</div>
    @endif

<!-- Nav tabs -->

<form method="post" enctype="multipart/form-data" action="{{route('employees.store')}}">
                @csrf 

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
  
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane container active" id="general"> <br><br>

  <div class="form-group row">

  <div class="col-6">

               <label for="">Usuarios disponibles:</label>
               <select class="form-control" name="user_id" id="user_id" style="max-width:40%;" required>
                   <option value="" disabled selected>Seleccionar</option>
                       @foreach($users as $user)
                           <option value="{{$user->id}}"> {{ $user->name }}
                       @endforeach
                </select>

  </div>

  <div class="col-6">
    <label for="">Foto colaborador</label>
    <input type="file" class="form-control-file" name="avatar">
  </div>
    
  </div>

    
    
  <br>
  <div class="form-group row">
    <label for="nombre" class="col-sm-2 col-form-label">Nombre completo</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nombre" id="nombre" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="employee_number" class="col-sm-2 col-form-label">Cédula de identidad</label>
    <div class="col-sm-10">
      <!--<input type="text" class="form-control" name="employee_number" id="employee_number" >-->

      <input id="cedula" type="text"  required maxlength="10" class="form-control @error('employee_number') is-invalid @enderror" name="employee_number">
                                <p class="errorExternal2 hidden" id="wrong-cedula">Debe escribir 10 digitos.</p><br>
                                @error('employee_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha Nacimiento</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="yyyy/mm/dd" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Teléfono</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="numero" id="numero" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email Personal</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email_personal" id="email_personal" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email Empresa</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email_empresa" id="email_empresa" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Dirección domicilio</label>
    <div class="col-sm-10">
     <textarea class="form-control" name="direccion" id="direccion" cols="5" rows="3" required></textarea>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Salario $</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="salario" id="salario" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Cuenta Bancaria</label>
    <div class="col-sm-10">
     <textarea class="form-control" name="cuenta_bancaria" id="cuenta_bancaria" cols="5" rows="3" required></textarea>
    </div>
  </div>

  <div class="row">
    <div class="col-4">
 
    <label for="departmentSelect">Departamento</label>
    <select class="form-control" name="department_id" id="department_id" required>
        
    <option value="" disabled selected>Seleccionar</option>
    @foreach($departamentos as $departamento)
        <option value="{{$departamento->id}}"> {{ $departamento->name }}
 
        @endforeach
    </select>
    </div>
    <div class="col-4">
      

    <label for="jobSelect">Cargo</label>
    <select class="form-control" id="job_id" name="job_id" required>
    <option value="" disabled selected>Seleccionar</option>
      @foreach($jobs as $job)
      <option value="{{$job->id}}"> {{$job->name}}
      @endforeach
    </select>
 
    </div>




    <div class="col-4">
      

      <label for="">Status</label>
      <select class="form-control"  name="status" required>
      <option value="" disabled selected>Seleccionar</option>
        <option value="1"> Activo
        <option value="2"> Inactivo
      </select>
   
      </div>
  </div>
  <br>

 
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Fecha de ingreso</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" name="fecha_ingreso" id= "fecha_ingreso" placeholder="yyyy/mm/dd" required>
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Notas importantes</label>
    <div class="col-sm-10">
     <textarea class="form-control" name="notas" id="notas" cols="5" rows="3" required></textarea>
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
                               <textarea class="form-control" required name="idiomas" id="idiomas" cols="20" rows="1" required></textarea>
                                </div>
                                
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="inputEmail4">Habilidades</label>
                               <textarea class="form-control" required name="habilidades" id="habilidades" cols="20" rows="4" required></textarea>
                                </div>
                                
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="inputEmail4">Experiencia Laboral</label>
                               <textarea class="form-control" required name="experiencia_laboral" id="experiencia_laboral" cols="20" rows="4" required></textarea>
                                </div>
                                
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="inputEmail4">Educación</label>
                               <textarea class="form-control" required name="educacion" id="educacion" cols="20" rows="4" required></textarea>
                                </div>
                                
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="inputEmail4">Certificaciones/Cursos</label>
                               <textarea class="form-control" required name="certificaciones_cursos" id="certificaciones_cursos" cols="20" rows="4" required></textarea>
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
                <input type="text" name="estatura" id="estatura" class="form-control" placeholder="mts" required>
            </div>
            <div class="col">
                <label for="">Peso</label>
                <input type="text" name="peso" id="peso" class="form-control" placeholder="lbs" required>
            </div>
             <div class="col">
                <label for="">Grupo sanguíneo</label>
                <input type="text" name="grupo_sanguineo" id="grupo_sanguineo" class="form-control" required>
            </div>
        </div><br>
        <div class="form-row">
            <div class="col">
                <label for="">En caso de emergencia comunicarse con</label>
                <input type="text" name="contacto_emergencia" id="contacto_emergencia" class="form-control" placeholder="Nombre" required>
            </div>
            <div class="col">
                <label for="">Teléfono contacto de emergencia</label>
                <input type="text" maxlength="10" name="telefono_emergencia" id="telefono_emergencia" class="form-control" required >
            </div>
        </div><br>
        <div class="form-row">
           
            <div class="col">
                <label for="">Alergias</label>
                <textarea class="form-control" name="alergias" id="alergias" cols="3" rows="3" required></textarea>
            </div>
            <div class="col">
                <label for="">Intolerancias</label>
                <textarea class="form-control" name="intolerancias" id="intolerancias" cols="3" rows="3" required></textarea>
            </div>
            <div class="col">
                <label for="">Vacunas</label>
                <textarea class="form-control" name="vacunas" id="vacunas" cols="3" rows="3" required></textarea>
            </div>
            
        </div><br>
        <div class="form-row">  
               <label for="">Antecedentes familiares</label>
               <textarea class="form-control" name="antecedentes_familiares" id="antecedentes_familiares" cols="3" rows="3" required></textarea>
       </div><br>
        <div class="form-row">  
               <label for="">Enfermedades/Dolencias</label>
               <textarea class="form-control" name="enfermedades_dolencias" id="enfermedades_dolencias" cols="3" rows="3" required></textarea>
       </div><br>

        <div class="form-row">  
               <label for="">Cirugias y Transplantes</label>
               <textarea class="form-control" name="cirugias_transplantes" id="cirugias_transplantes" cols="3" rows="3" required></textarea>
       </div><br>
       <div class="form-row">  
               <label for="">Medicamentos</label>
               <textarea class="form-control" name="medicamentos" id="medicamentos" cols="3" rows="3" required></textarea>
       </div><br>
       <div class="form-row">  
               <label for="">Necesidades Especiales (médicas, religiosas o alimenticias)</label>
               <textarea class="form-control" name="necesidades_especiales" id="necesidades_especiales" cols="3" rows="3" required></textarea>
       </div><br>
       <div class="form-row">  
               <label for="">Contacto y nombre de su médico</label> 
               <textarea class="form-control" name="medico_contacto" id="medico_contacto" cols="3" rows="3" required></textarea>
       </div><br>
       <div class="form-row">  
               <label for="">NOTAS MEDICAS</label>
               <textarea class="form-control" name="notas_medicas" id="notas_medicas" cols="3" rows="3" required></textarea>
       </div><br>
      
    



  </div>
</div>
</form> 
<br><br>

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


$(document).ready(function(){
$('#wrong-cedula').hide();


});
$('#cedula').keyup(function(e){
if($(this).val().length === 10){
e.preventDefault();
$('#wrong-cedula').slideUp();
} else {
$('#wrong-cedula').slideDown();
}

});
</script>      


@endsection 




</x-admin>