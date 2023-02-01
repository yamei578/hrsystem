<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>EMPRESA XYZ</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">

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

</head>

<body class="bg-gradient-primary">

    
          <div class="container">
         
          @section('content')
                    @if(session('vacante-externo-enviado'))
                                <div class="alert alert-success">{{session('vacante-externo-enviado')}}</div>
                    @endif
                    
                    <div class="text-center">
                     
                      <form name="externalForm" method="post" action="{{route('externos.store')}}" enctype="multipart/form-data" id="msform">
                            
                            @csrf 
                             
                                <h4 class="fs-titles">Llena tus datos y envíalo a la empresa.</h4>
                           
                            <ul id="progressbar">
                                <li class="active">Datos Generales</li>
                                <li>Curriculum</li>
                                <li>Referencias personales</li>
                            </ul>

                    
                                <fieldset>

                                <div class="row">
                                  <div class="col-4">
                                  <label for="" class="fs-label" >Foto personal</label>
                                    <input type="file" class="form-control-file" name="avatar" required >
                                    <p class="errorExternal2 hidden" id="wrong-avatar">Debe cargar una foto personal.</p><br>
                                  </div>
                                  <div class="col-4">
                                  <label for="" class="fs-label">Departamento</label>
                                      <select class="form-control required" id="department_id" name="department_id" required>
                                        <option value="" disabled selected>Seleccionar</option>
                                        @foreach($departments as $department)
                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                                      </select>
                                  </div>
                                  <div class="col-4">
                                  <label for="" class="fs-label">Cargo al que aplica</label>
                                      <select class="form-control required" id="job_id" name="job_id" required>
                                        <option value="" disabled selected>Seleccionar</option>
                                        @foreach($jobs as $job)
                                        <option value="{{$job->id}}">{{$job->name}}</option>
                                        @endforeach
                                      </select>
                                  </div>
                                  
                                </div>
                                   

                                <div class="row">
                                  <div class="col-6">
                                  <label for="" class="fs-label">Nombre</label>
                                    <input type="text" class="form-control required" name="nombre" id="nombre" placeholder="Nombre completo" required >
                                    <p class="errorExternal2 hidden" id="wrong-name">No puede estar vacío.</p><br>
                                  </div>
                                  <div class="col-6">
                                  <label for="" class="fs-label">Cédula de identidad</label>
                                    <input type="text" class="form-control required" id="cedula" name="cedula" maxlength="10" placeholder="0000000000" required >
                                
                                    <p class="errorExternal2 hidden" id="wrong-cedula">Debe escribir 10 digitos.</p><br>
                                  </div>
                                </div>   
                                     
                                <div class="row">
                                  <div class="col-6">
                                  <label for="" class="fs-label">Fecha de nacimiento &nbsp;</label><br>
                                    <input type="date" class="form-control required" name="fecha_nacimiento" required >
                                  </div>
                                  <div class="col-6">
                                  <label for="" class="fs-label">Número de teléfono</label>
                                    <input type="text" class="form-control required" id="numero" name="numero" maxlength="10" placeholder="0000000000" required >
                                    <p class="errorExternal2 hidden" id="wrong-phone">Debe escribir 10 digitos.</p><br>
                                  </div>
                                </div>      
                                   

                                <div class="row">
                                  <div class="col-6">
                                  <label for="" class="fs-label">Email personal &nbsp;</label>
                                    <input type="email" class="form-control required" id = "email" id="email_personal" name="email_personal"required placeholder="ejemplo@gmail.com" >
                                    <p class="errorExternal2" id="result"></p><br>
                                  </div>
                                  <div class="col-6">
                                  <label for="" class="fs-label">Dirección domicilio</label>
                                    <input type="text" class="form-control required" name="direccion" id ="direccion" required placeholder="Av. Mz # S #" >
                                    <p class="errorExternal2 hidden" id="wrong-direccion">No puede estar vacío.</p><br>
                                  </div>
                                </div>
                                    

                                    <input type="button" name="next" class="next action-button" value="Siguiente" />
                                    <p class="errorExternal2 hidden" id="campos-incompletos">Debes completar todos los campos para continuar.</p><br>
                                </fieldset>

                               <fieldset>
                               
                            
                                <label for="" class="fs-label">Idiomas</label>
                               <textarea class="form-control required" required name="idiomas"  id ="idiomas" cols="20" rows="1"></textarea>
                               
                               

    
                               <p class="errorExternal2 hidden" id="wrong-idiomas">No puede estar vacío.</p><br>
                            
                                <label for="" class="fs-label">Habilidades</label>
                               <textarea class="form-control required" required  name="habilidades" id="habilidades" cols="20" rows="4"></textarea>
                               <p class="errorExternal2 hidden" id="wrong-habilidades">No puede estar vacío.</p><br>
                            
                                <label for="" class="fs-label">Experiencia Laboral</label>
                               <textarea class="form-control required" required  name="experiencia_laboral" id="experiencia_laboral" cols="20" rows="4" placeholder="Porfavor incluir fecha inicio y fecha fin"></textarea>
                               <p class="errorExternal2 hidden" id="wrong-experiencia_laboral">No puede estar vacío.</p><br>

                                <label for="" class="fs-label">Educación</label>
                               <textarea class="form-control required" required  name="educacion" id="educacion"  cols="20" rows="4" placeholder="Porfavor incluir fecha inicio y fecha fin"></textarea>
                               <p class="errorExternal2 hidden" id="wrong-educacion">No puede estar vacío.</p><br>
                             
                                <label for="" class="fs-label">Certificaciones/Cursos</label>
                               <textarea class="form-control required" required  name="certificaciones_cursos" id="certificaciones_cursos" cols="20" rows="4" placeholder="Porfavor incluir fecha inicio y fecha fin"></textarea>
                               <p class="errorExternal2 hidden" id="wrong-certificaciones_cursos">No puede estar vacío.</p><br>
                               
                                <input type="button" name="previous" class="previous action-button" value="Anterior" />
                                <input type="button" name="next" class="next action-button" value="Siguiente" />
                               </fieldset>

                               <fieldset>
                             
                                <label for="" class="fs-label" >Referencias personales</label>
                               <textarea class="form-control required" required name="referencias_personales" id="referencias_personales" cols="20" rows="4" placeholder="Nombre y teléfono de contacto"></textarea>
                               <p class="errorExternal2 hidden" id="wrong-referencias_personales">No puede estar vacío.</p><br>
                               
                            <input type="button" name="previous" class="previous action-button" value="Anterior" />
                           
                            <button type="submit" id="submitButton" class="submit action-button">Enviar</button>
                            <p>Para enviar tu curriculum, todos los campos deben estar llenos.</p>
                          

                               </fieldset>

                            </form>
                  
                    
                    </div>
          </div>
   

 <!-- Bootstrap core JavaScript-->
 <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
  <script src="multiselect-dropdown.js" ></script>

  <script>
    //jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
  if(animating) return false;
  animating = true;
  
  current_fs = $(this).parent();
  next_fs = $(this).parent().next();
  
  //activate next step on progressbar using the index of next_fs
  $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
  
  //show the next fieldset
  next_fs.show(); 
  //hide the current fieldset with style
  current_fs.animate({opacity: 0}, {
    step: function(now, mx) {
      //as the opacity of current_fs reduces to 0 - stored in "now"
      //1. scale current_fs down to 80%
      scale = 1 - (1 - now) * 0.2;
      //2. bring next_fs from the right(50%)
      left = (now * 50)+"%";
      //3. increase opacity of next_fs to 1 as it moves in
      opacity = 1 - now;
      current_fs.css({
        'transform': 'scale('+scale+')',
        'position': 'absolute'
      });
      next_fs.css({'left': left, 'opacity': opacity});
    }, 
    duration: 800, 
    complete: function(){
      current_fs.hide();
      animating = false;
    }, 
    //this comes from the custom easing plugin
    easing: 'easeInOutBack'
  });
});

