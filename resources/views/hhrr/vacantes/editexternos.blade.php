<x-admin>
@section('content')
@if(session('vacante-status'))
            <div class="alert alert-success">{{session('vacante-status')}}</div>
@endif



<h1>Vacante Externa</h1>

    <div class="form-group col-md-3">
    <label for="">Status proceso de reclutamiento:</label>
    <input type="text" class="form-control" readonly name="proceso_status"  value="
    @if($externo->proceso_status === 0)
        Aplicante nuevo
    @elseif($externo->proceso_status === 1)
        Contactado
    @else
        Entrevistado
    @endif

    ">
    </div>

    <div class="form-group col-4">
    <label for="">Status proceso de reclutamiento nuevo:</label>
        <form method="post" action="{{route('externos.update', $externo->id)}}">
        @csrf 
        @method('PUT')
        <select class="form-control"  name="proceso_status">
                <option value="" disabled selected>Seleccionar</option>
                
                <option value="0"> Aplicante nuevo
                <option value="1"> Contactado
                <option value="2"> Entrevistado
                
        </select><br>

        <button class="btn btn-info">Actualizar status</button>

        </form>
        
    </div><hr>

<div class="col-4">
<!-- Inicio Button aceptar vacante trigger modal -->

           
                            <!-- Modal -->
                            <div id="agregarExterno_{{$externo->id}}" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModal2Label">Confirmación</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <b>¿Está seguro que desea aceptar al colaborador {{$externo->nombre}}?</b>
                                                            <p>Al aceptar a la vacante, éste se agregará al módulo de <br> Empresa -> Colaboradores.</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <form method="post" action="{{route('externos.store.employee', $externo->id)}}">
                                                                    @csrf
                                                                  
                                                                        <button class="btn btn-success">Aceptar</button>
                                                                
                                                            </div>
                                                            </div>
                                                        </div>
                            </div>


<!-- fin Button aceptar vacante modal -->
   
</div>



  <h5 class="p-4">Datos Generales</h5>

  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregarExterno_{{$externo->id}}">Aceptar vacante</button><br><br>
    <div class="form-row">
                                <div class="form-group col-md-3">
                             
                                    <img class="rounded-circle" name="avatar" src="{{asset($externo->avatar)}}" alt="" height="200px" width="200px"><br>
                                    <br><br>
                                </div>
    </div>                             
                                
                            <div class="form-row">
                            
                                <div class="form-group col-md-3">
                                <label for="">Nombre completo</label>
                                <input type="text" class="form-control" readonly name="nombre"  value="{{$externo->nombre}}">
                                </div>
                                <div class="form-group col-md-3">
                                <label for="">Cédula</label>
                                <input type="text" class="form-control" readonly name="cedula"  value="{{$externo->cedula}}">
                                </div>
                                <div class="form-group col-md-3">
                                <label for="">Fecha de nacimiento</label>
                                <input type="date" class="form-control" readonly name="fecha_nacimiento"  value="{{$externo->fecha_nacimiento}}">
                                </div>
                                <div class="form-group col-md-3">
                                <label for="">Número de Teléfono</label>
                                <input type="text" class="form-control" readonly name="numero"  value="{{$externo->numero}}">
                                </div>
                            </div>
                           
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                <label for="">Email Personal</label>
                                <input type="email" class="form-control" readonly name="email_personal"  value="{{$externo->email_personal}}">
                                </div>
                                <div class="form-group col-md-6">
                                <label for="">Dirección</label>
                                <input type="text" class="form-control" readonly name="direccion"   value="{{$externo->direccion}}">
                                </div>
                                <div class="form-group col-md-3">
                                <label for="">Departamento al que aplica</label>
                                <select  class="form-control"  name="department_id" readonly id="department_id">
       
                                    @foreach($departments as $department)
                                    <option  name="department_id" value="{{$department->id}}" {{$externo->department_id == $department->id  ? 'selected' : ''}}> {{ $department->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                <label for="">Cargo al que aplica</label>
                                <select  class="form-control"  name="job_id" readonly id="job_id">
       
                                    @foreach($jobs as $job)
                                    <option  name="job_id" value="{{$job->id}}" {{$externo->job_id == $job->id  ? 'selected' : ''}}> {{ $job->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                
                            </div>

                            <h5 class="p-4">Curriculum</h5>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="">Idiomas</label>
                               <textarea class="form-control" readonly name="idiomas"  cols="20" rows="1">{{$externo->idiomas}}</textarea>
                                </div>
                                
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="">Habilidades</label>
                               <textarea class="form-control" readonly name="habilidades" cols="20" rows="4">{{$externo->habilidades}}</textarea>
                                </div>
                                
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="">Experiencia Laboral</label>
                               <textarea class="form-control" readonly name="experiencia_laboral"  cols="20" rows="4" >{{$externo->experiencia_laboral}}</textarea>
                                </div>
                                
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="">Educación</label>
                               <textarea class="form-control" readonly name="educacion"  cols="20" rows="4" >{{$externo->educacion}}</textarea>
                                </div>
                                
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="">Certificaciones/Cursos</label>
                               <textarea class="form-control" readonly  name="certificaciones_cursos" cols="20" rows="4" >{{$externo->certificaciones_cursos}}</textarea>
                                </div>
                                
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <label for="">Referencias personales</label>
                               <textarea class="form-control" readonly name="referencias_personales"  cols="20" rows="4" >{{$externo->referencias_personales}}</textarea>
                                </div>
                                
                                </form>

                                @endsection
</x-admin>




