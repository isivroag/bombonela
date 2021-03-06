$(document).ready(function () {
  var id_concepto, opcion
  opcion = 4
  var fila

  //TABLA PRODUCTO
  tablaDet = $('#tablaDet').DataTable({
    fixedHeader: true,
    paging: false,
    searching: false,
    info: false,
    columnDefs: [
      {
        targets: -1,
        data: null,
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-sm btn-danger btnborrarProd'><i class='fas fa-trash'></i></button></div></div>",
      },
      { className: 'hide_column', targets: [0] },
      { className: 'hide_column', targets: [1] },
      { className: 'hide_column', targets: [2] },
      { className: 'hide_column', targets: [8] },
      { className: 'hide_column', targets: [9] },
      { className: 'text-right', targets: [6] },
      { className: 'text-right', targets: [7] },
      { className: 'text-center', targets: [5] },
    ],

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

  //TABLA PRODUCTO
  tablaservicio = $('#tablaservicio').DataTable({
    fixedHeader: true,
    columnDefs: [
      {
        targets: -1,
        data: null,
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-sm btn-success btnSelservicio'><i class='fas fa-hand-pointer'></i></button></div></div>",
      },
      { className: 'hide_column', targets: [1] },
      { className: 'hide_column', targets: [0] },
      { className: 'text-right', targets: [6] },

      { className: 'text-center', targets: [2] },
      { className: 'text-center', targets: [5] },
    ],

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

  //tabla concepto
  tablaCon = $('#tablaCon').DataTable({
    columnDefs: [
      {
        targets: -1,
        data: null,
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-sm btn-success btnSelConcepto'><i class='fas fa-hand-pointer'></i></button></div></div>",
      },
      { className: 'text-right', targets: [2] },
    ],

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

  //tabla cliente
  tablacliente = $('#tablacliente').DataTable({
    columnDefs: [
      {
        targets: -1,
        data: null,
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-sm btn-success btnSelcliente'><i class='fas fa-hand-pointer'></i></button></div></div>",
      },
    ],

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

  //tabla colaborador
  tablacol = $('#tablacol').DataTable({
    columnDefs: [
      {
        targets: -1,
        data: null,
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-sm btn-success btnSelcol'><i class='fas fa-hand-pointer'></i></button></div></div>",
      },
    ],

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

  //TABLA PRODUCTO
  tablaprod = $('#tablaproducto').DataTable({
    fixedHeader: true,
    columnDefs: [
      {
        targets: -1,
        data: null,
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-sm btn-success btnSelprod'><i class='fas fa-hand-pointer'></i></button></div></div>",
      },
      { className: 'text-right', targets: [4] },
      { className: 'text-right', targets: [5] },
      { className: 'text-center', targets: [3] },
      { width: '10%', targets: 0 },
      { width: '10%', targets: 1 },
      { width: '40%', targets: 2 },
      { width: '10%', targets: 3 },
      { width: '10%', targets: 4 },
      { width: '10%', targets: 5 },
      { width: '10%', targets: 6 },
    ],

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
  function commaSeparateNumber(val) {
    while (/(\d+)(\d{3})/.test(val.toString())) {
      val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2')
    }

    return val
  }

  //CALCULO IMPORTE
  function calcularimporte(cant, pv) {
    cantidad = cant
    precio = pv
    importe = round(cantidad * precio, 2)
    return importe
  }

  // CALCULO PRECIO VENTA
  function calcularprecio(pl, desc) {
    precio = pl
    descuento = desc
    if (parseFloat(precio) > parseFloat(descuento)) {
      pv = precio - descuento
    } else {
      pv = 0
    }

    return pv
  }
  //CALCULO INVERSO DESCUENTO
  function calculardescuento(pl, pvta) {
    preciol = pl
    precioventa = pvta
    if (parseFloat(preciol) >= parseFloat(precioventa)) {
      pv = preciol - precioventa
    } else {
      pv = 0
    }

    return pv
  }

  document.getElementById('cantidadprod').onblur = function () {
    cantidad = $('#cantidadprod').val().replace(/,/g, '')
    precio = $('#preciovprod').val().replace(/,/g, '')
    importe = calcularimporte(cantidad, precio)

    $('#importeprod').val(
      Intl.NumberFormat('es-MX', { minimumFractionDigits: 2 }).format(
        parseFloat(importe).toFixed(2),
      ),
    )
  }

  document.getElementById('descuentoprod').onblur = function () {
    descuento = $('#descuentoprod').val().replace(/,/g, '')
    precio = $('#preciolprod').val().replace(/,/g, '')
    preciovta = calcularprecio(precio, descuento)
    cantidad = $('#cantidadprod').val().replace(/,/g, '')

    $('#preciovprod').val(preciovta)
    importe = calcularimporte(cantidad, preciovta)

    $('#importeprod').val(
      Intl.NumberFormat('es-MX', { minimumFractionDigits: 2 }).format(
        parseFloat(importe).toFixed(2),
      ),
    )
  }

  document.getElementById('preciovprod').onblur = function () {
    precio = $('#preciolprod').val().replace(/,/g, '')
    preciovta = $('#preciovprod').val().replace(/,/g, '')
    descuento = calculardescuento(precio, preciovta)

    cantidad = $('#cantidadprod').val().replace(/,/g, '')

    $('#descuentoprod').val(descuento)
    importe = calcularimporte(cantidad, preciovta)

    $('#importeprod').val(
      Intl.NumberFormat('es-MX', { minimumFractionDigits: 2 }).format(
        parseFloat(importe).toFixed(2),
      ),
    )
  }

  //FUNCIONES DE CALCULO SERVICIOS

  document.getElementById('cantidadserv').onblur = function () {
    cantidad = $('#cantidadserv').val().replace(/,/g, '')
    precio = $('#preciovserv').val().replace(/,/g, '')
    importe = calcularimporte(cantidad, precio)

    $('#importeserv').val(
      Intl.NumberFormat('es-MX', { minimumFractionDigits: 2 }).format(
        parseFloat(importe).toFixed(2),
      ),
    )
  }

  document.getElementById('descuentoserv').onblur = function () {
    descuento = $('#descuentoserv').val().replace(/,/g, '')
    precio = $('#preciolserv').val().replace(/,/g, '')
    preciovta = calcularprecio(precio, descuento)
    cantidad = $('#cantidadserv').val().replace(/,/g, '')

    $('#preciovserv').val(preciovta)
    importe = calcularimporte(cantidad, preciovta)

    $('#importeserv').val(
      Intl.NumberFormat('es-MX', { minimumFractionDigits: 2 }).format(
        parseFloat(importe).toFixed(2),
      ),
    )
  }

  document.getElementById('preciovserv').onblur = function () {
    precio = $('#preciolserv').val().replace(/,/g, '')
    preciovta = $('#preciovserv').val().replace(/,/g, '')
    descuento = calculardescuento(precio, preciovta)

    cantidad = $('#cantidadserv').val().replace(/,/g, '')

    $('#descuentoserv').val(descuento)
    importe = calcularimporte(cantidad, preciovta)

    $('#importeserv').val(
      Intl.NumberFormat('es-MX', { minimumFractionDigits: 2 }).format(
        parseFloat(importe).toFixed(2),
      ),
    )
  }

  //AGREGAR PRODUCTO
  $(document).on('click', '#btnagregarprod', function () {
    folio = $('#folio').val()
    id = $('#idprod').val()
    idpqt = $('#idpaqtprod').val()
    tipo = $('#tipoprod').val()
    clave = $('#claveprod').val()
    concepto = $('#producto').val()
    cantidad = $('#cantidadprod').val()
    precio = $('#preciovprod').val().replace(/,/g, '')
    importe = $('#importeprod').val().replace(/,/g, '')

    if (
      id.length == 0 ||
      concepto.length == 0 ||
      cantidad.length == 0 ||
      precio.length == 0
    ) {
      Swal.fire({
        title: 'Datos Faltantes',
        text: 'Debe ingresar todos los datos',
        icon: 'warning',
      })
      return false
    } else {
      opcion = 1
      $.ajax({
        url: 'bd/crudtmpdetalle.php',
        type: 'POST',
        dataType: 'json',
        data: {
          folio: folio,
          id: id,
          idpqt: idpqt,
          tipo: tipo,
          clave: clave,
          concepto: concepto,
          cantidad: cantidad,
          precio: precio,
          importe: importe,
          opcion: opcion,
        },
        success: function (data) {
          console.log(data)
          if (data != 0) {
            mensaje()
            id_reg = data[0].id_reg
            id_item = data[0].id_item
            id_pqt = data[0].id_pqt
            clave = data[0].clave
            concepto = data[0].concepto
            cantidad = data[0].cantidad
            precio = data[0].precio
            subtotal = data[0].subtotal
            tipo = data[0].tipo_item
            estado = data[0].estado_det

            tablaDet.row
              .add([
                id_reg,
                id_item,
                id_pqt,
                clave,
                concepto,
                cantidad,
                precio,
                subtotal,
                estado,
                tipo,
              ])
              .draw()
            buscarsubtotal(folio)
          } else {
            Swal.fire({
              title: 'Operacion No Exitosa',
              icon: 'warning',
            })
          }
        },
        error: function () {
          Swal.fire({
            title: 'Operacion No Exitosa',
            icon: 'warning',
          })
        },
      })
    }
  })

  //AGREGAR SERVICIO
  $(document).on('click', '#btnagregarserv', function () {
    folio = $('#folio').val()
    id = $('#idserv').val()
    idpqt = $('#idpaqtserv').val()
    tipo = $('#tiposerv').val()
    clave = $('#claveserv').val()
    concepto = $('#servicio').val()
    cantidad = $('#cantidadserv').val()
    precio = $('#preciovserv').val().replace(/,/g, '')
    importe = $('#importeserv').val().replace(/,/g, '')

    if (
      id.length == 0 ||
      concepto.length == 0 ||
      cantidad.length == 0 ||
      precio.length == 0
    ) {
      Swal.fire({
        title: 'Datos Faltantes',
        text: 'Debe ingresar todos los datos',
        icon: 'warning',
      })
      return false
    } else {
      opcion = 1
      $.ajax({
        url: 'bd/crudtmpdetalle.php',
        type: 'POST',
        dataType: 'json',
        data: {
          folio: folio,
          id: id,
          idpqt: idpqt,
          tipo: tipo,
          clave: clave,
          concepto: concepto,
          cantidad: cantidad,
          precio: precio,
          importe: importe,
          opcion: opcion,
        },
        success: function (data) {
          console.log(data)
          if (data != 0) {
            mensaje()
            id = data[0].id_reg
            item = data[0].id_item
            pqt = data[0].id_pqt
            clav = data[0].clave
            concep = data[0].concepto
            cant = data[0].cantidad
            pre = data[0].precio
            sub = data[0].subtotal
            tip = data[0].tipo_item
            est = data[0].estado_det

            tablaDet.row
              .add([id, item, pqt, clav, concep, cant, pre, sub, est, tip])
              .draw()
            buscarsubtotal(folio)
          } else {
            Swal.fire({
              title: 'Operacion No Exitosa',
              icon: 'warning',
            })
          }
        },
        error: function () {
          Swal.fire({
            title: 'Operacion No Exitosa',
            icon: 'warning',
          })
        },
      })
    }
  })

  //borrar item grid
  $(document).on('click', '.btnborrarProd', function (event) {
    event.preventDefault();

    folio = $('#folio').val()
    fila = $(this);

    id = parseInt($(this).closest("tr").find('td:eq(0)').text());

    console.log(id)

    if (id.length == 0) {
      Swal.fire({
        title: 'Datos Faltantes',
        text: 'Debe ingresar todos los datos',
        icon: 'warning',
      })
      return false
    } else {
      opcion = 3
      $.ajax({
        url: 'bd/crudtmpdetalle.php',
        type: 'POST',
        dataType: 'json',
        data: {
          id: id,
          folio: folio,
          opcion: opcion,
        },
        success: function (data) {
          if (data != 0) {
            tablaDet.row(fila.parents('tr')).remove().draw()

            buscarsubtotal(folio)
          } else {
            Swal.fire({
              title: 'Operacion No Exitosa',
              icon: 'warning',
            })
          }
        },
        error: function () {
          Swal.fire({
            title: 'Operacion No Exitosa',
            icon: 'warning',
          })
        },
      })
    }
  })


  function buscarsubtotal(folio) {
    $.ajax({
      type: 'POST',
      url: 'bd/buscartotal.php',
      dataType: 'json',
      async: false,
      data: { folio: folio },
      success: function (res) {
        $('#subtotal').val(res[0].subtotal)
        $('#descuento').val(0)
        $('#total').val(res[0].total)
        $('#saldovta').val(res[0].total)
        $('#montoapagar').val(res[0].total)
      },
    })
  }

  //botón guardar
  $(document).on('click', '#btnGuardar', function () {
    fecha = $('#fecha').val()
    folio = $('#folio').val()
    foliovta = $('#foliovta').val()
    idclie = $('#idclie').val()
    cliente = $('#cliente').val()
    idcol = $('#idcol').val()
    colaborador = $('#colaborador').val()
    obs = $('#obs').val()
    subtotal = $('#subtotal').val()
    descuento = $('#descuento').val()
    total = $('#total').val()

    usuario = $('#iduser').val()
   

    if (
      idclie.length == 0 ||
      fecha.length == 0 ||
      folio.length == 0 ||
      idcol.length == 0 ||
      total.length == 0
    ) {
      Swal.fire({
        title: 'Datos Faltantes',
        text: 'Debe ingresar todos los datos marcados con *',
        icon: 'warning',
      })
      return false
    } else {
      if (foliovta == 0) {
        opcion = 1
        $.ajax({
          url: 'bd/crudtmpventa.php',
          type: 'POST',
          dataType: 'json',
          async:false,
          data: {
            folio: folio,
            fecha: fecha,
            idclie: idclie,
            cliente: cliente,
            idcol: idcol,
            colaborador: colaborador,
            obs: obs,
            subtotal: subtotal,
            descuento: descuento,
            total: total,
            usuario: usuario,
            opcion: opcion,
          },
          success: function (data) {
            if (data != 0) {
              Swal.fire({
                title: 'Venta Guardada',
                icon: 'success',
                timer: 1000,
              })
              window.setTimeout(function () {
                window.location.href = 'venta.php?folio=' + data
              }, 2500)
            } else {
              Swal.fire({
                title: 'Operacion No Exitosa',
                icon: 'warning',
              })
            }
          },
          error: function () {
            Swal.fire({
              title: 'Error en funcion',
              icon: 'warning',
            })
          },
        })
      } else {
        /* MODIFICAR VENTA
        opcion = 2
        $.ajax({
          url: 'bd/crudregistro.php',
          type: 'POST',
          dataType: 'json',
          data: {
            idpx: idpx,
            fecha: fecha,
            idconcepto: idconcepto,
            concepto: concepto,
            obs: obs,
            subtotal: subtotal,
            descuento: descuento,
            total: total,
            usuario: usuario,
            precio: precio,
            registro: registro,
            opcion: opcion,
          },
          success: function (data) {
            if (data == 1) {
              window.location.href = 'cntadiario.php'
            } else {
              Swal.fire({
                title: 'Operacion No Exitosa',
                icon: 'warning',
              })
            }
          },
        })
*/
      }
    }
  })

  // boton buscar concepto
  $(document).on('click', '#bconcepto', function () {
    $('#modalConcepto').modal('show')
  })

  // boton buscar cliente
  $(document).on('click', '#bcliente', function () {
    $('#modalcliente').modal('show')
  })

  //boton buscar colaborador
  $(document).on('click', '#bcolaborador', function () {
    $('#modalcol').modal('show')
  })
  //boton buscar producto
  $(document).on('click', '#bproducto', function () {
    $('#modalproducto').modal('show')
  })

  //BOTON BUSCAR SERVICIO

  $(document).on('click', '#btnServicio', function () {
    //buscarservicios()
    $('#modalServicio').modal('show')
  })

  //funcion buscar servicios

  function buscarservicios(folio) {
    tablaservicio.clear()
    tablaservicio.draw()
    $.ajax({
      type: 'POST',
      url: 'bd/servicios.php',
      dataType: 'json',
      data: {},
      success: function (res) {
        for (var i = 0; i < res.length; i++) {
          tablaservicio.row
            .add([
              res[i].id_pqt,
              res[i].id_serv,
              res[i].clave_pqt,
              res[i].desc_pqt,
              res[i].nom_tipo,
              res[i].sesiones_pqt,
              res[i].precio_pqt,
              ,
            ])
            .draw()
        }
      },
    })
  }

  //botón seleccionar concepto
  $(document).on('click', '.btnSelprod', function () {
    fila = $(this)
    idprod = parseInt($(this).closest('tr').find('td:eq(0)').text())
    clave = $(this).closest('tr').find('td:eq(1)').text()
    producto = $(this).closest('tr').find('td:eq(2)').text()
    preciol = $(this).closest('tr').find('td:eq(4)').text()
    $('#idprod').val(idprod)
    $('#claveprod').val(clave)
    $('#producto').val(producto)
    $('#preciolprod').val(preciol)
    $('#preciovprod').val(preciol)
    $('#descuentoprod').val(0)

    $('#cantidadprod').prop('disabled', false)
    $('#preciovprod').prop('disabled', false)
    $('#descuentoprod').prop('disabled', false)

    $('#modalproducto').modal('hide')
  })

  //btnSelservicio

  $(document).on('click', '.btnSelservicio', function () {
    fila = $(this)
    idserv = parseInt($(this).closest('tr').find('td:eq(0)').text())
    idpaq = $(this).closest('tr').find('td:eq(1)').text()
    clave = $(this).closest('tr').find('td:eq(2)').text()
    servicio = $(this).closest('tr').find('td:eq(3)').text()
    preciol = $(this).closest('tr').find('td:eq(6)').text()

    $('#idserv').val(idserv)
    $('#idpaqtserv').val(idpaq)
    $('#claveserv').val(clave)
    $('#servicio').val(servicio)
    $('#preciolserv').val(preciol)
    $('#preciovserv').val(preciol)
    $('#descuentoserv').val(0)

    $('#cantidadserv').prop('disabled', false)
    $('#preciovserv').prop('disabled', false)
    $('#descuentoserv').prop('disabled', false)

    $('#modalServicio').modal('hide')
  })

  //limpiar producto
  $(document).on('click', '#btlimpiarprod', function () {
    $('#claveconcepto').val('')
    $('#concepto').val('')
    $('#id_umedida').val('')
    $('#usomat').val('')
    $('#nom_umedida').val('')
    $('#bmaterial').prop('disabled', true)
    $('#clavemat').val('')
    $('#material').val('')
    $('#clave').val('')
    $('#idprecio').val('')
    $('#unidad').val('')

    $('#precio').val('')
    $('#cantidad').val('')

    $('#cantidad').prop('disabled', true)
    //$('#cantidad').attr('disabled', 'disabled');
  })

  //boton seleccionar cliente
  $(document).on('click', '.btnSelcliente', function () {
    fila = $(this)
    idclie = parseInt($(this).closest('tr').find('td:eq(0)').text())
    clie = $(this).closest('tr').find('td:eq(1)').text()
    $('#idclie').val(idclie)
    $('#cliente').val(clie)
    $('#modalcliente').modal('hide')
  })

  //boton seleccionar colaborador

  $(document).on('click', '.btnSelcol', function () {
    fila = $(this)
    idcol = parseInt($(this).closest('tr').find('td:eq(0)').text())
    col = $(this).closest('tr').find('td:eq(1)').text()
    $('#idcol').val(idcol)
    $('#colaborador').val(col)
    $('#modalcol').modal('hide')
  })

  //monto de descuento
  document.getElementById('descuento').onblur = function () {
    descuento = $('#descuento').val().replace(/,/g, '')
    subtotal = $('#subtotal').val().replace(/,/g, '')

    if (descuento.length > 0) {
      if (parseFloat(descuento) > 0) {
        if (parseFloat(descuento) <= parseFloat(subtotal)) {
          $('#total').val(calculodes(descuento, subtotal))
        } else {
          descuento_excedido()
          $('#total').val(0)
          $('#descuento').val(subtotal)
        }
      } else {
        $('#total').val($('#subtotal').val())
        $('#descuento').val(0)
      }
    } else {
      descuento_no_valido()
      $('#total').val($('#subtotal').val())
      $('#descuento').val(0)
    }
  }

  //metodo de pago
  /*
  $(document).on('change', '#metodo', function () {
    //console.log($('#metodo').children("option:selected").text())
    if ($('#metodo').val() == '01') {
      $('#divpago').show()
    } else {
      $('#divpago').hide()
    }
  })
*/

  //monto a pagar
  /*
  document.getElementById('montoapagar').onblur = function () {
    monto = $('#montoapagar').val().replace(/,/g, '')
    saldo = $('#saldovta').val().replace(/,/g, '')

    if (monto.length > 0) {
      if (parseFloat(monto) > 0) {
        if (parseFloat(monto) <= parseFloat(saldo)) {
        } else {
          monto_excedido()
          $('#montoapagar').val(saldo)
        }
      } else {
        monto_no_valido()
       
      }
    } else {
      monto_no_valido()
    }
  }
*/

  /*
  document.getElementById('pago').onblur = function () {
    pago = $('#pago').val().replace(/,/g, '')
    montoapagar = $('#montoapagar').val().replace(/,/g, '')

    if (pago.length > 0) {
      if (parseFloat(pago) > 0) {
        if (parseFloat(pago) >= parseFloat(montoapagar)) {

          $('#cambio').val(pago-montoapagar)

        } else {
          pago_insuficiente()
          $('#pago').val(montoapagar)
          $('#cambio').val(0)
        }
      } else {
        pago_no_valido()
        $('#pago').val(montoapagar)
        $('#cambio').val(0)
       
      }
    } else {
      pago_no_valido()
      $('#pago').val(montoapagar)
      $('#cambio').val(0)
    }
  }

*/
  /*
  function monto_excedido(){
    Swal.fire({
      title: 'Monto a Pagar no Valido',
      text:'El Monto a Pagar no puede exceder el Saldo de la Venta',
      icon: 'warning',
    })
  }

  function monto_no_valido(){
    Swal.fire({
      title: 'Monto a Pagar no Valido',
      icon: 'warning',
    })
  }
*/
  function descuento_excedido() {
    Swal.fire({
      title: 'Descuento no Valido',
      text: 'El descuento no puede exceder el monto de la venta',
      icon: 'warning',
    })
  }

  function descuento_no_valido() {
    Swal.fire({
      title: 'Descuento no Valido',
      icon: 'warning',
    })
  }
  /*
  function pago_insuficiente(){
    Swal.fire({
      title: 'Pago Insuficiente',
      text:'El Pago debe ser mayor o igual al Monto a Pagar',
      icon: 'warning',
    })
  }

  function pago_no_valido(){
    Swal.fire({
      title: 'Pago no Valido',
      icon: 'warning',
    })
  }
*/
  function calculodes(desc, tot) {
    gtotal = round(tot - desc, 2)
    return gtotal
  }

  function round(value, decimals) {
    return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals)
  }

  function mensaje() {
    swal.fire({
      title: 'Registro Exitoso',
      icon: 'success',
      focusConfirm: true,
      confirmButtonText: 'Aceptar',
    })
  }
})

function filterFloat(evt, input) {
  // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
  var key = window.Event ? evt.which : evt.keyCode
  var chark = String.fromCharCode(key)
  var tempValue = input.value + chark
  var isNumber = key >= 48 && key <= 57
  var isSpecial = key == 8 || key == 13 || key == 0 || key == 46
  if (isNumber || isSpecial) {
    return filter(tempValue)
  }

  return false
}
function filter(__val__) {
  var preg = /^([0-9]+\.?[0-9]{0,2})$/
  return preg.te
  st(__val__) === true
}
