$(document).ready(function () {
  var id_usuario, opcion
  opcion = 4
  cargarhoras()

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

 



  $(document).on('click', '.tarjetacita', function () {
 
   console.log($(this).attr('value'))
  })


  $('#datetimepicker1').datetimepicker({
    locale: 'es',
  })

  $('#datetimepicker1x').datetimepicker({
    locale: 'es',
  })

  tablaC = $('#tablaC').DataTable({
    columnDefs: [
      {
        targets: -1,
        data: null,
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-sm btn-success btnSelCliente'><i class='fas fa-hand-pointer'></i></button></div></div>",
      },
    ],

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

  tablaC = $('#tablaCx').DataTable({
    columnDefs: [
      {
        targets: -1,
        data: null,
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-sm btn-success btnSelClientex'><i class='fas fa-hand-pointer'></i></button></div></div>",
      },
    ],

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

  $(document).on('click', '#bcliente', function () {
    $('.modal-header').css('background-color', '#007bff')
    $('.modal-header').css('color', 'white')

    $('#modalProspecto').modal('show')
  })
  $(document).on('click', '#bclientex', function () {
    $('.modal-header').css('background-color', '#007bff')
    $('.modal-header').css('color', 'white')

    $('#modalProspectox').modal('show')
    $('#btnCancelarctax').hide()
  })

  $(document).on('click', '#btnNuevo', function () {
    $('#formDatos').trigger('reset')
    $('.modal-header').css('background-color', '#007bff')
    $('.modal-header').css('color', 'white')
    opcion = 1
    $('#formDatos :input').prop('disabled', false)
    $('#btnCancelarcta').hide()
    $('#btnreagendar').hide()
    $('#btnGuardar').show()
    $('#modalCRUD').modal('show')
  })

  $(document).on('click', '#btnNuevox', function () {
    $('#formDatospx').trigger('reset')
    $('.modal-header').css('background-color', '#007bff')
    $('.modal-header').css('color', 'white')
    opcion = 1
    $('#formDatospx :input').prop('disabled', false)
    $('#btnCancelarctax').hide()
    $('#btnreagendarx').hide()
    $('#btnGuardarx').show()
    $('#modalpx').modal('show')
  })

  $(document).on('click', '.btnSelCliente', function () {
    fila = $(this).closest('tr')

    IdCliente = fila.find('td:eq(0)').text()
    NomCliente = fila.find('td:eq(1)').text()

    $('#id_pros').val(IdCliente)
    $('#nom_pros').val(NomCliente)
    $('#modalProspecto').modal('hide')
  })

  $(document).on('click', '.btnSelClientex', function () {
    fila = $(this).closest('tr')

    IdClientex = fila.find('td:eq(0)').text()
    NomClientex = fila.find('td:eq(1)').text()

    $('#id_prosx').val(IdClientex)
    $('#nom_prosx').val(NomClientex)
    $('#modalProspectox').modal('hide')
  })

  $(document).on('click', '#btnGuardar', function () {
    var id_pros = $.trim($('#id_pros').val())
    var nombre = $.trim($('#nom_pros').val())
    var concepto = $.trim($('#concepto').val())
    var fecha = $.trim($('#fecha').val())
    var hora = $('#hora').val()
    fecha= fecha +" "+ hora;
    var obs = $.trim($('#obs').val())
    var id = $.trim($('#folio').val())
    var tipop = $.trim($('#tipop').val())
    var responsable = $.trim($('#responsable').val())
    var duracion = $.trim($('#duracion').val())
    var cabina = $.trim($('#cabina').val())
    if (
      id_pros.length == 0 ||
      fecha.length == 0 ||
      responsable.length == 0 ||
      cabina.length == 0
    ) {
      Swal.fire({
        title: 'Datos Faltantes',
        text: 'Debe ingresar todos los datos requeridos',
        icon: 'warning',
      })
      return false
    } else {
      $.ajax({
        url: 'bd/citasp.php',
        type: 'POST',
        dataType: 'json',
        async: 'false',
        data: {
          nombre: nombre,
          id_pros: id_pros,
          fecha: fecha,
          obs: obs,
          tipop: tipop,
          concepto: concepto,
          id: id,
          opcion: opcion,
          responsable: responsable,
          duracion: duracion,
          cabina: cabina,
        },
        success: function (data) {
          if (data == 1) {
            console.log(data)
            Swal.fire({
              title: 'Operación Exitosa',
              text: 'Cita Guardada',
              icon: 'success',
              timer: 1000,
            })
            window.setTimeout(function () {
              location.reload()
            }, 1500)
          } else {
            Swal.fire({
              title: 'No es posible Agendar la Cita',
              icon: 'warning',
            })
          }
        },
      })
    }
    //$("#modalCRUD").modal("hide");
  })

  $(document).on('click', '#btnreagendar', function () {
    var id_pros = $.trim($('#id_pros').val())
    var nombre = $.trim($('#nom_pros').val())
    var concepto = $.trim($('#concepto').val())
    var fecha = $.trim($('#fecha').val())
    var obs = $.trim($('#obs').val())
    var id = $.trim($('#folio').val())
    var tipop = $.trim($('#tipop').val())
    var responsable = $.trim($('#responsable').val())
    var duracion = $.trim($('#duracion').val())
    var cabina = $.trim($('#cabina').val())
    opcion=2
    if (
      id_pros.length == 0 ||
      fecha.length == 0 ||
      responsable.length == 0 ||
      cabina.length == 0
    ) {
      Swal.fire({
        title: 'Datos Faltantes',
        text: 'Debe ingresar todos los datos requeridos',
        icon: 'warning',
      })
      return false
    } else {
      $.ajax({
        url: 'bd/citasp.php',
        type: 'POST',
        dataType: 'json',
        async: 'false',
        data: {
          nombre: nombre,
          id_pros: id_pros,
          fecha: fecha,
          obs: obs,
          tipop: tipop,
          concepto: concepto,
          id: id,
          opcion: opcion,
          responsable: responsable,
          duracion: duracion,
          cabina: cabina,
        },
        success: function (data) {
          if (data == 1) {
            console.log(data)
            Swal.fire({
              title: 'Operación Exitosa',
              text: 'Cita Guardada',
              icon: 'success',
              timer: 1000,
            })
            window.setTimeout(function () {
              location.reload()
            }, 1500)
          } else {
            Swal.fire({
              title: 'No es posible Agendar la Cita',
              icon: 'warning',
            })
          }
        },
      })
    }
    //$("#modalCRUD").modal("hide");
  })



  $(document).on('click', '#btnGuardarx', function () {
    var id_pros = $.trim($('#id_prosx').val())
    var nombre = $.trim($('#nom_prosx').val())
    var concepto = $.trim($('#conceptox').val())
    var fecha = $.trim($('#fechax').val())
    var obs = $.trim($('#obsx').val())
    var id = $.trim($('#foliox').val())
    var tipop = $.trim($('#tipopx').val())
    var responsable = $.trim($('#responsablex').val())
    var duracion = $.trim($('#duracionx').val())
    var cabina = $.trim($('#cabinax').val())

    if (
      id_pros.length == 0 ||
      fecha.length == 0 ||
      responsable.length == 0 ||
      cabina.length == 0
    ) {
      Swal.fire({
        title: 'Datos Faltantes',
        text: 'Debe ingresar todos los datos requeridos',
        icon: 'warning',
      })
      return false
    } else {
      $.ajax({
        url: 'bd/citasp.php',
        type: 'POST',
        dataType: 'json',
        data: {
          nombre: nombre,
          id_pros: id_pros,
          fecha: fecha,
          obs: obs,
          tipop: tipop,
          concepto: concepto,
          id: id,
          opcion: opcion,
          responsable: responsable,
          duracion: duracion,
          cabina: cabina,
        },
        success: function (data) {
          if (data == 1) {
            console.log(data)
            Swal.fire({
              title: 'Operación Exitosa',
              text: 'Cita Guardada',
              icon: 'success',
              timer: 1000,
            })
            window.setTimeout(function () {
              location.reload()
            }, 1500)
          } else {
            Swal.fire({
              title: 'No es posible Agendar la Cita',
              icon: 'warning',
            })
          }
        },
      })
    }
    //$("#modalCRUD").modal("hide");
  })

  $(document).on('click', '#btnreagendarx', function () {
 
    var id_pros = $.trim($('#id_prosx').val())
    var nombre = $.trim($('#nom_prosx').val())
    var concepto = $.trim($('#conceptox').val())
    var fecha = $.trim($('#fechax').val())
    var obs = $.trim($('#obsx').val())
    var id = $.trim($('#foliox').val())
    var tipop = $.trim($('#tipopx').val())
    var responsable = $.trim($('#responsablex').val())
    var duracion = $.trim($('#duracionx').val())
    var cabina = $.trim($('#cabinax').val())
    opcion=2
    if (
      id_pros.length == 0 ||
      fecha.length == 0 ||
      responsable.length == 0 ||
      cabina.length == 0
    ) {
      Swal.fire({
        title: 'Datos Faltantes',
        text: 'Debe ingresar todos los datos requeridos',
        icon: 'warning',
      })
      return false
    } else {
      $.ajax({
        url: 'bd/citasp.php',
        type: 'POST',
        dataType: 'json',
        async: 'false',
        data: {
          nombre: nombre,
          id_pros: id_pros,
          fecha: fecha,
          obs: obs,
          tipop: tipop,
          concepto: concepto,
          id: id,
          opcion: opcion,
          responsable: responsable,
          duracion: duracion,
          cabina: cabina,
        },
        success: function (data) {
          if (data == 1) {
            console.log(data)
            Swal.fire({
              title: 'Operación Exitosa',
              text: 'Cita Guardada',
              icon: 'success',
              timer: 1000,
            })
            window.setTimeout(function () {
              location.reload()
            }, 1500)
          } else {
            Swal.fire({
              title: 'No es posible Agendar la Cita',
              icon: 'warning',
            })
          }
        },
      })
    }
    //$("#modalCRUD").modal("hide");
  })


  $(document).on('click', '#btnCancelarcta', function () {
    folio = $('#folio').val()

    $('#formcan').trigger('reset')
    /*$(".modal-header").css("background-color", "#28a745");*/
    $('.modal-header').css('color', 'white')
    $('#modalcan').modal('show')
    $('#foliocan').val(folio)
  })

  $(document).on('click', '#btnCancelarctax', function () {
    folio = $('#foliox').val()

    $('#formcan').trigger('reset')
    /*$(".modal-header").css("background-color", "#28a745");*/
    $('.modal-header').css('color', 'white')
    $('#modalcan').modal('show')
    $('#foliocan').val(folio)
  })

  $(document).on('click', '#btnGuardarc', function () {
    motivo = $('#motivo').val()
    id = $('#foliocan').val()
    fecha = $('#fechac').val()
    usuario = $('#nameuser').val()
    $('#modalcan').modal('hide')
    opcion = 4
    console.log(id)
    console.log(motivo)
    console.log(fecha)
    console.log(usuario)

    if (motivo === '') {
      swal.fire({
        title: 'Datos Incompletos',
        text: 'Verifique sus datos',
        icon: 'warning',
        focusConfirm: true,
        confirmButtonText: 'Aceptar',
      })
    } else {
      $.ajax({
        type: 'POST',
        url: 'bd/buscarcita.php',
        async: false,
        dataType: 'json',
        data: {
          id: id,
          opcion: opcion,
          motivo: motivo,
          fecha: fecha,
          usuario: usuario,
        },
        success: function (data) {
          if (data[0].id == id) {
            mensaje()
            window.setTimeout(function () {
              window.location.reload()
            }, 1500)
          } else {
            mensajeerror()
          }
        },
      })
    }
  })

  function mensaje() {
    swal.fire({
      title: 'Registro Cancelado',
      icon: 'success',
      focusConfirm: true,
      confirmButtonText: 'Aceptar',
      timer: 2000,
    })
  }

  function mensajeerror() {
    swal.fire({
      title: 'Error al Cancelar el Registro',
      icon: 'error',
      focusConfirm: true,
      confirmButtonText: 'Aceptar',
    })
  }

  tablaVis = $('#tablaV').DataTable({
    info: false,
    searching: false,
    paging: false,
    ordering: false,

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
    rowCallback: function (row, data) {
      $($(row).find('td')[1]).css('background-color', data[1])

      //$($(row).find('td')[2]).addClass('bg-gradient-green')
    },
  })


  function cargarhoras(){
    $('#hora').empty()
    $.ajax({
      type: 'POST',
      url: 'bd/cargarhoras.php',
      dataType: 'json',
      async: false,
      data: {},
      success: function (res) {
        for (var i = 0; i < res.length; i++) {
          $('#hora').append($("<option>", {
            value:res[i].nhora,
            text:res[i].nhora
          }));
        }
       
      },
    })
  }

})
