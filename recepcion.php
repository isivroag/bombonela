<?php
$pagina = "recepcion";

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


$consulta = "SELECT * FROM vcitap2 where  estado<>4 and date(start)='$fecha' order by start,id_cabina";
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




$cntam = "SELECT * FROM wmedios WHERE estado_medio=1 ORDER BY id_medio";
$res = $conexion->prepare($cntam);
$res->execute();
$datamedio = $res->fetchAll(PDO::FETCH_ASSOC);

$cntae = "SELECT * FROM wnivele WHERE estado_nivele=1 ORDER BY id_nivele";
$rese = $conexion->prepare($cntae);
$rese->execute();
$dataestudios = $rese->fetchAll(PDO::FETCH_ASSOC);

$cntaestado = "SELECT * FROM westadoc WHERE estado_estadoc=1 ORDER BY id_estadoc";
$resestado = $conexion->prepare($cntaestado);
$resestado->execute();
$dataestado = $resestado->fetchAll(PDO::FETCH_ASSOC);


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
                <h1 class="card-title mx-auto">Vista de Calendario</h1>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-lg-12">
                        <!--
                        <button id="btnNuevo" type="button" class="btn bg-gradient-info btn-ms" data-toggle="modal"><i class="fas fa-plus-square text-light"></i><span class="text-light"> Cita Prospecto</span></button>
                        <button id="btnNuevox" type="button" class="btn bg-gradient-green btn-ms" data-toggle="modal"><i class="fas fa-plus-square text-light"></i><span class="text-light"> Cita Cliente</span></button>
-->
                    </div>
                </div>
                <br>
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-sm-2">
                            <div class="form-group input-group-sm">
                                <label for="fecha" class="col-form-label">Fecha:</label>
                                <input type="date" id="fecha" name="fecha" class="form-control" autocomplete="off" placeholder="Fecha" value=<?php echo $fecha ?>>

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
                                            <th>Estado</th>
                                            <th>Acciones</th>

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
                                                <td class="text-center"><?php echo $row['confirmar'] ?></td>
                                                <td class="text-center"></td>
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
    <section>
        <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-green">
                        <h5 class="modal-title" id="exampleModalLabel">NUEVO CLIENTE</h5>

                    </div>
                    <div class="card card-widget" style="margin: 10px;">
                        <form id="formDatos" action="" method="POST">
                            <div class="modal-body row">

                            <input type="hidden" class="form-control" name="id_cita" id="id_cita" autocomplete="off" >
                            <input type="hidden" class="form-control" name="id_pros" id="id_pros" autocomplete="off" >

                                <div class="col-sm-12">
                                    <div class="form-group input-group-sm">
                                        <label for="nombre" class="col-form-label">Nombre:</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre" autocomplete="off" placeholder="Nombre">
                                    </div>
                                </div>

                                <div class="col-sm-3">

                                    <div class="form-group input-group-sm auto">
                                        <label for="genero" class="col-form-label">Genero:</label>
                                        <select class="form-control" name="genero" id="genero">
                                            <option id="FEMENINO" value="FEMENINO"> FEMENINO</option>
                                            <option id="MASCULINO" value="MASCULINO"> MASCULINO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group input-group-sm">
                                        <label for="curp" class="col-form-label">CURP:</label>
                                        <input type="text" class="form-control" name="curp" id="curp" autocomplete="off" placeholder="CURP">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group input-group-sm">
                                        <label for="rfc" class="col-form-label">RFC:</label>
                                        <input type="text" class="form-control" name="rfc" id="rfc" autocomplete="off" placeholder="RFC">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group input-group-sm">
                                        <label for="fechanac" class="col-form-label">Fecha de Nacimiento:</label>
                                        <input type="date" class="form-control" name="fechanac" id="fechanac" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group input-group-sm">
                                        <label for="dir" class="col-form-label">Dirección:</label>
                                        <textarea rows="2" type="text" class="form-control" name="dir" id="dir" autocomplete="off" placeholder="Dirección"></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group input-group-sm">
                                        <label for="correo" class="col-form-label">Correo Eléctronico:</label>
                                        <input type="text" class="form-control" name="correo" id="correo" autocomplete="off" placeholder="Correo Eléctronico">
                                    </div>
                                </div>



                                <div class="col-sm-3">
                                    <div class="form-group input-group-sm">
                                        <label for="tel" class="col-form-label">Tel:</label>
                                        <input type="text" class="form-control" name="tel" id="tel" autocomplete="off" placeholder="Teléfono">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group input-group-sm">
                                        <label for="cel" class="col-form-label">Whatsapp/Cel:</label>
                                        <input type="text" class="form-control" name="cel" id="cel" autocomplete="off" placeholder="Whatsapp">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group input-group-sm">
                                        <label for="ocupacion" class="col-form-label">Ocupación:</label>
                                        <input type="text" class="form-control" name="ocupacion" id="ocupacion" autocomplete="off" placeholder="Ocupación">
                                    </div>
                                </div>



                                <div class="col-sm-3">


                                    <div class="form-group input-group-sm auto">
                                        <label for="nivelestudios" class="col-form-label">Nivel de Estudios::</label>
                                        <select class="form-control" name="nivelestudios" id="nivelestudios">
                                            <?php
                                            foreach ($dataestudios as $dte) {
                                            ?>
                                                <option id="<?php echo $dte['id_nivele'] ?>" value="<?php echo $dte['nom_nivele'] ?>"> <?php echo $dte['nom_nivele'] ?></option>

                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-3">


                                    <div class="form-group input-group-sm auto">
                                        <label for="edocivil" class="col-form-label">Estado Civil:</label>
                                        <select class="form-control" name="edocivil" id="edocivil">
                                            <?php
                                            foreach ($dataestado as $dtedo) {
                                            ?>
                                                <option id="<?php echo $dtedo['id_estadoc'] ?>" value="<?php echo $dtedo['nom_estadoc'] ?>"> <?php echo $dtedo['nom_estadoc'] ?></option>

                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group input-group-sm auto">
                                        <label for="medio" class="col-form-label">Medio por el que nos conocio:</label>
                                        <select class="form-control" name="medio" id="medio">
                                            <?php
                                            foreach ($datamedio as $dtt) {
                                            ?>
                                                <option id="<?php echo $dtt['id_medio'] ?>" value="<?php echo $dtt['nom_medio'] ?>"> <?php echo $dtt['nom_medio'] ?></option>

                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm">
                                        <label for="nom_prox" class="col-form-label">Recomendado Por:</label>
                                        <div class="input-group input-group-sm">
                                            <input type="hidden" class="form-control" name="id_prox" id="id_prosx">
                                            <input type="text" class="form-control" name="nom_prosx" id="nom_prosx" disabled placeholder="Seleccionar al Cliente que Recomienda">
                                            <span class="input-group-append">
                                                <button id="bclientex" type="button" class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
                                            </span>
                                        </div>
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
                        <button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-success" value="btnGuardar"><i class="far fa-save"></i> Guardar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


</div>


<?php include_once 'templates/footer.php'; ?>
<script src="fjs/recepcion.js?v=<?php echo (rand()); ?>"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>