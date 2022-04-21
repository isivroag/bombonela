<?php
$pagina = "cliente";

include_once "templates/header.php";
include_once "templates/barra.php";
include_once "templates/navegacion.php";




include_once 'bd/conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();
$fecha = date('Y-m-d');

$consulta = "SELECT * FROM vcitap2 where estado<>3 and estado<>4 order by folio_citap";
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

<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header bg-gradient-green text-light">
                <h1 class="card-title mx-auto">CLIENTES</h1>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-lg-12">

                        <button id="btnNuevo" type="button" class="btn bg-gradient-info btn-ms" data-toggle="modal"><i class="fas fa-plus-square text-light"></i><span class="text-light"> Cita Prospecto</span></button>
                        <button id="btnNuevox" type="button" class="btn bg-gradient-green btn-ms" data-toggle="modal"><i class="fas fa-plus-square text-light"></i><span class="text-light"> Cita Cliente</span></button>
                    </div>
                </div>
                <br>
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-sm-2">
                            <div class="form-group input-group-sm">
                                <label for="fecha" class="col-form-label">Fecha:</label>

                                <div class="form-group input-group date" id="datetimepicker1" data-date-format="YYYY-MM-DD" data-target-input="nearest">
                                    <input type="date" id="fecha" name="fecha" class="form-control" autocomplete="off" placeholder="Fecha" value=<?php echo $fecha ?>>

                                </div>
                                <!--
                  <div class="input-group date form_datetime" data-date="" data-date-format="yyyy-mm-dd HH:ii:00" data-link-field="dtp_input1">
                        <input class="form-control" type="text" value="" readonly>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                    </div>
                    <input type="hidden" id="dtp_input1" value="" /><br/>
                    -->
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table name="tablaV" id="tablaV" class="table table-sm table-striped table-bordered  table-hover table-condensed text-nowrap w-auto mx-auto" style="width:100%">
                                    <thead class="text-center bg-gradient-green">
                                        <tr>
                                            <th>HORARIO/CABINA</th>
                                            <?php foreach ($datacab as $rowcab) { ?>
                                                <th class="font-weight-bold"><?php echo  $rowcab['nom_cabina'] ?></th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $horaInicial = "09:00";

                                        do {
                                        ?>
                                            <tr>
                                                <td><?php echo $horaInicial ?></td>
                                                <?php
/*
                                                foreach ($datacab as $rowcab) {
                                                    $cabina = $rowcab['id_cabina'];
                                                    $consulta = "call showcitas('$fecha','$horaInicial','$cabina'";
                                                    $resultado = $conexion->prepare($consulta);
                                                    $resultado->execute();
                                                    if ($resultado->rowCount() > 0) {
                                                        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach ($data as $rowcita) {
                                                            echo '<td>' . $rowcita['title'] . '</td>';
                                                        }
                                                    } else {*/
                                                        echo '<td></td>';
                                                 /*   }
                                                }*/


                                                ?>

                                              
                                            </tr>
                                        <?php
                                            $minutoAnadir = 30;
                                            $segundos_horaInicial = strtotime($horaInicial);
                                            $segundos_minutoAnadir = $minutoAnadir * 60;
                                            $horaInicial = date("H:i", $segundos_horaInicial + $segundos_minutoAnadir);
                                        } while ($horaInicial <= "21:00");


                                        ?>

                                        <?php

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




</div>


<?php include_once 'templates/footer.php'; ?>
<script src="fjs/vcalendario.js?v=<?php echo (rand()); ?>"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>