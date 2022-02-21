$(document).ready(function () {
  var id, opcion
  opcion = 4
  var fila //capturar la fila para editar o borrar el registro
  tablaVis = $('#tablaV').DataTable({
    columnDefs: [
      {
        targets: -1,
        data: null,
        defaultContent:
          "<div class='text-center'><button class='btn btn-sm btn-primary  btnEditar'><i class='fas fa-edit'></i></button>\
            <button class='btn btn-sm btn-danger btnBorrar'><i class='fas fa-trash-alt'></i></button></div>",
      },
      { className: 'hide_column', targets: [2] },
      { className: 'hide_column', targets: [3] },
      { className: 'hide_column', targets: [4] },
      { className: 'hide_column', targets: [5] },
      { className: 'hide_column', targets: [6] },
      { className: 'hide_column', targets: [10] },
      { className: 'hide_column', targets: [11] },
      { className: 'hide_column', targets: [12] },
     
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

  $('#btnNuevo').click(function () {
    //window.location.href = "prospecto.php";
    $('#formDatos').trigger('reset')

    $('.modal-title').text('NUEVO CLIENTE')
    $('#modalCRUD').modal('show')
    id = null
    opcion = 1 //alta
  })

  //botón EDITAR
  $(document).on('click', '.btnEditar', function () {
    fila = $(this).closest('tr')
    id = parseInt(fila.find('td:eq(0)').text())

    //window.location.href = "actprospecto.php?id=" + id;
    nombre = fila.find('td:eq(1)').text()
    genero = fila.find('td:eq(2)').text()
    fechanac = fila.find('td:eq(3)').text()
    curp = fila.find('td:eq(4)').text()
    rfc = fila.find('td:eq(5)').text()
    dir = fila.find('td:eq(6)').text()
    tel = fila.find('td:eq(7)').text()
    correo = fila.find('td:eq(8)').text()
    cel = fila.find('td:eq(9)').text()
    ocupacion = fila.find('td:eq(10)').text()
    estudios = fila.find('td:eq(11)').text()
    edocivil = fila.find('td:eq(12)').text()
    medio = fila.find('td:eq(13)').text()
    referenciaid = fila.find('td:eq(14)').text()
    referencia = fila.find('td:eq(15)').text()

    $('#nombre').val(nombre)
    $('#genero').val(genero)
    $('#curp').val(curp)
    $('#rfc').val(rfc)
    $('#fechanac').val(fechanac)
    $('#dir').val(dir)
    $('#correo').val(correo)
    $('#tel').val(tel)
    $('#cel').val(cel)
    $('#ocupacion').val(ocupacion)
    $('#nivelestudios').val(estudios)
    $('#edocivil').val(edocivil)
    $('#medio').val(medio)
    $('#id_prosx').val(referenciaid)
    $('#nom_prosx').val(referencia)
    opcion = 2 //editar

    $('.modal-title').text('EDITAR CLIENTE')
    $('#modalCRUD').modal('show')
  })

  //botón BORRAR
  $(document).on('click', '.btnBorrar', function () {
    fila = $(this)

    id = parseInt($(this).closest('tr').find('td:eq(0)').text())
    opcion = 3 //borrar

    //agregar codigo de sweatalert2
    var respuesta = confirm('¿Está seguro de eliminar el registro: ' + id + '?')

    if (respuesta) {
      $.ajax({
        url: 'bd/crudcliente.php',
        type: 'POST',
        dataType: 'json',
        data: { id: id, opcion: opcion },

        success: function (data) {
          console.log(fila)

          tablaVis.row(fila.parents('tr')).remove().draw()
        },
      })
    }
  })

  $(document).on('click', '#btnGuardar', function () {
    nombre = $('#nombre').val()
    genero = $('#genero').val()
    fechanac = $('#fechanac').val()
    curp = $('#curp').val()
    rfc = $('#rfc').val()
    direccion = $('#dir').val()
    telefono = $('#tel').val()
    correo = $('#correo').val()
    whatsapp = $('#cel').val()
    ocupacion = $('#ocupacion').val()
    estudios = $('#nivelestudios').val()
    edocivil = $('#edocivil').val()
    medio = $('#medio').val()
    referenciaid = $.trim($("#id_prosx").val());
    referencia = $.trim($("#nom_prosx").val());
   if( referencia.length == 0){
    referencia="ND"

   }
   if(referenciaid.length==0){
    referenciaid=0
   }
   

    if (nombre.length == 0 || whatsapp.length == 0 || fechanac.length == 0) {
      Swal.fire({
        title: 'Datos Faltantes',
        text: 'Debe ingresar todos los datos del Prospecto',
        icon: 'warning',
      })
      return false
    } else {
      $.ajax({
        url: 'bd/crudcliente.php',
        type: 'POST',
        dataType: 'json',
        data: {
          nombre: nombre,
          genero: genero,
          fechanac: fechanac,
          curp: curp,
          rfc: rfc,
          direccion: direccion,
          telefono: telefono,
          correo: correo,
          whatsapp: whatsapp,
          ocupacion: ocupacion,
          estudios: estudios,
          edocivil: edocivil,
          id: id,
          referenciaid: referenciaid,
          referencia: referencia,
          medio: medio,
          opcion: opcion,
        },
        success: function (data) {
          if (data != 0) {
            //tablaPersonas.ajax.reload(null, false);
            id = data[0].id_clie
            nombre = data[0].nom_clie
            genero = data[0].gen_clie
            fechanac = data[0].nac_clie
            curp = data[0].curp_clie
            rfc = data[0].rfc_clie
            dir = data[0].dir_clie
            tel = data[0].tel_clie
            correo = data[0].correo_clie
            cel = data[0].ws_clie
            ocupacion = data[0].ocupacion_clie
            estudios = data[0].niv_clie
            edocivil = data[0].ecivil_clie
            medio = data[0].medio_clie
            referenciaid=data[0].referenciaid
            referencia=data[0].referencia
/*
            if (opcion == 1) {
              tablaVis.row
                .add([
                  id,
                  nombre,
                  genero,
                  fechanac,
                  curp,
                  rfc,
                  dir,
                  tel,
                  correo,
                  cel,
                  ocupacion,
                  estudios,
                  edocivil,
                  medio,
                  referenciaid,
                  referencia,
                ])
                .draw()
            } else {
              tablaVis
                .row(fila)
                .data([
                  id,
                  nombre,
                  genero,
                  fechanac,
                  curp,
                  rfc,
                  dir,
                  tel,
                  correo,
                  cel,
                  ocupacion,
                  estudios,
                  edocivil,
                  medio,
                  referenciaid,
                  referencia,
                ])
                .draw()
            }*/
            window.location.reload()
            Swal.fire({
              title: 'Registro Guardado',
              text: '',
              icon: 'success',
            })
          } 
          else {
            Swal.fire({
              title: 'Error al Guardar el registro',
              text: '',
              icon: 'warning',
            })
          }
        },
        error: function(){
            Swal.fire({
                title: 'Error al Ejecutar funcion',
                text: '',
                icon: 'warning',
              })
        },
      })
      $('#modalCRUD').modal('hide')
    }
  })

  tablaC = $("#tablaCx").DataTable({



    "columnDefs": [{
        "targets": -1,
        "data": null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-sm btn-success btnSelClientex'><i class='fas fa-hand-pointer'></i></button></div></div>"
    }],

    //Para cambiar el lenguaje a español
    "language": {
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "No se encontraron resultados",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "sProcessing": "Procesando...",
    }
});


  $(document).on("click", "#bclientex", function () {

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");

    $("#modalProspectox").modal("show");
    $('#btnCancelarctax').hide();

});


$(document).on("click", ".btnSelClientex", function () {
  fila = $(this).closest("tr");

  IdClientex = fila.find('td:eq(0)').text();
  NomClientex = fila.find('td:eq(1)').text();


  $("#id_prosx").val(IdClientex);
  $("#nom_prosx").val(NomClientex);
  $("#modalProspectox").modal("hide");

});

})
