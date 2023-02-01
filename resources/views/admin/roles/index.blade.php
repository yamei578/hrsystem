<x-admin>
    
    @section('content')

  

    <h1>Roles</h1>

    @if(session('role-deleted'))
            <div class="alert alert-danger">{{session('role-deleted')}}</div>
    @endif

    <div class="row">
        <div class="col-sm-3">
            <form method="post" action="{{route('roles.store')}}">
                @csrf 

                <div class="form-group">
                    <label for="name">Nombre de Rol:</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name">
                    <div>
                        @error('name')
                        <span><strong>{{$message}}</strong></span>
                        @enderror
                    </div>

                </div>
                <button type="submit" class="btn btn-primary btn-block">Agregar</button>

            </form>
        </div>

        <div class="col-sm-9">
        <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                 
                    <th>Rol</th>

                    <td>Acciones</td>
                </tr>

           </thead>
                <tfoot>
            
                </tfoot>
                <tbody>

                @foreach($roles as $role)

                <tr>
                  
                    <td><a href="{{route('role.edit', $role->id)}}">{{$role->name}}</a></td>
            
                    <td>
                 
                
                        <!-- Inicio Button trigger modal -->

                        <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteModal_{{$role->id}}" @if ($role->name =="Admin" || $role->name =="Supervisor" || $role->name =="Human Resources" || $role->name =="Employee") disabled @endif><i class="fas fa-trash"></i></button>
                            <!-- Modal -->
                            <div id="deleteModal_{{$role->id}}" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModal2Label">Confirmación</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            ¿Está seguro que desea eliminar {{$role->name}}?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <form method="post" action="{{route('role.destroy', $role->id)}}">
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


                </tbody>
            </table>
        </div>
    </div>
</div>
        </div>

    </div>



    @endsection 

    @section('scripts')
    
          <!-- Bootstrap core JavaScript-->
  <!-- Page level plugins -->
  <script src="{{asset('public/vendor/datatables/jquery.dataTables.min.js')}}"></script>
            <script src="{{asset('public/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

            <!-- Page level custom scripts -->
                    <script src="{{asset('public/js/demo/datatables-demo.js')}}"></script>
    @endsection

</x-admin>