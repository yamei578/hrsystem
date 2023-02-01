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


<h1>Agregar nuevo usuario</h1><br>



@if(session('user-added'))
            <div class="alert alert-success">{{session('user-added')}}</div>
@endif


    
                    <form method="POST" action="{{route('users.new')}}">
                        @csrf

                        <div class="row">
                        <div class="col-3">
                            <label for="username" class=" col-form-label text-md-end">{{ __('Usuario') }}</label>

                           
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        
                    
                        </div>
                        <div class="col-3">
                    
                            <label for="employee_number" class="col-form-label text-md-end">{{ __('Cédula de identidad') }}</label>
                           
                                <input id="cedula" type="text"  required maxlength="10" class="form-control @error('employee_number') is-invalid @enderror" name="employee_number" value="{{ old('employee_number') }}"  autofocus>
                                <p class="errorExternal2 hidden" id="wrong-cedula">Debe escribir 10 digitos.</p><br>
                                @error('employee_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          
                        </div>




                        <div class="col-3">
                            <label for="name" class="col-form-label text-md-end">{{ __('Nombre Completo') }}</label>

                          
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>
                        </div>

                       <div class="row">
                       <div class="col-3">
                            <label for="email" class="col-form-label text-md-end">{{ __('Correo Electrónico') }}</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                         
                        </div>

                        <div class="col-3">
                            <label for="password" class="col-form-label text-md-end">{{ __('Contraseña') }}</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                         
                        </div>

                        <div class="col-3">
                            <label for="password-confirm" class="col-form-label text-md-end">{{ __('Confirmar contraseña') }}</label>

                           
                                <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" >
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                               @enderror
                          
                        </div>
                       </div><br>

                     
                        <div class="row">
                            <div class="col-2">
                            
                                <label for="departmentSelect">Departamento</label>
                                <select class="form-control" name="department_id" id="department" required>
                                        
                                <option value="" disabled selected>Seleccionar</option>
                                @foreach($departamentos as $departamento)
                                        <option value="{{$departamento->id}}"> {{ $departamento->name }}
                                
                                        @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <label for="jobSelect">Cargo</label>
                                <select class="form-control" id="job" name="job_id" required>
                                <option value="" disabled selected>Seleccionar</option>
                                @foreach($jobs as $job)
                                <option value="{{$job->id}}"> {{$job->name}}
                                @endforeach
                                </select>
                            
                            </div>
                       
                            <div class="col-2">
                            

                                <label for="">Salario</label>
                                <input type="text" class="form-control" name="salario" required>
                            
                            </div>
                            <div class="col-2">
                                <label>Fecha de ingreso</label>
                               
                                <input type="date" class="form-control" name="fecha_ingreso" id= "fecha_ingreso" placeholder="yyyy/mm/dd">
                                </div>
                        </div>
                        
                        <br>

                        <div class="row mb-2">
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-success">
                                {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>


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