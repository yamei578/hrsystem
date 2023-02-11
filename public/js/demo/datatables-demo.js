// Call the dataTables jQuery plugin
$(document).ready(function () {
  $('#dataTable').DataTable({
      order: [[1, 'desc']],
      "language": {
        "lengthMenu": "Mostrar _MENU_ registros por página",
        "zeroRecords": "No se encontraron registros, intenta con otras palabras",
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "infoEmpty": "No existen registros",
        "infoFiltered": "(filtrados de un total de _MAX_ registros)",
        "search": "Filtrar:",
        "paginate": {
          "previous": "Anterior",
          "next": "Siguiente"
        }
    }
    
  });


  $('#resultMarcs').DataTable({
    order: [[2, 'asc']],
    "language": {
      "lengthMenu": "Mostrar _MENU_ registros por página",
      "zeroRecords": "No se encontraron registros, intenta con otras palabras",
      "info": "Mostrando página _PAGE_ de _PAGES_",
      "infoEmpty": "No existen registros",
      "infoFiltered": "(filtrados de un total de _MAX_ registros)",
      "search": "Filtrar:",
      "paginate": {
        "previous": "Anterior",
        "next": "Siguiente"
      }
  }
  
});
$('#historialMarcs').DataTable({
  order: [[2, 'desc']],
  "language": {
    "lengthMenu": "Mostrar _MENU_ registros por página",
    "zeroRecords": "No se encontraron registros, intenta con otras palabras",
    "info": "Mostrando página _PAGE_ de _PAGES_",
    "infoEmpty": "No existen registros",
    "infoFiltered": "(filtrados de un total de _MAX_ registros)",
    "search": "Filtrar:",
    "paginate": {
      "previous": "Anterior",
      "next": "Siguiente"
    }
}

});

$('#solsColabs').DataTable({
  order: [[1, 'desc']],
  "language": {
    "lengthMenu": "Mostrar _MENU_ registros por página",
    "zeroRecords": "No se encontraron registros, intenta con otras palabras",
    "info": "Mostrando página _PAGE_ de _PAGES_",
    "infoEmpty": "No existen registros",
    "infoFiltered": "(filtrados de un total de _MAX_ registros)",
    "search": "Filtrar:",
    "paginate": {
      "previous": "Anterior",
      "next": "Siguiente"
    }
}

});


});

