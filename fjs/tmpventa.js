$(document).ready(function () {
    var id_concepto, opcion
    opcion = 4
    var fila 

   /* $('.card-btn').click(function() {
     
      $(this).find('i').toggleClass('fas fa-plus fas fa-minus')
     // $('.collapse').collapse('hide');
      
  });*/

  
  


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
   /* { width: '10%', targets: 0 },
    { width: '10%', targets: 1 },
    { width: '40%', targets: 2 },
    { width: '10%', targets: 3 },
    { width: '10%', targets: 4 },
    { width: '10%', targets: 5 },
    { width: '10%', targets: 6 },*/
   
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
  

    /*
    $(document).on('click', '#btnaddproducto', function () {
      console.log($('#addservicio').is(":visible"))
      if($('#addservicio').is(":visible") ==true){
       
        $('#addservicio').hide()
        $('#btnaddservicio').find('i').toggleClass('fas fa-plus fas fa-minus')
      }
      $('#addproducto').show()
      $('#btnaddproducto').find('i').toggleClass('fas fa-plus fas fa-minus')
    });


    $(document).on('click', '#btnaddservicio', function () {
      console.log($('#addservicio').is(":visible"))
      if($('#addproducto').is(":visible") ==true){
       
        $('#addproducto').hide()
        $('#btnaddproducto').find('i').toggleClass('fas fa-plus fas fa-minus')
      }
      $('#addservicio').show()
      $('#btnaddservicio').find('i').toggleClass('fas fa-plus fas fa-minus')
    });*/
  
 
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
    //BUSCAR PRODUCTO
  })

  
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
  