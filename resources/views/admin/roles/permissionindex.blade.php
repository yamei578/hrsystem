<x-admin>
    
    @section('content')

  

    <h1>Permisos</h1>

    @if(session('permission-deleted'))
            <div class="alert alert-danger">{{session('permission-deleted')}}</div>
    @endif

    @if(session('permission-added'))
            <div class="alert alert-success">{{session('permission-added')}}</div>
    @endif

    <div class="row">
        <div class="col-sm-3">
            <form method="post" action="{{route('permissions.store')}}">
                @csrf 

                <div class="form-group">
                    <label for="name">Nombre de Permiso:</label>
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
        <h6 class="m-0 font-weight-bold text-primary">Permisos</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                 
                    <th>Permisos</th>

                    <td>Acciones</td>
                </tr>

           </thead>
                <tfoot>
            
                </tfoot>
                <tbody>

                @foreach($permissions as $permission)

                <tr>
                  
                    <td>
                    
                          
                        <a href="{{route('permissions.edit', $permission->id)}}">{{$permission->name}}</a>
                      
                    </td>
                
            
                    
                    <td>
                    

                         <!-- Inicio Button trigger modal -->

                         <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteModal_{{$permission->id}}"><i class="fas fa-trash"></i></button>
                            <!-- Modal -->
                            <div id="deleteModal_{{$permission->id}}" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Confirmación</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            ¿Está seguro que desea eliminar {{$permission->name}}?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <form method="post" action="{{route('permissions.destroy', $permission->id)}}">
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