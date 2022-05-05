$(document).ready(function () {
  var id_usuario, opcion
  opcion = 4

  var date_input = document.getElementById('fecha')

  date_input.onchange = function () {
    window.location.href="vcalendario.php?fecha="+this.value
  }

  tablacal = $('#tablacal').DataTable({
    stateSave: true,
    paging: false,
    ordering:false,
    info:false,
    searching:false,
    //Para cambiar el lenguaje a español
    language: {
      lengthMenu: 'Mostrar _MENU_ registros',
      zeroRecords: 'No se encontraron resultados',
      info:
        'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
      infoEmpty: 'Mostrando registros del 0 al 0 de un total de 0 registros',
      infoFiltered: '(filtrado de un total de _MAX_ registros)',
      sSearch: 'Buscar:',
      oPaginate: {
        sFirst: 'Primero',
        sLast: 'Último',
        sNext: 'Siguiente',
        sPrevious: 'Anterior',
      },
      sProcessing: 'Procesando...',
    },
  })

  $('#btnNuevo').click(function () {
    window.location.href = 'tmpventa.php'
  })



  $(document).on('click', '.tarjetacita', function () {
 
   console.log($(this).attr('value'))
  })



})
