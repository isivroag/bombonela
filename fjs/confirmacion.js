$(document).ready(function () {
    var id_usuario, opcion, rol
    opcion = 4
    var textcolumnas = permisos()

  
    var date_input = document.getElementById('fecha')
    
  

    function permisos() {
        var tipousuario = $('#tipousuario').val()
        var columnas = ''
    
        if (tipousuario != 1) {
          columnas =
          "<div class='text-center'><button class='btn btn-sm btn-success  btnAceptar data-toggle='tooltip' data-placement='top' title='Confirmar Cita''><i class='fas fa-phone'></i></button>\
          <button class='btn btn-sm btn-warning text-light btnNoConfirmar' data-toggle='tooltip' data-placement='top' title='No se localizo'><i class='fas fa-phone-slash'></i></button>\
          <button class='btn btn-sm btn-danger btnCancelar' data-toggle='tooltip' data-placement='top' title='Cancelar Cita'><i class='fas fa-ban'></i></button></div>"
        } else {
          columnas =
          "<div class='text-center'><button class='btn btn-sm btn-success  btnAceptar data-toggle='tooltip' data-placement='top' title='Confirmar Cita''><i class='fas fa-phone'></i></button>\
        <button class='btn btn-sm btn-warning text-light btnNoConfirmar' data-toggle='tooltip' data-placement='top' title='No se localizo'><i class='fas fa-phone-slash'></i></button>\
        </div>"
        }
        return columnas
      }
    
    date_input.onchange = function () {
      window.location.href="confirmacion.php?fecha="+this.value
    }
  
    tablacal = $('#tablacal').DataTable({
      stateSave: true,
      paging: false,
      ordering:false,
      info:false,
     



      columnDefs: [{
        targets: -1,
        data: null,
        defaultContent: textcolumnas,
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

           
/*
        //estado de la cita
        if (data[8] == 1) {
            icono = '<i class="fas fa-hospital-user text-info fa-2x text-center"></i>';
            $($(row).find('td')[8]).html(icono)
            //$($(row).find('td')[3]).css('background-color', '#77BCF5');
        }
        else if (data[8] == 2){
            icono = '<i class="fas fa-user-check text-success fa-2x text-center"></i>';
            $($(row).find('td')[8]).html(icono)
            //$($(row).find('td')[3]).css('background-color', '#A6EBC5');
        }else if (data[8] == 3){
            icono = '<i class="fas fa-user-slash text-danger fa-2x text-center"></i>';
            $($(row).find('td')[8]).html(icono)
            //$($(row).find('td')[3]).css('background-color', '#A6EBC5');
        }else if (data[8]==4){
            icono = '<i class="fas fa-ban text-danger fa-2x text-center"></i>';
            $($(row).find('td')[8]).html(icono)
        }else{
            icono = '<i class="fas fa-user-clock text-warning fa-2x text-center"></i>';
            $($(row).find('td')[8]).html(icono)
        }
*/
        $($(row).find('td')[10]).css('background-color', data[11]);
        $($(row).find('td')[10]).css('color',"white");
        $($(row).find('td')[10]).css('font-weight:',"bold");

        if (data[6] == 1) {
            icono = '<i class="fas fa-user text-success fa-2x text-center"></i>';
            //$($(row).find("td")[6]).css("background-color", "warning");
            //$($(row).find('td')[2]).addClass('bg-gradient-secondary')
            $($(row).find('td')['6']).html(icono)
        } else if (data[6] == 0) {
            icono = '<i class="fas fa-user text-primary fa-2x text-center"></i>';
            //$($(row).find("td")[2]).css("background-color", "blue");
            //$($(row).find('td')[2]).addClass('bg-gradient-green')
            $($(row).find('td')['6']).html(icono)
        }

        if (data[13] == 1) {
            icono = '<i class="fas fa-phone text-success fa-2x text-center"></i>';
            $($(row).find('td')[13]).html(icono)
            //$($(row).find('td')[3]).css('background-color', '#77BCF5');
        }
        else if (data[13]==2){
            icono = '<i class="fas fa-phone-slash text-danger fa-2x text-center"></i>';
            $($(row).find('td')[13]).html(icono)
            //$($(row).find('td')[3]).css('background-color', '#A6EBC5');
        } else if (data[13]==3) {
            icono = '<i class="fas fa-ban text-danger fa-2x text-center"></i>';
            $($(row).find('td')[13]).html(icono)

        }else{
            icono = '<i class="fas fa-phone-alt text-secondary fa-2x text-center"></i>';
            $($(row).find('td')[13]).html(icono)
        }
    },

    })
  

    $(document).on("click", ".btnAceptar", function () {
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 6;

        $.ajax({

            url: "bd/buscarcita.php",
            type: "POST",
            dataType: "json",
            async: "false",
            data: { id: id, opcion: opcion },

            success: function (data) {
                Swal.fire({
                    title: "Cita Confirmada",
                    text: "Paciente Confirmó su Cita",
                    icon: "success",
                    timer:1000,
                });

               

                buscar();
          
            }
        });
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
        /*$(".modal-header").css("background-color", "#28a745");*/
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
  