$(".previous").click(function(){
  if(animating) return false;
  animating = true;
  
  current_fs = $(this).parent();
  previous_fs = $(this).parent().prev();
  
  //de-activate current step on progressbar
  $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
  
  //show the previous fieldset
  previous_fs.show(); 
  //hide the current fieldset with style
  current_fs.animate({opacity: 0}, {
    step: function(now, mx) {
      //as the opacity of current_fs reduces to 0 - stored in "now"
      //1. scale previous_fs from 80% to 100%
      scale = 0.8 + (1 - now) * 0.2;
      //2. take current_fs to the right(50%) - from 0%
      left = ((1-now) * 50)+"%";
      //3. increase opacity of previous_fs to 1 as it moves in
      opacity = 1 - now;
      current_fs.css({'left': left});
      previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
    }, 
    duration: 800, 
    complete: function(){
      current_fs.hide();
      animating = false;
    }, 
    //this comes from the custom easing plugin
    easing: 'easeInOutBack'
  });
});

 /*(".submit").click(function(){
  //return false;
}) */
  </script>




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
  setInputFilter(document.getElementById("nombre"), function(value) {
  return /^[A-Za-z\s]*$/.test(value); }, "Solo letras");
 
// Install input filters.
/*setInputFilter(document.getElementById("cedula"), function(value) {
  return /^-?\d*$/.test(value); }, "Must be an integer");*/

