<x-admin>

    
    @section('content')

    <h1>Usuarios</h1>

   


    <div class="row">
    <div class="col-sm-3">
            

              <a href="{{route('users.create')}}">Agregar nuevo usuario</a>
             
        
         
                <br><br><br>

    
        </div>
    </div>


@if(session('user-deleted'))
            <div class="alert alert-danger">{{session('user-deleted')}}</div>
    @endif

    @if(session('user-active'))
            <div class="alert alert-success">{{session('user-active')}}</div>
    @endif


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Usuarios</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataUsers" width="100%" cellspacing="0">
                <thead>
                <tr>
                
                    <th>Nombre completo</th>
                    <th>Rol</th>
                    <th>Departamento</th>
                    <th>Cargo</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>

           </thead>
                <tfoot>
            
                </tfoot>
                <tbody>

                @if($users)

                @foreach($users as $user)
                

                <tr>
                  
                    <td><a href="{{route('user.profile.show', $user->id)}}">{{$user->name}}</a></td>
                    <td>
                    @foreach($user->roles as $user_role)    
                    {{$user_role->name}}
                   @endforeach
                    </td>
            
                   <td>{{$user->department->name}}</td>
                   <td>{{$user->job->name}}</td>
                   <td>
                    @if($user->status === 0)
                    Activo
                    @else 
                    Inactivo
                   @endif
                    </td>
              
                    <td>
                        <div class="form-row">
                            <div class="col-4">
                               
                                  <!-- Inicio Button activar trigger modal -->

                        <button type="button" class="btn btn-success btn-circle btn-sm" data-toggle="modal" data-target="#activateUser_{{$user->id}}" @if ($user->status == 0) disabled @endif><i class="fas fa-check"></i></button>
                            <!-- Modal -->
                            <div id="activateUser_{{$user->id}}" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Confirmación</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            ¿Está seguro que desea activar {{$user->name}}?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <form method="post" action="{{route('user.activar', $user->id)}}">
                                                                @csrf
                                                                @method('PUT')
                                                                        <button class="btn btn-success">Activar</button>
                                                                    </form>
                                                            </div>
                                                            </div>
                                                        </div>
                            </div>


                            <!-- fin Button trigger modal -->

                            </div>

                             <!-- Inicio Button inactivar trigger modal -->

                            <button type="button" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#inactivateUser_{{$user->id}}" @if ($user->status == 1 || $user_role->name == 'Admin') disabled @endif><i class="fas fa-trash"></i></button>
                                        <!-- Modal -->
                                        <div id="inactivateUser_{{$user->id}}" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Confirmación</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            ¿Está seguro que desea inactivar {{$user->name}}?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <form method="post" action="{{route('user.inactivar', $user->id)}}">
                                @csrf
                                @method('PUT')
                                                                        <button class="btn btn-danger">Inactivar</button>
                                                                    </form>
                                                            </div>
                                                            </div>
                                                        </div>
                                        </div>


                            <!-- fin Button trigger modal -->


                            </div>
                       
                       
                        </div>
                       
                    </td>
                    
                </tr>
                   
                    @endforeach
                    @endif 

                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
   
        <!-- Page level plugins -->
      


        <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('js/demo/datadables-demo.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('js/sb-admin-2.js')}}"></script>



  <!-- Page level plugins -->
  <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  
     

</x-admin>