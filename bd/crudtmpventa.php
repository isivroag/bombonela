<?php
include_once 'conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();

// Recepción de los datos enviados mediante POST desde el JS   

$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
$folio = (isset($_POST['folio'])) ? $_POST['folio'] : '';

$idclie = (isset($_POST['idclie'])) ? $_POST['idclie'] : '';
$cliente = (isset($_POST['cliente'])) ? $_POST['cliente'] : '';
$idcol = (isset($_POST['idcol'])) ? $_POST['idcol'] : '';
$colaborador = (isset($_POST['colaborador'])) ? $_POST['colaborador'] : '';
$obs = (isset($_POST['obs'])) ? $_POST['obs'] : '';
$subtotal = (isset($_POST['subtotal'])) ? $_POST['subtotal'] : '';
$descuento = (isset($_POST['descuento'])) ? $_POST['descuento'] : '';
$total = (isset($_POST['total'])) ? $_POST['total'] : '';

$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

$saldo = $total;
$foliocxc = 0;
switch ($opcion) {
    case 1: //alta


        $consulta = "UPDATE tmpcxc SET id_clie= '$idclie',nom_clie='$cliente',fecha='$fecha',id_col='$idcol',
        nom_col='$colaborador',concepto='$obs',subtotal='$subtotal',descuento='$descuento',
        total='$total',usuarioalt='$usuario' WHERE folio='$folio'";
        $resultado = $conexion->prepare($consulta);

        if ($resultado->execute()) {
            $consultacon = "INSERT INTO cxc (id_clie,fecha_cxc,total_cxc,saldo_cxc,id_col,nom_col,concepto_cxc,subtotal_cxc,descuento_cxc,folio_tmp) 
            values ('$idclie','$fecha','$total','$saldo','$idcol','$colaborador','$obs','$subtotal','$descuento','$folio')";
            $resultadocon = $conexion->prepare($consultacon);
            if ($resultadocon->execute()) {
                $consultacon = "SELECT folio_cxc from cxc where folio_tmp='$folio' and estado_cxc='1'";
                $resultadocon = $conexion->prepare($consultacon);
                if ($resultadocon->execute()) {
                    $datacon = $resultadocon->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($datacon as $row) {
                        $foliocxc = $row['folio_cxc'];
                    }
                    $consulta = "UPDATE tmpcxc SET folio_cxc='$foliocxc',estado_tmp=2 WHERE folio='$folio' ";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();


                    //PRODUCTOS Y SERVICIOS EN DETALLE
                    $consulta = "SELECT * FROM tmpdet_cxc WHERE folio='$folio' ";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();
                    $datareg = $resultado->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($datareg as $row) {
                        $iditem = $row['id_item'];
                        $id_pqt = $row['id_pqt'];
                        $clave = $row['clave'];
                        $concepto = $row['concepto'];
                        $cantidad = $row['cantidad'];
                        $precio = $row['precio'];
                        $subt = $row['subtotal'];
                        $tipo_item = $row['tipo_item'];

                        //hay un error con el id_pqt

                        $consulta = "INSERT INTO det_cxc (folio_cxc,id_item,id_pqt,clave,concepto,cantidad,precio,subtotal,tipo_item) 
                                    VALUES ('$foliocxc','$iditem','$id_pqt','$clave','$concepto','$cantidad','$precio','$subt','$tipo_item') ";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute();


                        if ($tipo_item == "PRODUCTO") {

                            //cantidad generar y unidad en producto
                            $cantgral = 0;
                            $unidad = "";
                            $consulta = "SELECT cant_prod,unidad_prod FROM producto WHERE id_prod='$iditem'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $datprod = $resultado->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($datprod as $rowd) {
                                $cantgral = $rowd['cant_prod'];
                                $unidad = $rowd['unidad_prod'];
                            }

                            //cantidad en el almacen 
                            $inicial = 0;

                            $consulta = "SELECT cant_prod FROM inventario WHERE id_prod='$iditem' and id_almacen='1'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $datprod = $resultado->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($datprod as $rowd) {
                                $inicial = $rowd['cant_prod'];
                            }


                            $final = $inicial - $cantidad;
                            $cantgral = $cantgral - $cantidad;



                            $inicial;
                            $final;
                            $cantidad;
                            $fecha;
                            $tipo_mov = 4;
                            $obs_mov = "VENTA FOLIO " . $foliocxc;
                            $id_almacen = 1;

                            $consulta = "INSERT INTO movimiento (id_prod,id_tipomov,fecha_mov,ini_mov,cant_mov,unidad_mov,fin_mov,obs_mov,id_almacen) 
                                    VALUES ('$iditem','$tipo_mov','$fecha','$inicial','$cantidad','$unidad','$final','$obs','$id_almacen')";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();

                            $consulta = "UPDATE producto SET cant_prod='$final' WHERE id_prod='$iditem'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();

                            $consulta = "UPDATE inventario SET cant_prod='$final' WHERE id_prod='$iditem' and id_almacen='$id_almacen'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                        } else {
                            $sesiones = "";
                            $consulta = "SELECT sesiones_pqt from paquete where id_serv='$iditem' and id_pqt='$id_pqt'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $dataserv = $resultado->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($dataserv as $rowserv) {
                                $sesiones=$rowserv['sesiones_pqt'];
                            }


                            $consulta="INSERT INTO paquete_cont(id_clie,id_serv,id_pqt,numero_s,restante_s,fecha_ini,fecha_max,id_col,nom_col,precio
                            ,saldo,pagado,estado_serv)
                             values ('$idclie','$iditem','$id_pqt','$sesiones','$sesiones','$fecha','$fechafin','$idcol','$colaborador',''$precio,
                             '0','0','VIGENTE')";

                            
                        }
                    }

                    print json_encode($foliocxc, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
                    $conexion = NULL;
                }
            }
        }





        break;
}
