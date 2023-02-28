<x-admin>

    @section('content')

    <div class="container-fluid">


        @if(session('tax-added'))
            <div class="alert alert-success">{{ session('tax-added') }}</div>
        @endif
        @if(session('tax-deleted'))
            <div class="alert alert-danger">{{ session('tax-deleted') }}</div>
        @endif
        <h1>Formulario Impuesto a la Renta</h1>
        <p style="color:#FF0000;"><strong>Un formulario por año.</strong></p>

        @if($aplica)

            <div class="col-sm-9">
                <a href="{{ route('autogestion.colaboradores.formulario.impuesto') }}">Llenar
                    formulario impuesto a la renta.</a>
            </div><br>

            <div class="col-sm-12">


                <div class="card shadow mb-4">

                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Impuesto a Pagar</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Año</th>
                                        <th>Impuesto por Pagar</th>
                                        <th>Acciones</th>
                                    </tr>

                                </thead>
                                <tfoot>

                                </tfoot>
                                <tbody>
                                    @foreach($userTaxes as $taxes)
                                        <tr>
                                            <td>

                                                <a href="{{route('edit.tax',$taxes->id)}}">{{ $taxes->anio }}</a>

                                            </td>
                                            <td>{{number_format($taxes->impuesto_por_pagar,2)}}</td>
                                            <td>
                                                <!-- Inicio Button trigger modal -->

                                                <button type="button" class="btn btn-danger btn-circle"
                                                    data-toggle="modal" data-target="#deleteTaxes_{{$taxes->id}}"><i
                                                        class="fas fa-trash"></i></button>
                                                <!-- Modal -->
                                                <div id="deleteTaxes_{{$taxes->id}}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">
                                                                    Confirmación</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ¿Está seguro que desea eliminar el registro del formulario de impuesto a la renta del año {{$taxes->anio}}, con impuesto a pagar {{number_format($taxes->impuesto_por_pagar,2)}} ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Cancelar</button>
                                                                <form method="post" action="{{route('destroy.taxes', $taxes->id)}}">
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
                @else
                    <br>
                    <h6>No aplica para impuesto a la renta.</h6>

        @endif


    </div>


    @endsection


</x-admin>
