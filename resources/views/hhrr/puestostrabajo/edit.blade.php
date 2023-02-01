<x-admin>
@section('content')

@if(session('job-updated'))
            <div class="alert alert-success">{{session('job-updated')}}</div>
    @endif
   
<h1>Editar puesto de trabajo: {{$job->name}}</h1>

<div class="row">
    <div class="col-sm-6">


    <form method="post" action="{{route('puestostrabajo.update', $job->id)}}">
        @csrf 
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre puesto de trabajo</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$job->name}}">
        </div><br>

        <button class="btn btn-primary">Actualizar</button>

    </form>

    </div>

</div><br>


<div class="row">

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Departamentos</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                <th>Opciones</th>
                    <th>Id</th>
                    <th>Nombre</th>
             
                    <th>Asignar</th>
                    <th>Quitar</th>
                </tr>

           </thead>
        
                <tbody>
              @foreach($departments as $department)
               
                <tr>
                <td><input type="checkbox" disabled
                        @foreach($job->departments as $department_job)
                          @if($department_job->slug == $department->slug)
                                checked
                          @endif
                        @endforeach
                
                ></td>
                <td>{{$department->id}} </td>
                <td>{{$department->name}} </td>
        
                <td>
                
                <form method="post" action="{{route('jobs.department.attach',$job)}}">
                        @method('PUT')
                        @csrf 
                        <input type="hidden" name="department" value="{{$department->id}}">
                <button class="btn btn-success btn-circle"  
                @if($job->departments->contains($department))
                disabled
                @endif> <i class="fas fa-check"></i></button>
                </form>
        
        
                </td>
                <td>
                
                <form method="post" action="{{route('jobs.department.detach',$job)}}">
                        @method('PUT')
                        @csrf 
                        <input type="hidden" name="department" value="{{$department->id}}">
                <button class="btn btn-danger btn-circle"
                @if(!$job->departments->contains($department))
                disabled
                @endif>
                
                <i class="fas fa-trash"></i></button>
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





@endsection
</x-admin>