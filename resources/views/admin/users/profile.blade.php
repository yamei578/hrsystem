<x-admin>
        <style>
                body {
    background: rgb(99, 39, 120)
}


  
  .validationerror input {
      border: 1px solid #a00;
      background-color: #ffdddd;
      padding: 2px 1px;
  }
  
  .input-error{
    outline: 1px solid red;
  }
  
  .hidden { display: none; }
  



.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 11px
}

  
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


@section('content')

@if(session('mensajeError'))
            <div class="alert alert-danger">{{session('mensajeError')}}</div>
@endif

<h1>Perfil de : {{$user->name}}</h1>

<div class="row">


       <div class="col-sm-6">
       @if(session('user-updated'))
            <div class="alert alert-success">{{session('user-updated')}}</div>
        @endif

        @if(session('role-attached'))
            <div class="alert alert-success">{{session('role-attached')}}</div>
        @endif

        @if(session('role-detached'))
            <div class="alert alert-danger">{{session('role-detached')}}</div>
        @endif

               <form method="post" action="{{route('user.profile.update', $user)}}" enctype="multipart/form-data">
                       @csrf
                       @method('PUT')


                       <div class="row">
                       <div class="col-4">
                        <label for="username">Usuario</label>
                               <input @if(!auth()->user()->userHasRole('Admin')) disabled @endif type="text"
                                      name="username"
                                      class="form-control @error('username') is-invalid @enderror"


                                      id="username"
                                      value="{{$user->username}}"

                               >
                               @error('username')
                               <div class="invalid-feedback">{{$message}}</div>
                               @enderror
                        </div>
                        <div class="col-4">
                               <label for="name">Nombre Completo</label>
                               <input @if(!auth()->user()->userHasRole('Admin')) disabled @endif type="text"
                                      name="name"
                                      class="form-control @error('name') is-invalid @enderror"


                                      id="name"
                                      value="{{$user->name}}"

                               >

                               @error('name')
                               <div class="alert alert-danger">{{$message}}</div>
                               @enderror
                       </div>
                       <div class="col-4">
                        <label for="employee_number">Cédula de Identidad</label>
                               <input maxlength="10" class="form-control @error('employee_number') is-invalid @enderror" type="text"
                                      name="employee_number"
                                   


                                      id="cedula"
                                      value="{{$user->employee_number}}"

                                      @if(!auth()->user()->userHasRole('Admin')) disabled @endif >
                               <p class="errorExternal2 hidden" id="wrong-cedula">Debe escribir 10 digitos.</p><br>
                                @error('employee_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                     

                       </div><br>
                     
                       
                      
                        <div class="row">

                       <div class="col-4">
                               <label for="email">Correo Electrónico</label>
                               <input @if(!auth()->user()->userHasRole('Admin')) disabled @endif type="text"
                                      name="email"
                                      class="form-control @error('email') is-invalid @enderror"
                                      id="email"
                                      value="{{$user->email}}"

                               >

                               @error('email')
                               <div class="invalid-feedback">{{$message}}</div>
                               @enderror
                       </div>

                       <div class="col-4">
                                        <label for="departmentSelect">Departamento</label>
                                        <select @if(!auth()->user()->userHasRole('Admin')) disabled @endif class="form-control" name="department_id" id="department_id">
                                                
                                
                                        @foreach($departamentos as $departamento)
                                        <option value="{{$departamento->id}}"  {{$user->department_id == $departamento->id  ? 'selected' : ''}}> {{ $departamento->name }}</option>
                                        
                                                @endforeach
                                        </select>
                                </div>

                                <div class="col-4">
                                        <label for="">Supervisor</label>
                                        <select disabled class="form-control" name="department_id" id="department_id">
                                        
                                        @foreach($departamentos as $departamento)
                                        <option value="{{$departamento->user->name}}"  {{$user->department_id == $departamento->id  ? 'selected' : ''}}> {{ $departamento->user->name }}</option>
                                        
                                                @endforeach
                                        </select>
                                </div>
                     

                        </div><br>
                   
                      

                        <div class="row">
                                <div class="col-4">
                                

                                <label for="jobSelect">Cargo</label>
                                <select @if(!auth()->user()->userHasRole('Admin')) disabled @endif class="form-control" id="job_id" name="job_id">
                                        
                                <option value="" disabled selected>Seleccionar</option>
                                @foreach($jobs as $job)
                                <option value="{{$job->id}}" {{$user->job_id == $job->id  ? 'selected' : ''}}> {{ $job->name }}</option>
                                @endforeach
                                </select>
                                
                                </div>

                                <div class="col-4">
                        

                                <label for="">Salario</label>
                                <input required @if(!auth()->user()->userHasRole('Admin')) readonly @endif name="salario" value="{{$user->salario}}" class="form-control" type="text"> 
                        
                                </div>

                                <div class="col-4">
                                        <label>Fecha de ingreso</label>
                                
                                        <input @if(!auth()->user()->userHasRole('Admin')) readonly @endif type="date" class="form-control" value="{{$user->fecha_ingreso}}" name="fecha_ingreso" id= "fecha_ingreso" placeholder="yyyy/mm/dd">
                                </div>
                               
                              

                        </div><br>

                    <!--    <div class="row">
                                <div class="col-4">
                                <label>Días de vacaciones</label>
                                        
                                <input   type="text" readonly class="form-control" name="" id= "">
                                </div>
                                
                        </div><br>-->

                       
                       

                        @if(auth()->user()->userHasRole('Admin')) <button type="submit" class="btn btn-primary">Guardar</button> @endif 

               </form><br>

               @if(auth()->user()->userHasRole('Admin')) <a href="{{route('users.password.index', $user)}}">Cambiar contraseña</a> @endif

       </div>
       


       @if(auth()->user()->userHasRole('Admin'))
       <div class="col-6">
                             
                <div class="card shadow mb-4">
                <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                </div>
                <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                <th>Opciones</th>
                               
                                <th>Nombre</th>
                                <th>Asignar</th>
                                <th>Quitar</th>
                                </tr>

                        </thead>
                        
                                <tbody>
                        @foreach($roles as $role)
                        
                                <tr>
                                <td><input type="checkbox" disabled
                                        @foreach($user->roles as $user_role)
                                        @if($user_role->slug == $role->slug)
                                                checked
                                        @endif
                                        @endforeach
                                
                                ></td>
                       
                                <td>{{$role->name}} </td>
                          
                                <td>
                                
                                <form method="post" action="{{route('users.role.attach',$user)}}">
                                        @method('PUT')
                                        @csrf 
                                        <input type="hidden" name="role" value="{{$role->id}}">
                                <button class="btn btn-success btn-circle"   
                                @if($user->roles->contains($role))
                                disabled
                                @endif> <i class="fas fa-check"></i></button>
                                </form>
                        
                        
                                </td>
                                <td>
                                
                                <form method="post" action="{{route('users.role.detach',$user)}}">
                                        @method('PUT')
                                        @csrf 
                                        <input type="hidden" name="role" value="{{$role->id}}">
                                <button class="btn btn-danger btn-circle"
                                @if(!$user->roles->contains($role))
                                disabled
                                @endif><i class="fas fa-trash"></i></button>
                                </form>
                        
                                </td>
                                </tr>
                                @endforeach
                                </tbody>
                        </table>
                        </div>
                </div>
                </div>
                         </div>
                         @endif


                        

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