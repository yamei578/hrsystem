<x-admin>


@section('content')
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
               <select class="form-control" name="user_id" id="user_id" style="max-width:40%;">
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
      <input type="text" class="form-control" name="nombre" id="nombre" >
    </div>
  </div>
  <div class="form-group row">
    <label for="employee_number" class="col-sm-2 col-form-label">Cédula de identidad</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="employee_number" id="employee_number" >
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha Nacimiento</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="yyyy/mm/dd">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Teléfono</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="numero" id="numero" >
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email Personal</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email_personal" id="email_personal">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email Empresa</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email_empresa" id="email_empresa" >
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Dirección domicilio</label>
    <div class="col-sm-10">
     <textarea class="form-control" name="direccion" id="direccion" cols="5" rows="3"></textarea>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Salario</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="salario" id="salario" >
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Cuenta Bancaria</label>
    <div class="col-sm-10">
     <textarea class="form-control" name="cuenta_bancaria" id="cuenta_bancaria" cols="5" rows="3"></textarea>
    </div>
  </div>

  <div class="row">
    <div class="col-4">
 
    <label for="departmentSelect">Departamento</label>
    <select class="form-control" name="department_id" id="department_id">
        
    <option value="" disabled selected>Seleccionar</option>
    @foreach($departamentos as $departamento)
        <option value="{{$departamento->id}}"> {{ $departamento->name }}
 
        @endforeach
    </select>
    </div>
    <div class="col-4">
      

    <label for="jobSelect">Cargo</label>
    <select class="form-control" id="job_id" name="job_id">
    <option value="" disabled selected>Seleccionar</option>
      @foreach($jobs as $job)
      <option value="{{$job->id}}"> {{$job->name}}
      @endforeach
    </select>
 
    </div>




    <div class="col-4">
      

      <label for="">Status</label>
      <select class="form-control"  name="status">
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
      <input type="date" class="form-control" name="fecha_ingreso" id= "fecha_ingreso" placeholder="yyyy/mm/dd">
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Notas importantes</label>
    <div class="col-sm-10">
     <textarea class="form-control" name="notas" id="notas" cols="5" rows="3"></textarea>
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
                               <textarea class="form-control" required name="idiomas" id="idiomas" cols="20" rows="1"></textarea>
                                </div>
                                
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="inputEmail4">Habilidades</label>
                               <textarea class="form-control" required name="habilidades" id="habilidades" cols="20" rows="4"></textarea>
                                </div>
                                
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="inputEmail4">Experiencia Laboral</label>
                               <textarea class="form-control" required name="experiencia_laboral" id="experiencia_laboral" cols="20" rows="4"></textarea>
                                </div>
                                
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="inputEmail4">Educación</label>
                               <textarea class="form-control" required name="educacion" id="educacion" cols="20" rows="4"></textarea>
                                </div>
                                
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="inputEmail4">Certificaciones/Cursos</label>
                               <textarea class="form-control" required name="certificaciones_cursos" id="certificaciones_cursos" cols="20" rows="4"></textarea>
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
                <input type="text" name="estatura" id="estatura" class="form-control" placeholder="mts">
            </div>
            <div class="col">
                <label for="">Peso</label>
                <input type="text" name="peso" id="peso" class="form-control" placeholder="lbs">
            </div>
             <div class="col">
                <label for="">Grupo sanguíneo</label>
                <input type="text" name="grupo_sanguineo" id="grupo_sanguineo" class="form-control" >
            </div>
        </div><br>
        <div class="form-row">
            <div class="col">
                <label for="">En caso de emergencia comunicarse con</label>
                <input type="text" name="contacto_emergencia" id="contacto_emergencia" class="form-control" placeholder="Nombre">
            </div>
            <div class="col">
                <label for="">Teléfono contacto de emergencia</label>
                <input type="text" name="telefono_emergencia" id="telefono_emergencia" class="form-control" >
            </div>
        </div><br>
        <div class="form-row">
           
            <div class="col">
                <label for="">Alergias</label>
                <textarea class="form-control" name="alergias" id="alergias" cols="3" rows="3"></textarea>
            </div>
            <div class="col">
                <label for="">Intolerancias</label>
                <textarea class="form-control" name="intolerancias" id="intolerancias" cols="3" rows="3"></textarea>
            </div>
            <div class="col">
                <label for="">Vacunas</label>
                <textarea class="form-control" name="vacunas" id="vacunas" cols="3" rows="3"></textarea>
            </div>
            
        </div><br>
        <div class="form-row">  
               <label for="">Antecedentes familiares</label>
               <textarea class="form-control" name="antecedentes_familiares" id="antecedentes_familiares" cols="3" rows="3"></textarea>
       </div><br>
        <div class="form-row">  
               <label for="">Enfermedades/Dolencias</label>
               <textarea class="form-control" name="enfermedades_dolencias" id="enfermedades_dolencias" cols="3" rows="3"></textarea>
       </div><br>

        <div class="form-row">  
               <label for="">Cirugias y Transplantes</label>
               <textarea class="form-control" name="cirugias_transplantes" id="cirugias_transplantes" cols="3" rows="3"></textarea>
       </div><br>
       <div class="form-row">  
               <label for="">Medicamentos</label>
               <textarea class="form-control" name="medicamentos" id="medicamentos" cols="3" rows="3"></textarea>
       </div><br>
       <div class="form-row">  
               <label for="">Necesidades Especiales (médicas, religiosas o alimenticias)</label>
               <textarea class="form-control" name="necesidades_especiales" id="necesidades_especiales" cols="3" rows="3"></textarea>
       </div><br>
       <div class="form-row">  
               <label for="">Contacto y nombre de su médico</label> 
               <textarea class="form-control" name="medico_contacto" id="medico_contacto" cols="3" rows="3"></textarea>
       </div><br>
       <div class="form-row">  
               <label for="">NOTAS MEDICAS</label>
               <textarea class="form-control" name="notas_medicas" id="notas_medicas" cols="3" rows="3"></textarea>
       </div><br>
      
    



  </div>
</div>
</form> 
<br><br>


@endsection 




</x-admin>