<x-admin>
@section('content')

<h1>Cambiar contraseña</h1>

@if(session('password-updated'))
            <div class="alert alert-success">{{session('password-updated')}}</div>
@endif

<form method="post" action="{{route('user.update.password', $user)}}">
@csrf
                       @method('PUT')


                    <div class="col-4">
                               <label for="password">Contraseña</label>
                               <input type="password"
                                      name="password"
                                      class="form-control @error('password') is-invalid @enderror"
                                      id="password"
                               >

                               @error('password')
                               <div class="alert alert-danger">{{$message}}</div>
                               @enderror
                    </div>


                       <div class="col-4">
                               <label for="password-confirmation">Confirmar Contraseña</label>
                               <input type="password"
                                      name="password_confirmation"
                                      class="form-control @error('password_confirmation') is-invalid @enderror"
                                      id="password-confirmation"


                               >

                               @error('password_confirmation')
                               <div class="alert alert-danger">{{$message}}</div>
                               @enderror
                       </div><br>

                    

                       <button type="submit" class="btn btn-primary">Guardar</button>

</form>

@endsection
</x-admin>