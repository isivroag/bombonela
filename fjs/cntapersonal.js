$(document).ready(function() {
    var id, opcion;
    opcion = 4;

    tablaVis = $("#tablaV").DataTable({



        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><button class='btn btn-sm btn-primary  btnEditar'><i class='fas fa-edit'></i></button><button class='btn btn-sm btn-danger btnBorrar'><i class='fas fa-trash-alt'></i></button></div>"
        },
        { className: "hide_column", targets: [2] },
        { className: "hide_column", targets: [6] },
        
        
    ],

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
        },
        rowCallback: function (row, data) {
        
   
            $($(row).find('td')[8]).css('background-color',data[8]);
               
            
                   
                   //$($(row).find('td')[2]).addClass('bg-gradient-green')
                 
               
   
   
           },
    });

    $("#btnNuevo").click(function() {

        //window.location.href = "prospecto.php";
        $("#formDatos").trigger("reset");
        $(".modal-header").css("background-color", "#28a745");
        $(".modal-header").css("color", "white");
        
        $("#modalCRUD").modal("show");
        id = null;
        opcion = 1; //alta
    });

    var fila; //capturar la fila para editar o borrar el registro

    //botón EDITAR    
    $(document).on("click", ".btnEditar", function() {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());

        //window.location.href = "actprospecto.php?id=" + id;
        nombre = fila.find('td:eq(1)').text();
        dir = fila.find('td:eq(2)').text();
        tel = fila.find('td:eq(3)').text();
        cel = fila.find('td:eq(4)').text();
        correo = fila.find('td:eq(5)').text();
        idpuesto = fila.find('td:eq(6)').text();
        puesto = fila.find('td:eq(7)').text();
        color = fila.find('td:eq(8)').text();

      

        $("#nombre").val(nombre);
        $("#dir").val(dir);
        $("#tel").val(tel);
        $("#cel").val(cel);
        $("#correo").val(correo);
        $("#puesto").val(idpuesto);
        $("#color").val(color);
        $('.my-colorpicker2 .fa-square').css('color', color);
        opcion = 2; //editar

        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Personal");
        $("#modalCRUD").modal("show");

    });

    //botón BORRAR
    $(document).on("click", ".btnBorrar", function() {
        fila = $(this);

        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3 //borrar

        //agregar codigo de sweatalert2
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + id + "?");



        if (respuesta) {
            $.ajax({

                url: "bd/crudpersonal.php",
                type: "POST",
                dataType: "json",
                data: { id: id, opcion: opcion },

                success: function(data) {
                    console.log(fila);

                    tablaVis.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });



    $("#formDatos").submit(function(e) {
        e.preventDefault();
        var nombre = $.trim($("#nombre").val());
        var color = $.trim($("#color").val());
        var tel = $.trim($("#tel").val());
        var cel = $.trim($("#cel").val());
        var dir = $.trim($("#dir").val());
        var correo = $.trim($("#correo").val());
        var idpuesto= $.trim($("#puesto").val());
  
     

        if (nombre.length == 0  || tel.length == 0 || idpuesto.length == 0 || color.length == 0) {
            Swal.fire({
                title: 'Datos Faltantes',
                text: "Debe ingresar todos los datos requeridos",
                icon: 'warning',
            })
            return false;
        } else {
            $.ajax({
                url: "bd/crudpersonal.php",
                type: "POST",
                dataType: "json",
                data: { nombre: nombre,  tel: tel,  id: id, color: color, 
                    cel: cel, dir: dir, correo: correo, idpuesto : idpuesto,
                    opcion: opcion },
                success: function(data) {
                
                    id = data[0].id_col;
                    nombre = data[0].nom_col;
                    dir = data[0].dir_col;
                    tel = data[0].tel_col;
                    cel = data[0].cel_col;
                    correo = data[0].correo_col;
                    idpuesto = data[0].id_puesto;
                    nom_puesto = data[0].nom_puesto;
                    color = data[0].color_col;
                  
                    if (opcion == 1) {
                        tablaVis.row.add([id, nombre, dir, tel, cel, correo, idpuesto, nom_puesto, color,]).draw();
                    } else {
                        tablaVis.row(fila).data([id, nombre, dir, tel, cel, correo, idpuesto, nom_puesto, color,]).draw();
                    }
                }
            });
            $("#modalCRUD").modal("hide");
        }
    });

    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

});