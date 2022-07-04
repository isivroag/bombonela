<?php
$pagina = "vcalendario";

include_once "templates/header.php";
include_once "templates/barra.php";
include_once "templates/navegacion.php";




include_once 'bd/conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();
if (isset($_GET['fecha'])) {
    $fecha = $_GET['fecha'];
} else {
    $fecha = date('Y-m-d');
}


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
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
<!--Datetimepicker Bootstrap -->

<!--
<link rel="stylesheet" href="plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">
-->
<!--tempusdominus-bootstrap-4 -->
<link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.css">



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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table name="tablacal" id="tablacal" class="table table-sm  table-bordered  table-hover table-condensed text-nowrap w-auto mx-auto " style="font-size:12px;vertical-align: center!important;">
                                    <thead class="text-center bg-gradient-green">
                                        <tr>
                                            <th>HR/CAB</th>
                                            <?php foreach ($datacab as $rowcab) { ?>
                                                <th class="font-weight-bold"><?php echo  $rowcab['nom_cabina'] ?></th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $horaInicial = "09:00";


                                        $arreglo = array();
                                        do {
                                        ?>
                                            <tr>
                                                <td><?php echo $horaInicial ?></td>
                                                <?php


                                                $horatope =  date("H:i", strtotime($horaInicial) + 1800);


                                                foreach ($datacab as $rowcab) {
                                                    $cabina = $rowcab['id_cabina'];
                                                    $consulta = "SELECT * FROM vcitap2 where estado<>3 and estado<>4 and date(start)='$fecha' and time(start)='$horaInicial'  and id_cabina='$cabina'";
                                                    $resultado = $conexion->prepare($consulta);
                                                    $resultado->execute();
                                                    if ($resultado->rowCount() > 0) {
                                                        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach ($data as $rowcita) {
                                                            if ($rowcita['duracion'] == 30) {
                                                                echo
                                                                '<td>
                                                                    <div class="card tarjetacita" id=' . $rowcita['id'] . ' value=' . $rowcita['id'] . ' style:"font-size:12px!important">
                                                                        <div class="card-header m-0 p-1 text-light" style="background-color:' . $rowcita['color'] . '">
                                                                            <span>' . $rowcita['title'] . '</span>
                                                                        </div>
                                                                        <div class="card-body p-1" style:"font-size:10px">
                                                                            <span>' . $rowcita['descripcion'] . '</span><br>
                                                                            <span>' . $rowcita['nombre'] . ' </span>
                                                                        </div>
                                                                    </div>
                                                                </td>';
                                                            } else {
                                                                echo    '<td rowspan="2 " style="vertical-align: middle!important;" >
                                                                            <div class="container text-center  ">
                                                                                <div class="card tarjetacita" id=' . $rowcita['id'] . ' value=' . $rowcita['id'] . ' style:"font-size:12px!important">
                                                                                    <div class="card-header m-0 p-1 text-light" style="background-color:' . $rowcita['color'] . '">
                                                                                        <span>' . $rowcita['title'] . '</span>
                                                                                    </div>
                                                                                    <div class="card-body p-1" style:"font-size:10px">
                                                                                        <span>' . $rowcita['descripcion'] . '</span><br>
                                                                                        <span>' . $rowcita['nombre'] . ' </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>';

                                                                $horaf = $horaInicial;
                                                                $minutoAnadir = 30;
                                                                $segundos_horaf = strtotime($horaf);
                                                                $segundos_minutoAnadir = $minutoAnadir * 60;
                                                                $horaf = date("H:i", $segundos_horaf + $segundos_minutoAnadir);


                                                                $nuevoregistro = array("hora" =>  $horaf, "cabina" => $cabina);
                                                                $registro = (object) $nuevoregistro;
                                                                array_push($arreglo, $registro);
                                                            }
                                                        }
                                                    } else {
                                                        /*
                                                        echo '<td>';
                                                        foreach ($arreglo as $info=>$p)
                                                        {
                                                          
                                                            echo $p->hora.'<br>' ;
                                                         
                                                            echo $p->cabina.'<br>';

                                                            }
                                                        echo '</td>';
*/                                                         $encontrado=0;
                                                        foreach($arreglo as $info => $p){
                                                            if($p->hora == $horaInicial && $p->cabina == $cabina){
                                                                $encontrado=1;
                                                            }
                                                        }
                                                        if ($encontrado==0){
                                                            echo '<td></td>';
                                                        }
                                                    }
                                                }


                                                ?>


                                            </tr>
                                        <?php
                                            $minutoAnadir = 30;
                                            $segundos_horaInicial = strtotime($horaInicial);
                                            $segundos_minutoAnadir = $minutoAnadir * 60;
                                            $horaInicial = date("H:i", $segundos_horaInicial + $segundos_minutoAnadir);
                                        } while ($horaInicial <= "19:30");


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



    <!-- CITAS DE PROSPECTOS-->

    <section>
        <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-info">
                        <h5 class="modal-title" id="exampleModalLabel">Agendar Cita Prospecto</h5>

                    </div>
                    <form id="formDatos" action="" method="POST">
                        <div class="modal-body row">


                            <div class="col-sm-12">
                                <div class="form-group input-group-sm">
                                    <input type="hidden" class="form-control" name="tipop" id="tipop" value="0">
                                    <input type="hidden" class="form-control" name="folio" id="folio">
                                    <input type="hidden" class="form-control" name="id_pros" id="id_pros">
                                    <label for="nombre" class="col-form-label">Prospecto:</label>

                                    <div class="input-group ">

                                        <input type="text" class="form-control" name="nom_pros" id="nom_pros" autocomplete="off" placeholder="Prospecto" readonly>
                                        <span class="input-group-append">
                                            <button id="bcliente" type="button" class="btn btn-primary "><i class="fas fa-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group input-group-sm">
                                    <label for="responsable" class="col-form-label">Responsable:</label>
                                    <select class="form-control" name="responsable" id="responsable">
                                        <?php
                                        foreach ($datai as $dti) {
                                        ?>
                                            <option id="col<?php echo $dti['id_col'] ?>" value="<?php echo $dti['id_col'] ?>"> <?php echo $dti['nom_col'] ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <div class="form-group input-group-sm">
                                    <label for="concepto" class="col-form-label">Concepto Cita</label>
                                    <input type="text" class="form-control" name="concepto" id="concepto" autocomplete="off" placeholder="Concepto de Cita">
                                </div>
                            </div>

                            <div class="col-sm-5">
                                <div class="form-group input-group-sm auto">
                                    <label for="cabina" class="col-form-label">Cabina:</label>
                                    <select class="form-control" name="cabina" id="cabina">
                                        <?php
                                        foreach ($datacab as $dtcab) {

                                        ?>
                                            <option id="cab<?php echo $dtcab['id_cabina'] ?>" value="<?php echo $dtcab['id_cabina'] ?>"> <?php echo $dtcab['nom_cabina'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-sm-2">
                                <div class="form-group input-group-sm auto">
                                    <label for="duracion" class="col-form-label">Duración(min.):</label>
                                    <select class="form-control" name="duracion" id="duracion">
                                        <option id="t30" value="30"> 30</option>
                                        <option id="t60" value="60"> 60</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-sm-3">
                                <div class="form-group input-group-sm">
                                    <label for="fechap" class="col-form-label">Fecha:</label>

                                    <input type="date" id="fechap" name="fechap" class="form-control">


                                </div>

                            </div>
                            <div class="col-sm-2">
                                <div class="form-group input-group-sm auto">
                                    <label for="hora" class="col-form-label">Hora:</label>
                                    <select class="form-control" name="hora" id="hora">
                                        <!--        <?php
                                                    $horaI = "09:00:00";
                                                    do {
                                                    ?>
                                            <option value="<?php echo $horaI ?>"><?php echo $horaI ?></option>
                                        <?php
                                                        $minutoAnadir = 30;
                                                        $segundos_horaInicial = strtotime($horaI);
                                                        $segundos_minutoAnadir = $minutoAnadir * 60;
                                                        $horaI = date("H:i:s", $segundos_horaInicial + $segundos_minutoAnadir);
                                                    } while ($horaI <= "19:30:00");
                                        ?>-->

                                    </select>
                                </div>
                            </div>




                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="obs" class="col-form-label">Observaciones:</label>
                                    <textarea class="form-control" name="obs" id="obs" rows="3" autocomplete="off" placeholder="Observaciones"></textarea>
                                </div>
                            </div>




                        </div>



                        <div class="modal-footer row d-flex justify-content-between">

                            <div class="col-sm-3 d-flex">

                                <button type="button" id="btnCancelarcta" class="btn btn-danger btn-block"><i class="fas fa-ban"></i> Cancelar Cita</button>
                            </div>
                            <div class="col-sm-3 d-flex">
                                <button type="button" id="btnreagendar" name="btnreagendar" class="btn btn-primary btn-block" value="btnreagendar"><i class="far fa-save"></i> Guardar Cita</button>
                            </div>
                            <div class="col-sm-3 d-flex">
                                <button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-success btn-block" value="btnGuardar"><i class="far fa-save"></i> Guardar Cita</button>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">

            <!-- Default box -->
            <div class="modal fade" id="modalProspecto" tabindex="-7" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl " role="document">
                    <div class="modal-content w-auto">
                        <div class="modal-header bg-gradient-info">
                            <h5 class="modal-title" id="exampleModalLabel">BUSCAR PROSPECTO</h5>

                        </div>
                        <br>
                        <div class="table-hover table-responsive w-auto" style="padding:15px">
                            <table name="tablaC" id="tablaC" class="table  table-sm table-striped table-bordered table-condensed" style="width:100%">
                                <thead class="text-center bg-gradient-info">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Telefono</th>
                                        <th>Celular</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($datac as $datc) {
                                    ?>
                                        <tr>
                                            <td><?php echo $datc['id_pros'] ?></td>
                                            <td><?php echo $datc['nom_pros'] ?></td>
                                            <td><?php echo $datc['tel_pros'] ?></td>
                                            <td><?php echo $datc['cel_pros'] ?></td>

                                            <td></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>


                    </div>

                </div>
                <!-- /.card-body -->

                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </div>
    </section>


    <!-- CITA DE PACIENTES -->

    <section>
        <div class="modal fade" id="modalpx" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-green">
                        <h5 class="modal-title" id="exampleModalLabel">Agendar Cita Cliente</h5>

                    </div>
                    <form id="formDatospx" action="" method="POST">
                        <div class="modal-body row">


                            <div class="col-sm-12">
                                <div class="form-group input-group-sm">
                                    <input type="hidden" class="form-control" name="tipopx" id="tipopx" value="1">
                                    <input type="hidden" class="form-control" name="foliox" id="foliox">
                                    <input type="hidden" class="form-control" name="id_prosx" id="id_prosx">
                                    <label for="nombrex" class="col-form-label">Cliente:</label>

                                    <div class="input-group">

                                        <input type="text" class="form-control" name="nom_prosx" id="nom_prosx" autocomplete="off" placeholder="Cliente" readonly>
                                        <span class="input-group-append">
                                            <button id="bclientex" type="button" class="btn btn-primary "><i class="fas fa-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group  input-group-sm">
                                    <label for="responsablex" class="col-form-label">Responsable:</label>
                                    <select class="form-control" name="responsablex" id="responsablex">
                                        <?php
                                        foreach ($datai as $dti) {
                                        ?>
                                            <option id="<?php echo $dti['id_col'] ?>" value="<?php echo $dti['id_col'] ?>"> <?php echo $dti['nom_col'] ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <div class="form-group input-group-sm">
                                    <label for="conceptox" class="col-form-label">Concepto Cita</label>
                                    <input type="text" class="form-control" name="conceptox" id="conceptox" autocomplete="off" placeholder="Concepto de Cita">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group input-group-sm auto">
                                    <label for="cabinax" class="col-form-label">Cabina:</label>
                                    <select class="form-control" name="cabinax" id="cabinax">
                                        <?php
                                        foreach ($datacab as $dtcab) {

                                        ?>
                                            <option id="cab<?php echo $dtcab['id_cabina'] ?>" value="<?php echo $dtcab['id_cabina'] ?>"> <?php echo $dtcab['nom_cabina'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group input-group-sm auto">
                                    <label for="duracionx" class="col-form-label">Duración(min.):</label>
                                    <select class="form-control" name="duracion" id="duracionx">
                                        <option id="t30x" value="30"> 30</option>
                                        <option id="t60x" value="60"> 60</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="form-group input-group-sm">
                                    <label for="fechax" class="col-form-label">Fecha Y Hora:</label>

                                    <div class="form-group input-group date" id="datetimepicker1x" data-date-format="YYYY-MM-DD HH:mm:00" data-target-input="nearest">
                                        <input type="text" id="fechax" name="fechax" class="form-control datetimepicker-input " style="height:calc(1.8125rem + 2px);" data-target="#datetimepicker1x" autocomplete="off" placeholder="Fecha y Hora">
                                        <div class="form-group input-group-append " data-target="#datetimepicker1x" data-toggle="datetimepicker">
                                            <div class="input-group-text btn-primary"><i class="fa fa-calendar"></i></div>
                                        </div>
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



                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="obsx" class="col-form-label">Observaciones:</label>
                                    <textarea class="form-control" name="obsx" id="obsx" rows="3" autocomplete="off" placeholder="Observaciones"></textarea>
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
                        <div class="modal-footer row d-flex justify-content-between">

                            <div class="col-sm-3 d-flex">
                                <button type="button" id="btnCancelarctax" class="btn btn-danger btn-block"><i class="fas fa-ban"></i> Cancelar Cita</button>
                            </div>
                            <div class="col-sm-3 d-flex">
                                <button type="button" id="btnreagendarx" name="btnreagendarx" class="btn btn-primary btn-block" value="btnreagendar"><i class="far fa-save"></i> Guardar Cita</button>
                            </div>
                            <div class="col-sm-3 d-flex">
                                <button type="button" id="btnGuardarx" name="btnGuardarx" class="btn btn-success btn-block" value="btnGuardarx"><i class="far fa-save"></i> Guardar Cita</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">


            <div class="modal fade" id="modalProspectox" tabindex="-3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl " role="document">
                    <div class="modal-content w-auto">
                        <div class="modal-header bg-gradient-green">
                            <h5 class="modal-title" id="exampleModalLabel">BUSCAR CLIENTE</h5>

                        </div>
                        <br>
                        <div class="table-hover table-responsive w-auto" style="padding:15px">
                            <table name="tablaCx" id="tablaCx" class="table  table-sm table-striped table-bordered table-condensed" style="width:100%">
                                <thead class="text-center bg-gradient-green">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Telefono</th>
                                        <th>Celular</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($datacx as $datcx) {
                                    ?>
                                        <tr>
                                            <td><?php echo $datcx['id_clie'] ?></td>
                                            <td><?php echo $datcx['nom_clie'] ?></td>
                                            <td><?php echo $datcx['tel_clie'] ?></td>
                                            <td><?php echo $datcx['ws_clie'] ?></td>

                                            <td></td>
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
                                        <label for="motivo" class="col-form-label">Motivo de Cancelacioón:</label>
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
<script src="fjs/vcalendario.js?v=<?php echo (rand()); ?>"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/fullcalendar/main.min.js"></script>
<script src='plugins/fullcalendar/locales-all.js'></script>
<script src='plugins/fullcalendar/locales/es.js'></script>
<script src="plugins/fullcalendar-daygrid/main.min.js"></script>
<script src="plugins/fullcalendar-timegrid/main.min.js"></script>
<script src="plugins/fullcalendar-interaction/main.min.js"></script>
<script src="plugins/fullcalendar-bootstrap/main.js"></script>


<!--Datetimepicker Bootstrap -->
<!--
<script src="plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script src="plugins/bootstrap-datetimepicker/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
-->
<!--tempusdominus-bootstrap-4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/locale/es.js"></script>