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

  //boton pagar
  $(document).on('click', '#btnPagar', function () {
    $("#formPago").trigger("reset");
    $('#saldovtap').val($('#saldo').val())
    $('#modalPago').modal('show')
  })



  function commaSeparateNumber(val) {
    while (/(\d+)(\d{3})/.test(val.toString())) {
      val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2')
    }

    return val
  }





  function buscarsubtotal(folio) {
    $.ajax({
      type: 'POST',
      url: 'bd/buscartotal.php',
      dataType: 'json',
      //async: false,
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











  //metodo de pago

  $(document).on('change', '#metodo', function () {
    //console.log($('#metodo').children("option:selected").text())
    if ($('#metodo').val() == '01') {
      $('#divpago').show()
    } else {
      $('#divpago').hide()
      $('#pago').val($('#montoapagar').val())
    }
  })


  //monto a pagar
  document.getElementById('montoapagar').onblur = function () {
    monto = $('#montoapagar').val().replace(/,/g, '')
    saldo = $('#saldovtap').val().replace(/,/g, '')

    if (monto.length > 0) {
      if (parseFloat(monto) > 0) {
        if (parseFloat(monto) <= parseFloat(saldo)) {
        } else {
          monto_excedido()
          $('#montoapagar').val(saldo)
          monto=saldo
        }
      } else {
        monto_no_valido()

      }
    } else {
      monto_no_valido()
    }

    valor = monto;
    //ajax para convertir el numero a letras
    $.ajax({

      url: "bd/convertirletras.php",
      type: "POST",
      dataType: "json",
      async: false,
      data: { valor: valor },

      success: function (res) {
        $('#letras').val(res);
      }
    });
  }


  //boton buscar colaborador
  $(document).on('click', '#bcolaborador', function () {
    $('#modalcol').modal('show')
  })


  //boton seleccionar colaborador

  $(document).on('click', '.btnSelcol', function () {
    fila = $(this)
    idcol = parseInt($(this).closest('tr').find('td:eq(0)').text())
    col = $(this).closest('tr').find('td:eq(1)').text()
    $('#idcolp').val(idcol)
    $('#colaboradorp').val(col)
    $('#modalcol').modal('hide')
  })


  document.getElementById('pago').onblur = function () {
    pago = $('#pago').val().replace(/,/g, '')
    montoapagar = $('#montoapagar').val().replace(/,/g, '')

    if (pago.length > 0) {
      if (parseFloat(pago) > 0) {
        if (parseFloat(pago) >= parseFloat(montoapagar)) {

          $('#cambio').val(pago - montoapagar)

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
    valor = montoapagar;
    //ajax para convertir el numero a letras
    $.ajax({

      url: "bd/convertirletras.php",
      type: "POST",
      dataType: "json",
      async: false,
      data: { valor: valor },

      success: function (res) {
        $('#letras').val(res);
      }
    });
  }


  function monto_excedido() {
    Swal.fire({
      title: 'Monto a Pagar no Valido',
      text: 'El Monto a Pagar no puede exceder el Saldo de la Venta',
      icon: 'warning',
    })
  }

  function monto_no_valido() {
    Swal.fire({
      title: 'Monto a Pagar no Valido',
      icon: 'warning',
    })
  }



  function pago_insuficiente() {
    Swal.fire({
      title: 'Pago Insuficiente',
      text: 'El Pago debe ser mayor o igual al Monto a Pagar',
      icon: 'warning',
    })
  }

  function pago_no_valido() {
    Swal.fire({
      title: 'Pago no Valido',
      icon: 'warning',
    })
  }


  //botono pagar


  $(document).on('click', '#btnGuardar', function () {

    foliocxc = $('#folio').val()
    fechapago = $('#fechapago').val()
    importepago = $('#montoapagar').val().replace(/,/g, '')
    idmetodo = $('#metodo').val()
    metodo = $('#metodo').children("option:selected").text()
    if ($('#metodo').val() == '01') {
    dinero = $('#pago').val().replace(/,/g, '')
    }
    else{
      dinero = $('#montoapagar').val().replace(/,/g, '')
    }
    cambio = $('#cambio').val().replace(/,/g, '')
    idcol = $('#idcolp').val().replace(/,/g, '')
    colaborador = $('#colaboradorp').val()
    tipopago = 0
    if ($('#facturado').prop('checked')) {
      tipopago = 1
    }

    saldoini = $('#saldovtap').val().replace(/,/g, '')
    saldofin = saldoini - importepago
    letras = $('#letras').val()
    opcion = 1




    if (
      foliocxc.length == 0 ||
      importepago.length == 0 ||
      idmetodo.length == 0 ||
      letras.length == 0
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
        url: 'bd/crudpago.php',
        type: 'POST',
        dataType: 'json',
        data: {
          foliocxc: foliocxc,
          fechapago: fechapago,
          importepago: importepago,
          idmetodo: idmetodo,
          metodo: metodo,
          dinero: dinero,
          cambio: cambio,
          idcol: idcol,
          colaborador: colaborador,
          tipopago: tipopago,
          saldoini: saldoini,
          saldofin: saldofin,
          letras: letras,
          opcion: opcion,
        },
        success: function (data) {
          console.log(data)
          if (data != 0) {

            Swal.fire({
              title: 'Pago Registrado',
              icon: 'success',
              timer: 1000,
            })
            window.setTimeout(function () {
              window.location.href = "cntaventa.php"
            }, 1500);

          } else {
            Swal.fire({
              title: 'Operacion No Exitosa',
              icon: 'warning',
            })
          }
        },
        error: function () {
          Swal.fire({
            title: 'Funcion No Exitosa',
            icon: 'warning',
          })
        },
      })

    }
  });


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
