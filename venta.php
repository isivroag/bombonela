<!-- CODIGO PHP-->
<?php
$pagina = "tmpventa";

include_once "templates/header.php";
include_once "templates/barra.php";
include_once "templates/navegacion.php";
require_once "bd/CifrasEnLetras.php";


include_once 'bd/conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();
$tokenid = md5($_SESSION['s_usuario']);
$usuario = $_SESSION['s_nombre'];
$idusuario = $_SESSION['s_usuario'];

$enpesos = new CifrasEnLetras();

if (isset($_GET['folio'])) {
    $folio = $_GET['folio'];


    $consultacon = "SELECT * FROM vcxc WHERE folio_cxc='$folio'";
    $resultadocon = $conexion->prepare($consultacon);
    $resultadocon->execute();

    if ($resultadocon->rowCount() > 0) {
        $datacon = $resultadocon->fetchAll(PDO::FETCH_ASSOC);
        foreach ($datacon as $row) {
            $folio = $row['folio_cxc'];
            $idclie = $row['id_clie'];
            $nom_clie = $row['nom_clie'];
            $fecha = $row['fecha_cxc'];
            $id_col = $row['id_col'];
            $nom_col = $row['nom_col'];
            $concepto = $row['concepto_cxc'];
            $subtotal = $row['subtotal_cxc'];
            $descuento = $row['descuento_cxc'];
            $total = $row['total_cxc'];
            $saldo = $row['saldo_cxc'];
            $foliotmp = 0;
            //$foliotmp = $row['folio_tmp'];
        }
    }
} else {
    $folio = 0;
    $idclie = 0;
    $nom_clie = "";
    $fecha = date('Y-m-d');
    $id_col = 0;
    $nom_col = "";
    $concepto = "";
    $subtotal = 0;
    $descuento = 0;
    $total = 0;
    $foliotmp = 0;
    $saldo = 0;
}

$message = "";







$consultadet = "SELECT * FROM cliente where estado_clie='1' ORDER BY id_clie";
$resultadodet = $conexion->prepare($consultadet);
$resultadodet->execute();
$dataclie = $resultadodet->fetchAll(PDO::FETCH_ASSOC);

$consultadet = "SELECT * FROM colaborador where estado_col='1' ORDER BY id_col";
$resultadodet = $conexion->prepare($consultadet);
$resultadodet->execute();
$datacol = $resultadodet->fetchAll(PDO::FETCH_ASSOC);


$consultamet = "SELECT * FROM metodo order by id_metodo";
$resultadomet = $conexion->prepare($consultamet);
$resultadomet->execute();
$datamet = $resultadomet->fetchAll(PDO::FETCH_ASSOC);




?>

<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="css/estilo.css">
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

