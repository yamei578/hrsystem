<x-admin>

@section('content')

<h1>Vacante disponible:</h1>


<form>
    <div class="form-row">
    <div class="col-4">
    <label for="exampleFormControlInput1">Departamento</label>
    <select disabled class="form-control" name="" id="">
        <option value="">Proyectos</option>
        <option value="">Marketing</option>

    </select>
  </div>
  <div class="col-4">
    <label for="exampleFormControlInput1">Puesto de trabajo</label>
    <select disabled class="form-control" name="" id="">
        <option value="">Desarrollador</option>

    </select>
  </div>
    </div><br>
 
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Explicación puesto de trabajo:</label>
    <textarea readonly class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary mb-2">Aplicar</button>
</form>


@endsection

</x-admin>