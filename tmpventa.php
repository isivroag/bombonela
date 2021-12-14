<!-- CODIGO PHP-->
<?php
$pagina = "tmpventa";

include_once "templates/header.php";
include_once "templates/barra.php";
include_once "templates/navegacion.php";


include_once 'bd/conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();
$tokenid = md5($_SESSION['s_usuario']);
$usuario = $_SESSION['s_nombre'];
$idusuario = $_SESSION['s_usuario'];

if (isset($_GET['folio'])) {
    $folio = $_GET['folio'];
} else {

    $consultacon = "SELECT * FROM tmpcxc WHERE estado_tmp=1 and usuarioalt='$idusuario'";
    $resultadocon = $conexion->prepare($consultacon);
    $resultadocon->execute();

    if ($resultadocon->rowCount() > 0) {
        $datacon = $resultadocon->fetchAll(PDO::FETCH_ASSOC);
        foreach ($datacon as $row) {
            $folio = $row['folio'];
            $idclie = $row['id_clie'];
            $nom_clie = $row['nom_clie'];
            $fecha = $row['fecha'];
            $id_col = $row['id_col'];
            $nom_col = $row['nom_col'];
            $concepto = $row['concepto'];
            $subtotal = $row['subtotal'];
            $descuento = $row['descuento'];
            $total = $row['total'];
            $foliovta = $row['folio_cxc'];
        }
    } else {
        $fecha = date('Y-m-d');
        $consultacon = "INSERT INTO tmpcxc(fecha,subtotal,descuento,total,usuarioalt) values ('$fecha','0','0','0','$idusuario')";
        $resultadocon = $conexion->prepare($consultacon);
        $resultadocon->execute();

        $consultacon = "SELECT * FROM tmpcxc WHERE estado_tmp=1 and usuarioalt='$idusuario'";
        $resultadocon = $conexion->prepare($consultacon);
        $resultadocon->execute();
        $datacon = $resultadocon->fetchAll(PDO::FETCH_ASSOC);

        foreach ($datacon as $row) {
            $folio = $row['folio'];
        }

        $idclie = "";
        $nom_clie = "";
        $id_col = "";
        $nom_col = "";
        $concepto = "";
        $subtotal = 0;
        $descuento = 0;
        $total = 0;
        $foliovta = 0;
    }
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

$consultadet = "SELECT * FROM producto where estado_prod='1' and vendible_prod='1' ORDER BY id_prod";
$resultadodet = $conexion->prepare($consultadet);
$resultadodet->execute();
$dataprod = $resultadodet->fetchAll(PDO::FETCH_ASSOC);


$consultaser = "SELECT * FROM vservicios WHERE estado_serv='1' and estado_pqt='1' order by id_serv,sesiones_pqt";
$resultadoser = $conexion->prepare($consultaser);
$resultadoser->execute();
$dataser = $resultadoser->fetchAll(PDO::FETCH_ASSOC);

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

            <div class="card-header bg-gradient-gray text-light">
                <h1 class="card-title mx-auto">Registro de Venta</h1>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-lg-12">


                        <!--<button id="btnNuevo" type="button" class="btn bg-gradient-gray btn-ms" data-toggle="modal"><i class="fas fa-plus-square text-light"></i><span class="text-light"> Nuevo</span></button>-->
                        <button type="button" id="btnGuardar" name="btnGuardar" class="btn bg-gradient-green btn-ms" value="btnGuardar"><i class="far fa-save"></i> Guardar</button>
                        <!--<button id="btnNuevo" type="button" class="btn bg-gradient-primary btn-ms" data-toggle="modal"><i class="fas fa-envelope-square"></i> Enviar</button>-->
                    </div>
                </div>

                <br>


                <!-- Formulario Datos de Cliente -->
                <form id="formventa" action="" method="POST">


                    <div class="content">

                        <div class="card card-widget" style="margin-bottom:0px;">

                            <div class="card-header bg-gradient-gray " style="margin:0px;padding:8px">


                                <h1 class="card-title ">Información General</h1>
                            </div>

                            <div class="card-body" style="margin:0px;padding:1px;">

                                <div class="form-row justify-content-center">

                                    <div class="col-sm-2 ">

                                        <label for="fecha" class="col-form-label">Fecha*:</label>
                                        <div class="input-group input-group-sm">
                                            <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo $fecha; ?>">
                                        </div>
                                    </div>

                                    <div class="col-sm-4 ">

                                    </div>

                                    <div class="col-sm-2 ">
                                        <label for="folio" class="col-form-label">Folio:</label>

                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" name="folio" id="folio" value="<?php echo  $folio; ?> " disabled>
                                            <input type="hidden" class="form-control" name="foliovta" id="foliovta" value="<?php echo  $foliovta; ?> " disabled>
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
                                                <span class="input-group-append">
                                                    <button id="bcliente" type="button" class="btn btn-sm bg-gradient-green"><i class="fas fa-search"></i></button>
                                                </span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-sm-8">
                                        <label for="colaborador" class="col-form-label">Colaborador*:</label>
                                        <div class="input-group input-group-sm">
                                            <input type="hidden" class="form-control" name="idcol" id="idcol" value="<?php echo $id_col; ?>">

                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" name="colaborador" id="colaborador" disabled placeholder="Seleccionar al Colaborador" value="<?php echo $nom_col; ?>">
                                                <span class="input-group-append">
                                                    <button id="bcolaborador" type="button" class="btn btn-sm bg-gradient-green"><i class="fas fa-search"></i></button>
                                                </span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-sm-8 ">
                                        <label for="obs" class="col-form-label">Observaciones:</label>

                                        <div class="input-group input-group-sm">
                                            <textarea rows="2" class="form-control" name="obs" id="obs" value="<?php echo $obs; ?>" placeholder="Observaciones"> <?php echo $concepto ?></textarea>
                                        </div>
                                    </div>

                                </div>



                                <!-- AGREGAR SERVICIOS Y PRODUCTOS -->
                                <div class="card card-widget mb-0">
                                    <div class="card-header bg-gradient-gray text-light">
                                        <h1 class="card-title mx-auto">Detalle de Venta</h1>
                                    </div>


                                    <div class="card-body accordion" id="inventario" style="padding:8px">

                                        <div class="row justify-content-between">

                                            <div class="col-sm-2 ">
                                                <button type="button" id="btnaddproducto" class="btn btn-block card-btn bg-gradient-primary btn-sm" data-toggle="collapse" href='#addproducto' aria-expanded="false" aria-controls="addproducto">
                                                    Agregar Producto <i class="fas fa-plus"></i>
                                                </button>
                                            </div>

                                            <div class="col-sm-2">
                                                <button type="button" id="btnaddservicio" class="btn btn-block card-btn bg-gradient-purple btn-sm" data-toggle="collapse" href='#addservicio' aria-expanded="false" aria-controls="addservicio">
                                                    Agregar Servicio <i class="fas fa-plus"></i>
                                                </button>
                                            </div>

                                        </div>
                                        <!-- AGREGAR PRODUCTOS Y SERVICIOS-->

                                        <!-- productos -->
                                        <div class="row justify-content-center collapse mt-2" id="addproducto" data-parent="#inventario">
                                            <div class="card card-widget pb-2 ">


                                                <div class="card-body " style="margin:0px;padding:0px;">
                                                    <div class="row justify-content-sm-center">
                                                        <div class="col-sm-2">
                                                            <label for="claveprod" class="col-form-label">Clave Producto:</label>
                                                            <div class="input-group input-group-sm">

                                                                <input type="text" class="form-control" name="claveprod" id="claveprod" disabled>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-9">
                                                            <div class="input-group input-group-sm">


                                                                <input type="hidden" class="form-control" name="idprod" id="idprod">
                                                                <input type="hidden" class="form-control" name="idpaqtprod" id="idpaqtprod" value="0">
                                                                <input type="hidden" class="form-control" name="tipoprod" id="tipoprod" value="PRODUCTO">
                                                                <input type="hidden" class="form-control" name="claveprod" id="claveprod">


                                                                <label for="producto" class="col-form-label">Producto:</label>
                                                                <div class="input-group input-group-sm">
                                                                    <input type="text" class="form-control" name="producto" id="producto" disabled>
                                                                    <span class="input-group-append">
                                                                        <button id="bproducto" type="button" class="btn btn-sm bg-gradient-green"><i class="fas fa-search"></i></button>
                                                                    </span>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-sm-center">



                                                        <div class="col-sm-2">
                                                            <label for="cantidadprod" class="col-form-label">Cantidad:</label>
                                                            <div class="input-group input-group-sm">

                                                                <input type="number" class="form-control text-right" name="cantidadprod" id="cantidadprod" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <label for="preciolprod" class="col-form-label">Precio Lista:</label>
                                                            <div class="input-group input-group-sm">

                                                                <input type="number" class="form-control text-right" name="preciolprod" id="preciolprod" disabled>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <label for="descuentoprod" class="col-form-label">Descuento:</label>
                                                            <div class="input-group input-group-sm">

                                                                <input type="number" class="form-control text-right" name="descuentoprod" id="descuentoprod" disabled>
                                                            </div>
                                                        </div>


                                                        <div class="col-sm-2">
                                                            <label for="preciovprod" class="col-form-label">Precio Venta:</label>
                                                            <div class="input-group input-group-sm">

                                                                <input type="number" class="form-control text-right" name="preciovprod" id="preciovprod" disabled>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <label for="importeprod" class="col-form-label">Importe:</label>
                                                            <div class="input-group input-group-sm">

                                                                <input type="text" class="form-control text-right" name="importeprod" id="importeprod" disabled>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-1 justify-content-center">
                                                            <label for="" class="col-form-label">Acción:</label>
                                                            <div class="input-group-append input-group-sm justify-content-center d-flex">
                                                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Agregar Item">
                                                                    <button type="button" id="btnagregarprod" name="btnagregarprod" class="btn btn-sm bg-gradient-orange" value="btnGuardar"><i class="fas fa-plus-square"></i></button>
                                                                </span>
                                                                <span class="d-inline-block" tabindex="1" data-toggle="tooltip" title="Limpiar">
                                                                    <button type="button" id="btlimpiarprod" name="btlimpiarprod" class="btn btn-sm bg-gradient-purple" value="btnlimpiar"><i class="fas fa-brush"></i></button>
                                                                </span>
                                                            </div>
                                                        </div>

                                                    </div>


                                                </div>

                                            </div>
                                        </div>
                                        <!-- servicios -->
                                        <div class="row justify-content-center collapse mt-2" id="addservicio" data-parent="#inventario">
                                            <div class="card card-widget pb-2 ">


                                                <div class="card-body justify-content-center" style="margin:0px;padding:0px;">
                                                    <div class="row justify-content-sm-center">

                                                        <div class="col-sm-2">
                                                            <label for="claveprod" class="col-form-label">Clave Servicio:</label>
                                                            <div class="input-group input-group-sm">
                                                                <input type="text" class="form-control" name="claveserv" id="claveserv" disabled>

                                                            </div>
                                                        </div>

                                                        <div class="col-sm-9">
                                                            <div class="input-group input-group-sm">

                                                                <input type="hidden" class="form-control" name="idserv" id="idserv">
                                                                <input type="hidden" class="form-control" name="idpaqtserv" id="idpaqtserv">
                                                                <input type="hidden" class="form-control" name="tiposerv" id="tiposerv" value="SERVICIO">


                                                                <label for="servicio" class="col-form-label">Servicio:</label>
                                                                <div class="input-group input-group-sm">
                                                                    <input type="text" class="form-control" name="servicio" id="servicio" disabled>
                                                                    <span class="input-group-append">
                                                                        <button id="btnServicio" type="button" class="btn btn-sm bg-gradient-green"><i class="fas fa-search"></i></button>
                                                                    </span>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row justify-content-sm-center">


                                                        <div class="col-sm-2">
                                                            <label for="cantidadserv" class="col-form-label">Cantidad:</label>
                                                            <div class="input-group input-group-sm">

                                                                <input type="number" class="form-control  text-right" name="cantidadserv" id="cantidadserv" disabled>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <label for="preciolserv" class="col-form-label">Precio Lista:</label>
                                                            <div class="input-group input-group-sm">
                                                                <input type="text" class="form-control  text-right" name="preciolserv" id="preciolserv" disabled>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <label for="descuentoserv" class="col-form-label">Descuento:</label>
                                                            <div class="input-group input-group-sm">
                                                                <input type="number" class="form-control  text-right" name="descuentoserv" id="descuentoserv" disabled>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <label for="preciovserv" class="col-form-label">Precio Venta:</label>
                                                            <div class="input-group input-group-sm">
                                                                <input type="number" class="form-control  text-right" name="preciovserv" id="preciovserv" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <label for="importeserv" class="col-form-label">Importe:</label>
                                                            <div class="input-group input-group-sm">
                                                                <input type="text" class="form-control  text-right" name="importeserv" id="importeserv" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1 justify-content-center">
                                                            <label for="" class="col-form-label">Acción:</label>
                                                            <div class="input-group-append input-group-sm justify-content-center d-flex">
                                                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Agregar Item">
                                                                    <button type="button" id="btnagregarserv" name="btnagregarserv" class="btn btn-sm bg-gradient-orange" value="btnGuardar"><i class="fas fa-plus-square"></i></button>
                                                                </span>
                                                                <span class="d-inline-block" tabindex="1" data-toggle="tooltip" title="Limpiar">
                                                                    <button type="button" id="btlimpiarserv" name="btlimpiarserv" class="btn btn-sm bg-gradient-purple" value="btnlimpiar"><i class="fas fa-brush"></i></button>
                                                                </span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                        <!-- /AGREGAR PRODUCTOS Y SERVICIOS-->


                                    </div>

                                    <div class="row">

                                        <div class="col-lg-12 mx-auto">

                                            <div class="table-responsive" style="padding:5px;">

                                                <table name="tablaDet" id="tablaDet" class="table table-sm table-striped table-bordered table-condensed text-nowrap mx-auto" style="width:100%;font-size:15px">
                                                    <thead class="text-center bg-gradient-gray">
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
                                                            <th>Acciones</th>


                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $consultadeto = "SELECT * FROM tmpdet_cxc where folio='$folio' order by id_reg";
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
                                <!-- TOTALES-->
                                <div class="card card-widget mt-0 ">
                                    <div class="card-header bg-gradient-gray text-light">
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
                                                    <input type="number" class="form-control text-right" name="descuento" id="descuento" value="<?php echo $descuento ?>">
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
                                        </div>
                                    </div>

                                </div>



                                <!-- SECCION DE PAGO -->
                                <div class="card card-widget mb-2 pb-3">
                                    <div class="card-header bg-gradient-gray text-light">
                                        <h1 class="card-title mx-auto">Datos del Pago</h1>
                                    </div>
                                    <div class="card-body" style="margin:0px;padding:1px;">

                                        <div class="form-row justify-content-center">

                                            <div class="col-sm-2">

                                                <label for="saldovta" class="col-form-label">Saldo Actual:</label>
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-dollar-sign"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control text-right" name="saldovta" id="saldovta" value="<?php echo $subtotal ?>" disabled>
                                                </div>
                                            </div>

                                            <div class="col-sm-2 ">
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

                                            <div class="col-sm-2">

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
                                            <div class="col-sm-2">
                                            </div>

                                            <div class="col-sm-2">

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



                                            <div class="col-sm-2">

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


                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>





    </section>





    <!-- CLIENTE -->
    <section>
        <div class="container">

            <!-- Default box -->
            <div class="modal fade" id="modalcliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-md" role="document">
                    <div class="modal-content w-auto">
                        <div class="modal-header bg-gradient-gray">
                            <h5 class="modal-title" id="exampleModalLabel">BUSCAR CLIENTE</h5>

                        </div>
                        <br>
                        <div class="table-hover table-responsive w-auto" style="padding:15px">
                            <table name="tablacliente" id="tablacliente" class="table table-sm text-nowrap table-striped table-bordered table-condensed" style="width:100%">
                                <thead class="text-center bg-gradient-gray">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Seleccionar</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($dataclie as $datc) {
                                    ?>
                                        <tr>
                                            <td><?php echo $datc['id_clie'] ?></td>
                                            <td><?php echo $datc['nom_clie'] ?></td>

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
    <!-- /CLIENTE -->

    <!-- COLABORADOR -->
    <section>
        <div class="container">

            <!-- Default box -->
            <div class="modal fade" id="modalcol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-md" role="document">
                    <div class="modal-content w-auto">
                        <div class="modal-header bg-gradient-gray">
                            <h5 class="modal-title" id="exampleModalLabel">BUSCAR COLABORADOR</h5>

                        </div>
                        <br>
                        <div class="table-hover table-responsive w-auto" style="padding:15px">
                            <table name="tablacol" id="tablacol" class="table table-sm text-nowrap table-striped table-bordered table-condensed" style="width:100%">
                                <thead class="text-center bg-gradient-gray">
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

    <!-- PRODUCTO -->
    <section>
        <div class="container">

            <!-- Default box -->
            <div class="modal fade" id="modalproducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-md" role="document">
                    <div class="modal-content w-auto">
                        <div class="modal-header bg-gradient-gray">
                            <h5 class="modal-title" id="exampleModalLabel">BUSCAR PRODUCTO</h5>

                        </div>
                        <br>
                        <div class="table-responsive  table-hover w-auto" style="padding:15px">
                            <table name="tablaproducto" id="tablaproducto" class="table text-nowrap  table-sm table-striped table-bordered table-condensed " style="width:100%">
                                <thead class="text-center bg-gradient-gray">
                                    <tr>
                                        <th>Id</th>
                                        <th>Clave</th>
                                        <th>Producto</th>
                                        <th>Marca</th>
                                        <th>Precio</th>
                                        <th>Existencias</th>
                                        <th>Seleccionar</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($dataprod as $datc) {
                                    ?>
                                        <tr>
                                            <td><?php echo $datc['id_prod'] ?></td>
                                            <td><?php echo $datc['clave_prod'] ?></td>
                                            <td><?php echo $datc['nom_prod'] ?></td>
                                            <td><?php echo $datc['nom_marca'] ?></td>
                                            <td><?php echo $datc['precio_prod'] ?></td>
                                            <td><?php echo $datc['cant_prod'] ?></td>
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
    <!-- /PRODUCTO -->

    <!-- SERIVICIO -->
    <section>
        <div class="container">

            <!-- Default box -->
            <div class="modal fade" id="modalServicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-md" role="document">
                    <div class="modal-content w-auto">
                        <div class="modal-header bg-gradient-gray">
                            <h5 class="modal-title" id="exampleModalLabel">BUSCAR PRODUCTO</h5>

                        </div>
                        <br>
                        <div class="table-responsive  table-hover w-auto" style="padding:15px">
                            <table name="tablaservicio" id="tablaservicio" class="table  table-sm table-striped table-bordered table-condensed " style="width:100%">
                                <thead class="text-center bg-gradient-gray">
                                    <tr>
                                        <th>Id</th>
                                        <th>Id Serv</th>
                                        <th>Clave</th>
                                        <th>Servicio</th>
                                        <th>Tipo</th>
                                        <th>Sesiones</th>
                                        <th>Precio</th>
                                        <th>Seleccionar</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dataser as $rowser) { ?>
                                        <tr>
                                            <td><?php echo $rowser['id_serv'] ?></td>
                                            <td><?php echo $rowser['id_pqt'] ?></td>
                                            <td><?php echo $rowser['clave_pqt'] ?></td>
                                            <td><?php echo $rowser['desc_pqt'] ?></td>
                                            <td><?php echo $rowser['nom_tipo'] ?></td>
                                            <td><?php echo $rowser['sesiones_pqt'] ?></td>
                                            <td><?php echo $rowser['precio_pqt'] ?></td>
                                            <td></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /PRODUCTO -->

</div>



<?php include_once 'templates/footer.php'; ?>
<script src="fjs/tmpventa.js?v=<?php echo (rand()); ?>"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>