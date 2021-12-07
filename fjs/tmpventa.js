$(document).ready(function () {
    var id_concepto, opcion
    opcion = 4
    var fila 




  //TABLA PRODUCTO
  tablaDet = $('#tablaDet').DataTable({
    fixedHeader: true,
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
  function calcularimporte(cant,pv) {
    cantidad = cant
    precio=pv
    importe = round(cantidad * precio,2)
    return importe
    
  }

// CALCULO PRECIO VENTA 
  function calcularprecio(pl,desc) {
    precio = pl
    descuento=desc
    if (parseFloat(precio) > parseFloat(descuento)){
      pv = precio-descuento
    }
    else{
      pv=0
    }
      

    return pv
    
  }
//CALCULO INVERSO DESCUENTO
  function calculardescuento(pl,pvta) {
    preciol = pl
    precioventa=pvta
    if (parseFloat(preciol) >= parseFloat(precioventa)){
      pv = preciol-precioventa
    }
    else{
      pv=0
    }
      

    return pv
    
  }

  document.getElementById('cantidadprod').onblur = function () {
   
    cantidad=$('#cantidadprod').val().replace(/,/g, '')
    precio=$('#preciovprod').val().replace(/,/g, '')
    importe=calcularimporte(cantidad,precio)

    $('#importeprod').val(
      Intl.NumberFormat('es-MX', { minimumFractionDigits: 2 }).format(
        parseFloat(importe).toFixed(2),
      ))
  }


  document.getElementById('descuentoprod').onblur = function () {
   
    descuento=$('#descuentoprod').val().replace(/,/g, '')
    precio=$('#preciolprod').val().replace(/,/g, '')
    preciovta=calcularprecio(precio,descuento )
    cantidad=$('#cantidadprod').val().replace(/,/g, '')

    $('#preciovprod').val(
      Intl.NumberFormat('es-MX', { minimumFractionDigits: 2 }).format(
        parseFloat(preciovta).toFixed(2),
      ))
      importe=calcularimporte(cantidad,preciovta)

      $('#importeprod').val(
        Intl.NumberFormat('es-MX', { minimumFractionDigits: 2 }).format(
          parseFloat(importe).toFixed(2),
        ))
  }



  document.getElementById('preciovprod').onblur = function () {
   
    
    precio=$('#preciolprod').val().replace(/,/g, '')
    preciovta=$('#preciovprod').val().replace(/,/g, '')
    descuento=calculardescuento(precio,preciovta)

    cantidad=$('#cantidadprod').val().replace(/,/g, '')

    $('#descuentoprod').val(descuento  )
      importe=calcularimporte(cantidad,preciovta)

      $('#importeprod').val(
        Intl.NumberFormat('es-MX', { minimumFractionDigits: 2 }).format(
          parseFloat(importe).toFixed(2),
        ))
  }


  //FUNCIONES DE CALCULO SERVICIOS

  document.getElementById('cantidadserv').onblur = function () {
   
    cantidad=$('#cantidadserv').val().replace(/,/g, '')
    precio=$('#preciovserv').val().replace(/,/g, '')
    importe=calcularimporte(cantidad,precio)

    $('#importeserv').val(
      Intl.NumberFormat('es-MX', { minimumFractionDigits: 2 }).format(
        parseFloat(importe).toFixed(2),
      ))
  }


  document.getElementById('descuentoserv').onblur = function () {
   
    descuento=$('#descuentoserv').val().replace(/,/g, '')
    precio=$('#preciolserv').val().replace(/,/g, '')
    preciovta=calcularprecio(precio,descuento )
    cantidad=$('#cantidadserv').val().replace(/,/g, '')

    $('#preciovserv').val(
      Intl.NumberFormat('es-MX', { minimumFractionDigits: 2 }).format(
        parseFloat(preciovta).toFixed(2),
      ))
      importe=calcularimporte(cantidad,preciovta)

      $('#importeserv').val(
        Intl.NumberFormat('es-MX', { minimumFractionDigits: 2 }).format(
          parseFloat(importe).toFixed(2),
        ))
  }



  document.getElementById('preciovserv').onblur = function () {
   
    
    precio=$('#preciolserv').val().replace(/,/g, '')
    preciovta=$('#preciovserv').val().replace(/,/g, '')
    descuento=calculardescuento(precio,preciovta)

    cantidad=$('#cantidadserv').val().replace(/,/g, '')

    $('#descuentoserv').val(descuento  )
      importe=calcularimporte(cantidad,preciovta)

      $('#importeserv').val(
        Intl.NumberFormat('es-MX', { minimumFractionDigits: 2 }).format(
          parseFloat(importe).toFixed(2),
        ))
  }

  
 
    //botón guardar
    $(document).on('click', '#btnGuardar', function () {
      idpx = $("#idpx").val();;
      fecha = $("#fecha").val();
      idconcepto = $("#idconcepto").val();
      concepto = $("#concepto").val();
      obs = $("#obs").val();
      subtotal = $("#subtotal").val();
      descuento = $("#descuento").val();
      total = $("#total").val();
      precio = $("#precio").val();
      registro = $("#registro").val();
      usuario = $("#nameuser").val();
      console.log(registro);
  
      if (idpx.length == 0 || fecha.length == 0 || concepto.length == 0 ||  total.length == 0) {
        Swal.fire({
          title: 'Datos Faltantes',
          text: "Debe ingresar todos los datos del Prospecto",
          icon: 'warning',
        })
        return false;
      } else {
  
        if (registro == 0) {
          opcion = 1;
          $.ajax({
            url: "bd/crudregistro.php",
            type: "POST",
            dataType: "json",
            data: {
              idpx: idpx, fecha: fecha,
              idconcepto: idconcepto, concepto: concepto,
              obs: obs, subtotal: subtotal, descuento: descuento,
              total: total, usuario: usuario, precio: precio, registro: registro, opcion: opcion
            },
            success: function (data) {
              if (data == 1) {
                window.location.href = 'cntadiario.php'
              }
              else {
                Swal.fire({
                  title: 'Operacion No Exitosa',
                  icon: 'warning',
                })
              }
            }
          });
        } else {
  
          opcion = 2;
          $.ajax({
            url: "bd/crudregistro.php",
            type: "POST",
            dataType: "json",
            data: {
              idpx: idpx, fecha: fecha,
              idconcepto: idconcepto, concepto: concepto,
              obs: obs, subtotal: subtotal, descuento: descuento,
              total: total, usuario: usuario, precio: precio, registro: registro, opcion: opcion
            },
            success: function (data) {
              if (data == 1) {
                window.location.href = 'cntadiario.php'
              }
              else {
                Swal.fire({
                  title: 'Operacion No Exitosa',
                  icon: 'warning',
                })
              }
            }
          });
  
        }
  
  
      }
    });
  
  
  
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
      data: {  },
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
              res[i].precio_pqt,,
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

      $("#cantidadprod").prop("disabled", false);
      $("#preciovprod").prop("disabled", false);
      $("#descuentoprod").prop("disabled", false);
      
      $('#modalproducto').modal('hide')
    })

    //btnSelservicio

    $(document).on('click', '.btnSelservicio', function () {
      fila = $(this)
      idserv = parseInt($(this).closest('tr').find('td:eq(0)').text())
      idpaq = $(this).closest('tr').find('td:eq(1)').text()
      servicio = $(this).closest('tr').find('td:eq(3)').text()
      preciol = $(this).closest('tr').find('td:eq(6)').text()

      $('#idserv').val(idserv)
      $('#idpaqtser').val(idpaq)
      $('#servicio').val(servicio)
      $('#preciolserv').val(preciol)
      $('#preciovserv').val(preciol)
      $('#descuentoserv').val(0)

      $("#cantidadserv").prop("disabled", false);
      $("#preciovserv").prop("disabled", false);
      $("#descuentoserv").prop("disabled", false);
      
      $('#modalServicio').modal('hide')
    })


//limpiar producto
    $(document).on("click", "#btlimpiarprod", function() {
      $("#claveconcepto").val("");
      $("#concepto").val("");
      $("#id_umedida").val("");
      $("#usomat").val("");
      $("#nom_umedida").val("");
      $("#bmaterial").prop("disabled", true);
      $("#clavemat").val("");
      $("#material").val("");
      $("#clave").val("");
      $("#idprecio").val("");
      $("#unidad").val("");

      $("#precio").val("");
      $("#cantidad").val("");

      $("#cantidad").prop("disabled", true);
      //$('#cantidad').attr('disabled', 'disabled');
  });
  
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

  
    $('#descuento').on('change keyup paste click', function () {
      descuento = $('#descuento').val()
      subtotal = $('#subtotal').val()
      if (descuento.length > 0) {
        if (parseFloat(descuento) > 0) {
          if (parseFloat(descuento) <= parseFloat(subtotal)) {
            calculodes()
          } else {
            $('#total').val(0)
          }
        } else {
          $('#total').val($('#subtotal').val())
        }
      } else {
        $('#total').val($('#subtotal').val())
      }
    })
  

    
    function calculodes() {
      descuento = $('#descuento').val()
      gtotal = $('#subtotal').val()
      gtotal = round(gtotal - descuento, 2)
      $('#total').val(gtotal)
    }
  
    function round(value, decimals) {
      return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals)
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