<?php
$pagina = "buscadoragenda";

include_once "templates/header.php";
include_once "templates/barra.php";
include_once "templates/navegacion.php";




include_once 'bd/conexion.php';
$objeto = new conn();
$message = "";
$conexion = $objeto->connect();
if (isset($_GET['fecha'])) {
    $fecha = $_GET['fecha'];
} else {
    $fecha = date('Y-m-d');
}


$consulta = "SELECT * FROM vcitap2 where estado<>3 and estado<>4 and date(start)='$fecha' order by start,id_cabina";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

$consultac = "SELECT * FROM prospecto where id_clie=0 and estado_pros =1 order by id_pros";
$resultadoc = $conexion->prepare($consultac);
$resultadoc->execute();
$datac = $resultadoc->fetchAll(PDO::FETCH_ASSOC);


$consultacx = "SELECT * FROM wcliente where estado_clie='1' order by id_clie";
$resultadocx = $conexion->prepare($consultacx);
$resultadocx->execute();
$datacx = $resultadocx->fetchAll(PDO::FETCH_ASSOC);


$consultai = "SELECT * FROM colaborador WHERE estado_col ='1' ORDER BY id_col";
$resultadoi = $conexion->prepare($consultai);
$resultadoi->execute();
$datai = $resultadoi->fetchAll(PDO::FETCH_ASSOC);

$consultacab = "SELECT * FROM cabina WHERE estado_cabina ='1' ORDER BY id_cabina";
$resultadocab = $conexion->prepare($consultacab);
$resultadocab->execute();
$datacab = $resultadocab->fetchAll(PDO::FETCH_ASSOC);

?>
<style>
    .punto {
        height: 20px !important;
        width: 20px !important;

        border-radius: 50% !important;
        display: inline-block !important;
        text-align: center;
        font-size: 15px;
    }

    #div_carga {
        position: absolute;
        /*top: 50%;
    left: 50%;
    */

        width: 100%;
        height: 100%;
        background-color: rgba(60, 60, 60, 0.5);
        display: none;

        justify-content: center;
        align-items: center;
        z-index: 3;
    }

    #cargador {
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: -25px;
        margin-left: -25px;
    }

    #textoc {
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: 120px;
        margin-left: 20px;


    }
</style>
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">

            <div id="div_carga">

                <img id="cargador" src="img/loader.gif" />
                <span class=" " id="textoc"><strong>Cargando...</strong></span>

            </div>
            <div class="card-header bg-gradient-green text-light">
                <h1 class="card-title mx-auto">Vista de Calendario</h1>
            </div>

            <div class="card-body">

                <div class="row justify-content-center">
                    <div class="col-sm-4">
                        <div class="form-group form-group-sm">
                            <label for="txtbuscar" class="col-form-label">Introduzca el nombre del Prospecto o Cliente:</label>

                            <div class="input-group input-group-sm">
                                <input type="text" name="txtbuscar" id="txtbuscar" class="form-control">
                                <span class="input-group-append">
                                    <button type="button" name="btnbuscar" id="btnbuscar" class="btn bg-gradient-green btn-flat">Buscar</button>
                                </span>
                            </div>
                            <div class="form-check form-group-sm text-center">
                                <input class="form-check-input" name="incluir" id="incluir" type="checkbox">
                                <label class="form-check-label">Incluir Historial</label>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="container-fluid">



                    <div class="row justify-content-center">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table name="tablacal" id="tablacal" class="table table-sm  table-bordered  table-hover table-condensed text-nowrap w-auto mx-auto " style="font-size:12px;vertical-align: center!important;">
                                    <thead class="text-center bg-gradient-green">
                                        <tr>
                                            <th>Folio Cita</th>
                                            <th>Fecha y Hora</th>
                                            <th>Fin</th>
                                            <th>Hora</th>
                                            <th>Id Cabina</th>
                                            <th>Cabina</th>
                                            <th>Tipo</th>
                                            <th>Cliente/Prospecto</th>
                                            <th>Motivo de Cita</th>

                                            <th>Id Resp</th>
                                            <th>Responsable</th>
                                            <th>Color</th>
                                            <th>Duracion</th>
                                           

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data as $row) {
                                            $separar = (explode(" ", $row['start']));
                                        ?>
                                            <tr>
                                                <td><?php echo $row['id'] ?></td>
                                                <td><?php echo $row['start'] ?></td>
                                                <td><?php echo $row['end'] ?></td>
                                                <td><?php echo $separar[1] ?></td>
                                                <td><?php echo $row['id_cabina'] ?></td>
                                                <td><?php echo $row['nom_cabina'] ?></td>
                                                <td class="text-center"><?php echo $row['tipo_p'] ?></td>
                                                <td><?php echo $row['title'] ?></td>
                                                <td><?php echo $row['descripcion'] ?></td>
                                                <td><?php echo $row['id_per'] ?></td>
                                                <td><?php echo $row['nombre'] ?></td>
                                                <td><?php echo $row['color'] ?></td>
                                                <td class="text-center"><?php echo $row['duracion'] ?></td>
                                              
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->

            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <section>
        <div class="modal fade" id="modalcan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-danger">
                        <h5 class="modal-title" id="exampleModalLabel">CANCELAR REGISTRO</h5>
                    </div>
                    <div class="card card-widget" style="margin: 10px;">
                        <form id="formcan" action="" method="POST">
                            <div class="modal-body row">
                                <div class="col-sm-12">
                                    <div class="form-group input-group-sm">
                                        <label for="motivo" class="col-form-label">Motivo de Cancelación:</label>
                                        <textarea rows="3" class="form-control" name="motivo" id="motivo" placeholder="Motivo de Cancelación"></textarea>
                                        <input type="hidden" id="fechac" name="fechac" value="<?php echo $fecha ?>">
                                        <input type="hidden" id="foliocan" name="foliocan" value="">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <?php
                    if ($message != "") {
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <span class="badge "><?php echo ($message); ?></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                        <button type="button" id="btnGuardarc" name="btnGuardarc" class="btn btn-success" value="btnGuardarc"><i class="far fa-save"></i> Guardar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>



</div>


<?php include_once 'templates/footer.php'; ?>
<script src="fjs/buscadoragenda.js?v=<?php echo (rand()); ?>"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>