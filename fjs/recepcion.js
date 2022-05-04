$(document).ready(function () {
    var id_usuario, opcion
    opcion = 4
  
    var date_input = document.getElementById('fecha')
  
    date_input.onchange = function () {
      window.location.href="recepcion.php?fecha="+this.value
    }
  
    tablacal = $('#tablacal').DataTable({
      stateSave: true,
      paging: false,
      ordering:false,
      info:false,
     



      columnDefs: [{
        targets: -1,
        data: null,
        defaultContent:  "<div class='text-center'><button class='btn btn-sm btn-success  btnconfirmar'  data-toggle='tooltip' data-placement='top' title='Comienzo de Cita'><i class='fas fa-check-circle'></i></button>\
        <button class='btn btn-sm bg-info  btnSalir'><i class='fas fa-sign-out-alt'  data-toggle='tooltip' data-placement='top' title='Cita Terminada'></i></button>\
        <button class='btn btn-sm btn-danger btnCancelar'><i class='fas fa-ban'  data-toggle='tooltip' data-placement='top' title='Cancelar Cita'></i></button>\
        <button class='btn btn-sm bg-danger  btnNollego'><i class='fas fa-user-slash '  data-toggle='tooltip' data-placement='top' title='No llego Cliente'></i></button></div>"
    }, { className: "hide_column", "targets": [1] },
    { className: "hide_column", "targets": [2] },
    { className: "hide_column", "targets": [4] },
    { className: "hide_column", "targets": [9] },
    
    { className: "hide_column", "targets": [11] }


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



      rowCallback: function (row, data) {

        $($(row).find('td')[10]).css('background-color', data[11]);
        $($(row).find('td')[10]).css('color',"white");
        $($(row).find('td')[10]).css('font-weight:',"bold");


        if (data[13] == 1) {
            icono = '<i class="fas fa-hospital-user text-info fa-2x text-center"></i>';
            $($(row).find('td')[13]).html(icono)
            //$($(row).find('td')[3]).css('background-color', '#77BCF5');
        }
        else if (data[13] == 2){
            icono = '<i class="fas fa-user-check text-success fa-2x text-center"></i>';
            $($(row).find('td')[13]).html(icono)
            //$($(row).find('td')[3]).css('background-color', '#A6EBC5');
        }else if (data[13] == 3){
            icono = '<i class="fas fa-user-slash text-danger fa-2x text-center"></i>';
            $($(row).find('td')[13]).html(icono)
            //$($(row).find('td')[3]).css('background-color', '#A6EBC5');
        }else if (data[13]==4){
            icono = '<i class="fas fa-ban text-danger fa-2x text-center"></i>';
            $($(row).find('td')[13]).html(icono)
        }else{
            icono = '<i class="fas fa-user-clock text-warning fa-2x text-center"></i>';
            $($(row).find('td')[13]).html(icono)
        }
        

        if (data[6] == 1) {
            icono = '<i class="fas fa-user text-success fa-2x text-center"></i>';
     
            $($(row).find('td')['6']).html(icono)
        } else if (data[6] == 0) {
            icono = '<i class="fas fa-user text-primary fa-2x text-center"></i>';
         
            $($(row).find('td')['6']).html(icono)
        }

        if (data[14] == 1) {
            icono = '<i class="fas fa-phone text-success fa-2x text-center"></i>';
            $($(row).find('td')[14]).html(icono)
        
        }
        else if (data[14]==2){
            icono = '<i class="fas fa-phone-slash text-danger fa-2x text-center"></i>';
            $($(row).find('td')[14]).html(icono)
        
        } else if (data[14]==3) {
            icono = '<i class="fas fa-ban text-danger fa-2x text-center"></i>';
            $($(row).find('td')[14]).html(icono)

        }else{
            icono = '<i class="fas fa-phone-alt text-secondary fa-2x text-center"></i>';
            $($(row).find('td')[14]).html(icono)
        }
    },

    })
  

    $(document).on("click", ".btnconfirmar", function () {
        fila = $(this);

        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 1;



        $.ajax({

            url: "bd/buscarcita.php",
            type: "POST",
            dataType: "json",
            async: "false",
            data: { id: id, opcion: opcion },

            success: function (data) {
               

                if (data == 0) {
                    Swal.fire({
                        title: 'Cita No Encontrada',
                        icon: 'error',
                    })
                }
                else {
                    tipo = data[0].tipo_p;
                    id_pros = data[0].id_pros;
                    id_px = data[0].id_px;
                    if (tipo == 1) {
                        Swal.fire({
                            title: 'El Cliente ya se encuentra registrado',
                            icon: 'success',
                        })
                    }
                    else {
                        Swal.fire({
                            title: 'Cliente Nuevo',
                            text: 'Es necesario tomar los datos generales',
                            icon: 'info',
                            timer: 2000,
                        }),
                            $.ajax({
                                url: "bd/buscarprospecto.php",
                                type: "POST",
                                dataType: "json",
                                async: "false",
                                data: { id_pros: id_pros },
                                success: function (prospecto) {
                                    if (prospecto == 0) {
                                        Swal.fire({
                                            title: 'Contacto No Encontrado',
                                            icon: 'error',
                                        })
                                    }
                                    else {
                                        nom_prospecto = prospecto[0].nom_pros;
                                        tel_prospecto = prospecto[0].tel_pros;
                                        cel_prospecto = prospecto[0].cel_pros;
                                        
                                        $("#formDatos").trigger("reset");
                                        
                                        $("#nombre").val(nom_prospecto);
                                        $("#id_cita").val(id);
                                        $("#id_pros").val(id_pros);
                                        $("#tel").val(tel_prospecto);
                                        $("#cel").val(cel_prospecto);

                                        $(".modal-title").text("Nuevo Paciente");
                                        $("#modalCRUD").modal("show");

                                    }


                                }

                            })


                    }


                }
            }
        });

    });

    $(document).on("click", ".btnSalir", function () {
        fila = $(this);

        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 2;



        $.ajax({

            url: "bd/buscarcita.php",
            type: "POST",
            dataType: "json",
            async: "false",
            data: { id: id, opcion: opcion },

            success: function (data) {
                Swal.fire({
                    title: "Operación Exitosa",
                    text: "Cliente Termino su Cita",
                    icon: "success",
                    timer:1000,
                });
                window.setTimeout(function() {
                    window.location.href = "recepcion.php";
                }, 1500);
            }
        });
    });


    $(document).on("click", "#btnGuardar", function () {
       
        opcion=4;
        id_pros =  $("#id_pros").val()
        id_cita =  $("#id_cita").val()
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
            id_pros: id_pros,
            id_cita: id_cita,
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
                    Swal.fire({
                        title: "Operación Exitosa",
                        text: "Cliente Registrado",
                        icon: "success",
                        timer:1000,
                    });
                    window.setTimeout(function() {
                        window.location.href = "recepcion.php";
                    }, 1500);
                  
                  
                }
            ,
            error : function(){
                Swal.fire({
                    title: "Error en Funcion",
                    text: "Cliente no Registrado",
                    icon: "error",
                    timer:1000,
                });
            }
        });
            $("#modalCRUD").modal("hide");
        }
    });


    $(document).on("click", ".btnNoConfirmar", function () {
        fila = $(this);
        opcion=7;
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        $.ajax({

            url: "bd/buscarcita.php",
            type: "POST",
            dataType: "json",
            async: "false",
            data: { id: id, opcion: opcion },

            success: function (data) {
                Swal.fire({
                    title: "Paciente No Confirmó la cita",
                    text: "Cita Suspendida",
                    icon: "warning",
                    timer:1000,
                });


                buscar();
            
            }
        });
    });


    function buscar(){
        fechad =   $("#fecha").val();
        tablacal.clear();
        tablacal.draw();

        $.ajax({

            url: "bd/buscarcalendario.php",
            type: "POST",
            dataType: "json",
            async: "false",
            data: { fechad: fechad },

            success: function (data) {
                for (var i = 0; i < data.length; i++) {
                
                    tablacal.row
                        .add([
                            data[i].id,
                            data[i].start,
                            data[i].end,
                            data[i].start,
                            data[i].id_cabina,
                            data[i].nom_cabina,
                            data[i].tipo_p,
                            data[i].title,
                            data[i].descripcion,
                            data[i].id_per,
                            data[i].nombre,
                            data[i].color,
                            data[i].duracion,
                            data[i].confirmar,
                        ])
                        .draw()
                }
            }

        });

    }

    $(document).on("click", ".btnCancelar", function () {
        fila = $(this);
        opcion=4;
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        $("#formcan").trigger("reset");
        $(".modal-header").css("color", "white");
        $("#modalcan").modal("show");
        $("#foliocan").val(id);
    });
   

    $(document).on("click", "#btnGuardarc", function() {
        motivo = $("#motivo").val();
        id = $("#foliocan").val();
        fecha = $("#fechac").val();
        usuario = $("#nameuser").val();
        $("#modalcan").modal("hide");
        opcion=4;
    ;

        if (motivo === "") {
            swal.fire({
                title: "Datos Incompletos",
                text: "Verifique sus datos",
                icon: "warning",
                focusConfirm: true,
                confirmButtonText: "Aceptar",
            });
        } else {
            $.ajax({
                type: "POST",
                url: "bd/buscarcita.php",
                async: false,
                dataType: "json",
                data: {
                    id: id, opcion: opcion,
                    motivo: motivo,
                    fecha: fecha,
                    usuario: usuario,
                },
                success: function(data) {
                    if (data[0].id == id) {
                        mensaje();
                        window.setTimeout(function() {
                           buscar();
                        }, 1500);
                    } else {
                        mensajeerror();
                    }
                },
            });
        }
    });

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


    function mensaje() {
        swal.fire({
            title: "Registro Cancelado",
            icon: "success",
            focusConfirm: true,
            confirmButtonText: "Aceptar",
            timer: 2000
        });
    }

    function mensajeerror() {
        swal.fire({
            title: "Error al Cancelar el Registro",
            icon: "error",
            focusConfirm: true,
            confirmButtonText: "Aceptar",
        });
    }
  })
  