/*setInputFilter(document.getElementById("intLimitTextBox"), function(value) {
  return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 500); }, "Must be between 0 and 500");
  setInputFilter(document.getElementById("hexTextBox"), function(value) {
  return /^[0-9a-f]*$/i.test(value); }, "Must use hexadecimal characters");
setInputFilter(document.getElementById("floatTextBox"), function(value) {
  return /^-?\d*[.,]?\d*$/.test(value); }, "Must be a floating (real) number");
setInputFilter(document.getElementById("currencyTextBox"), function(value) {
  return /^-?\d*[.,]?\d{0,2}$/.test(value); }, "Must be a currency value");*/


</script>

<script>
  const validateEmail = (email) => {
  return email.match(
    /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
  );
};

const validate = () => {
  const $result = $('#result');
  const email = $('#email').val();
  $result.text('');

  if (validateEmail(email)) {
    $result.text('');
  } else {
    $result.text(email + ' no es válido\n');
    
  }
  return false;
}

$('#email').on('input', validate);
</script>


<script>

   $(document).ready(function(){
      $('#wrong-cedula').hide();
      $('#wrong-phone').hide();
      $('#wrong-name').hide();
      $('#wrong-direccion').hide();
      $('#wrong-idiomas').hide();
      $('#wrong-habilidades').hide();
      $('#wrong-experiencia_laboral').hide();
      $('#wrong-educacion').hide();
      $('#wrong-certificaciones_cursos').hide();
      $('#wrong-referencias_personales').hide();

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

  $('#nombre').keyup(function(e){
    var name = $('#nombre').val();
	if(name.length > 0){
  	e.preventDefault();
    $('#wrong-name').slideUp();
  } else {
  	$('#wrong-name').slideDown();
  }
});

  $('#direccion').keyup(function(e){
    var name = $('#direccion').val();
	if(name.length > 0){
  	e.preventDefault();
    $('#wrong-direccion').slideUp();
  } else {
  	$('#wrong-direccion').slideDown();
  }
  	
});

  $('#idiomas').keyup(function(e){
    var name = $('#idiomas').val();
	if(name.length > 0){
  	e.preventDefault();
    $('#wrong-idiomas').slideUp();
  } else {
  	$('#wrong-idiomas').slideDown();
  }
  	
});


  $('#habilidades').keyup(function(e){
    var name = $('#habilidades').val();
	if(name.length > 0){
  	e.preventDefault();
    $('#wrong-habilidades').slideUp();
  } else {
  	$('#wrong-habilidades').slideDown();
  }
  	
});

  $('#experiencia_laboral').keyup(function(e){
    var name = $('#experiencia_laboral').val();
	if(name.length > 0){
  	e.preventDefault();
    $('#wrong-experiencia_laboral').slideUp();
  } else {
  	$('#wrong-experiencia_laboral').slideDown();
  }
  	
});

  $('#educacion').keyup(function(e){
    var name = $('#educacion').val();
	if(name.length > 0){
  	e.preventDefault();
    $('#wrong-educacion').slideUp();
  } else {
  	$('#wrong-educacion').slideDown();
  }
  	
});

  $('#certificaciones_cursos').keyup(function(e){
    var name = $('#certificaciones_cursos').val();
	if(name.length > 0){
  	e.preventDefault();
    $('#wrong-certificaciones_cursos').slideUp();
  } else {
  	$('#wrong-certificaciones_cursos').slideDown();
  }
  	
});

  $('#referencias_personales').keyup(function(e){
    var name = $('#referencias_personales').val();
	if(name.length > 0){
  	e.preventDefault();
    $('#wrong-referencias_personales').slideUp();
  } else {
  	$('#wrong-referencias_personales').slideDown();
  }
  	
});

  

</script>



</body>



</html>