<div class="content-wrapper">

    <section class="content">


        <div class="card">


            <div id="div_carga">

                <img id="cargador" src="img/loader.gif" />
                <span class=" " id="textoc"><strong>Cargando...</strong></span>

            </div>

            <div class="card-header bg-gradient-green text-light">
                <h1 class="card-title mx-auto">Información de Venta</h1>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-lg-12">


                        <!--<button id="btnNuevo" type="button" class="btn bg-gradient-green btn-ms" data-toggle="modal"><i class="fas fa-plus-square text-light"></i><span class="text-light"> Nuevo</span></button>-->
                        <button type="button" id="btnPagar" name="btnPagar" class="btn bg-gradient-green btn-ms" value="btnPagar"><i class="fas fa-money-bill"></i> Pagar</button>
                        <!--<button id="btnNuevo" type="button" class="btn bg-gradient-primary btn-ms" data-toggle="modal"><i class="fas fa-envelope-square"></i> Enviar</button>-->
                    </div>
                </div>

                <br>


                <!-- Formulario Datos de Cliente -->
                <form id="formventa" action="" method="POST">


                    <div class="content">

                        <div class="card card-widget" style="margin-bottom:0px;">

                            <div class="card-header bg-gradient-green " style="margin:0px;padding:8px">


                                <h1 class="card-title ">Información General</h1>
                            </div>

                            <div class="card-body" style="margin:0px;padding:1px;">

                                <div class="form-row justify-content-center">

                                    <div class="col-sm-2 ">

                                        <label for="fecha" class="col-form-label">Fecha*:</label>
                                        <div class="input-group input-group-sm">
                                            <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo $fecha; ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 ">

                                    </div>

                                    <div class="col-sm-2 ">
                                        <label for="folio" class="col-form-label">Folio:</label>

                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" name="folio" id="folio" value="<?php echo  $folio; ?> " disabled>
                                            <input type="hidden" class="form-control" name="foliotmp" id="foliotmp" value="<?php echo  $foliotmp; ?> " disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row justify-content-sm-center mb-2">
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-sm">


                                            <input type="hidden" class="form-control" name="tokenid" id="tokenid" value="<?php echo $idusuario; ?>">
                                            <input type="hidden" class="form-control" name="idclie" id="idclie" value="<?php echo $idclie; ?>">

                                            <label for="cliente" class="col-form-label">Cliente*:</label>

                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" name="cliente" id="cliente" value="<?php echo $nom_clie ?>" disabled placeholder="Seleccionar al Cliente">

                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-sm-8">
                                        <label for="colaborador" class="col-form-label">Colaborador*:</label>
                                        <div class="input-group input-group-sm">
                                            <input type="hidden" class="form-control" name="idcol" id="idcol" value="<?php echo $id_col; ?>">

                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" name="colaborador" id="colaborador" disabled placeholder="Seleccionar al Colaborador" value="<?php echo $nom_col; ?>">

                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-sm-8 ">
                                        <label for="obs" class="col-form-label">Observaciones:</label>

                                        <div class="input-group input-group-sm">
                                            <textarea rows="2" class="form-control" name="obs" id="obs" value="<?php echo $obs; ?>" placeholder="Observaciones" disabled> <?php echo $concepto ?></textarea>
                                        </div>
                                    </div>

                                </div>



                                <!-- AGREGAR SERVICIOS Y PRODUCTOS -->
                                <div class="card card-widget mb-0">
                                    <div class="card-header bg-gradient-green text-light">
                                        <h1 class="card-title mx-auto">Detalle de Venta</h1>
                                    </div>



                                    <div class="row">

                                        <div class="col-lg-12 mx-auto">

                                            <div class="table-responsive" style="padding:5px;">

                                                <table name="tablaDet" id="tablaDet" class="table table-sm table-striped table-bordered table-condensed text-nowrap mx-auto" style="width:100%;font-size:15px">
                                                    <thead class="text-center bg-gradient-green">
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Id Item</th>
                                                            <th>Id Paqt</th>
                                                            <th>Clave</th>
                                                            <th>Concepto</th>
                                                            <th>Cantidad</th>
                                                            <th>P.U.</th>
                                                            <th>Importe</th>
                                                            <th>Estado</th>
                                                            <th>Tipo</th>
                                                     

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $consultadeto = "SELECT * FROM det_cxc where folio_cxc='$folio' order by id_reg";
                                                        $resultadodeto = $conexion->prepare($consultadeto);
                                                        $resultadodeto->execute();
                                                        $datadeto = $resultadodeto->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach ($datadeto as $rowdet) {
                                                        ?>

                                                            <tr>
                                                                <td><?php echo $rowdet['id_reg'] ?></td>
                                                                <td><?php echo $rowdet['id_item'] ?></td>
                                                                <td><?php echo $rowdet['id_pqt'] ?></td>
                                                                <td><?php echo $rowdet['clave'] ?></td>
                                                                <td><?php echo $rowdet['concepto'] ?></td>
                                                                <td><?php echo $rowdet['cantidad'] ?></td>
                                                                <td><?php echo $rowdet['precio'] ?></td>
                                                                <td><?php echo $rowdet['subtotal'] ?></td>
                                                                <td><?php echo $rowdet['estado_det'] ?></td>
                                                                <td><?php echo $rowdet['tipo_item'] ?></td>

                                                           
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
                                <!-- TOTALES-->
                                <div class="card card-widget mt-0 ">
                                    <div class="card-header bg-gradient-green text-light">
                                        <h1 class="card-title mx-auto">Totales</h1>
                                    </div>
                                    <div class="card-body" style="margin:0px;padding:1px;">


                                        <div class="form-row justify-content-sm-center mt-0" style="margin-bottom: 10px;">

                                            <div class="col-sm-2">

                                                <label for="subtotal" class="col-form-label">Subtotal*:</label>
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-dollar-sign"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control text-right" name="subtotal" id="subtotal" value="<?php echo $subtotal ?>" disabled>
                                                </div>
                                            </div>

                                            <div class="col-sm-2">

                                                <label for="descuento" class="col-form-label">Descuento*:</label>
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-dollar-sign"></i>
                                                        </span>
                                                    </div>
                                                    <input type="number" class="form-control text-right" name="descuento" id="descuento" value="<?php echo $descuento ?>" disabled>
                                                </div>
                                            </div>

                                            <div class="col-sm-2">

                                                <label for="total" class="col-form-label">Total*:</label>

                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-dollar-sign"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control text-right" name="total" id="total" value="<?php echo $total ?>" disabled>
                                                </div>
                                            </div>

                                            <div class="col-sm-2">

                                                <label for="saldo" class="col-form-label">Saldo Actual:</label>

                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-dollar-sign"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control text-right" name="saldo" id="saldo" value="<?php echo $saldo ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>



                                <!-- SECCION DE PAGO -->


                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>





    </section>





    <!-- PAGO -->
    <section>


        <div class="container">

            <!-- Default box -->
            <div class="modal fade" id="modalPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-md" role="document">
                    <div class="modal-content w-auto">
                        <div class="modal-header bg-gradient-green">
                            <h5 class="modal-title" id="exampleModalLabel">Datos del Pago</h5>

                        </div>
                        <br>

                        <form id="fomrPago" action="" method="POST">
                            <div class="modal-body">

                                <div class="form-row justify-content-center mb-0 pb-0">
                                    <div class="col-sm-4 " style="padding:0 0 0 20px">
                                        <div class="form-group ">

                                            <div class="form-check">
                                                <input type="checkbox" class="custom-control-input" name="facturado" id="facturado">
                                                <label for="facturado" class="custom-control-label">Cliente Requiere Factura</label>

                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-sm-5"></div>
                                </div>

                                <div class="form-row justify-content-center">


                                    <div class="col-sm-3 ">

                                        <label for="fechapago" class="col-form-label">Fecha*:</label>
                                        <div class="input-group input-group-sm">
                                            <input type="date" class="form-control" name="fechapago" id="fechapago" value="<?php echo $fecha; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6"></div>



                                </div>

                                <div class="form-row justify-content-center">
                                    <div class="col-sm-9">
                                        <label for="colaboradorp" class="col-form-label">Colaborador*:</label>
                                        <div class="input-group input-group-sm">
                                            <input type="hidden" class="form-control" name="idcolp" id="idcolp" value="<?php echo $id_col; ?>">

                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" name="colaboradorp" id="colaboradorp" disabled placeholder="Seleccionar al Colaborador" value="<?php echo $nom_col; ?>">
                                                <span class="input-group-append">
                                                    <button id="bcolaborador" type="button" class="btn btn-sm bg-gradient-green"><i class="fas fa-search"></i></button>
                                                </span>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="form-row justify-content-center">


                                    <div class="col-sm-3">

                                        <label for="saldovtap" class="col-form-label">Saldo Actual:</label>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control text-right" name="saldovtap" id="saldovtap" value="<?php echo $subtotal ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 ">
                                        <div class="input-group-sm auto">
                                            <label for="metodo" class="col-form-label">Metodo de Pago:</label>
                                            <select class="form-control" name="metodo" id="metodo">
                                                <?php
                                                foreach ($datamet as $dtmet) {
                                                ?>
                                                    <option id="<?php echo $dtmet['id_metodo'] ?>" value="<?php echo $dtmet['id_metodo'] ?>"><?php echo $dtmet['nom_metodo'] ?></option>

                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-sm-3">

                                        <label for="montoapagar" class="col-form-label">Monto a Pagar:</label>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text  border-success ">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control text-right border-success" name="montoapagar" id="montoapagar">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-row justify-content-center" id="divpago" name="divpago">
                                    <div class="col-sm-3">
                                    </div>

                                    <div class="col-sm-3">

                                        <label for="pago" class="col-form-label">Pago Recibido:</label>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border-success">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </span>
                                            </div>
                                            <input type="number" class="form-control text-right border-success" name="pago" id="pago">
                                        </div>
                                    </div>



                                    <div class="col-sm-3">

                                        <label for="cambio" class="col-form-label">Cambio:</label>
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text  border-success ">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control text-right border-success" name="cambio" id="cambio" disabled>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-row justify-content-center">
                                    <div class="col-sm-9">
                                        <label for="letras" class="col-form-label">Cantidad en Letras</label>
                                        <div class="input-group input-group-sm">
                                            <textarea name="letras" id="letras" class="form-control" rows="2" disabled></textarea>

                                        </div>
                                    </div>
                                </div>


                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                                <button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-success" value="btnGuardar"><i class="far fa-save"></i> Guardar</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- /PAGO -->

    <!-- COLABORADOR -->
    <section>
        <div class="container">

            <!-- Default box -->
            <div class="modal fade" id="modalcol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-md" role="document">
                    <div class="modal-content w-auto">
                        <div class="modal-header bg-gradient-green">
                            <h5 class="modal-title" id="exampleModalLabel">BUSCAR COLABORADOR</h5>

                        </div>
                        <br>
                        <div class="table-hover table-responsive w-auto" style="padding:15px">
                            <table name="tablacol" id="tablacol" class="table table-sm text-nowrap table-striped table-bordered table-condensed" style="width:100%">
                                <thead class="text-center bg-gradient-green">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Seleccionar</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($datacol as $datc) {
                                    ?>
                                        <tr>
                                            <td><?php echo $datc['id_col'] ?></td>
                                            <td><?php echo $datc['nom_col'] ?></td>

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
    <!-- /COLABORADOR -->


</div>



<?php include_once 'templates/footer.php'; ?>
<script src="fjs/venta.js?v=<?php echo (rand()); ?>"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>