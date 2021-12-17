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

$saldo=$total;
$foliocxc=0;
switch($opcion){
    case 1: //alta

      
        $consulta = "UPDATE tmpcxc SET id_clie= '$idclie',nom_clie='$cliente',fecha='$fecha',id_col='$idcol',
        nom_col='$colaborador',concepto='$obs',subtotal='$subtotal',descuento='$descuento',
        total='$total',usuarioalt='$usuario' WHERE folio='$folio'";
        $resultado = $conexion->prepare($consulta);

        if ($resultado->execute()){
            $consultacon = "INSERT INTO cxc (id_clie,fecha_cxc,total_cxc,saldo_cxc,id_col,nom_col,concepto_cxc,subtotal_cxc,descuento_cxc,folio_tmp) 
            values ('$idclie','$fecha','$total','$saldo','$idcol','$colaborador','$obs','$subtotal','$descuento','$folio')";
            $resultadocon = $conexion->prepare($consultacon);
            if ($resultadocon->execute()){
                $consultacon = "SELECT folio_cxc from cxc where folio_tmp='$folio' and estado_cxc='1'";
                $resultadocon = $conexion->prepare($consultacon);
                if ($resultadocon->execute()){
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

                        $consulta = "INSERT INTO det_cxc (folio_cxc,id_item,id_pqt,clave,concepto,cantidad,precio,subtotal,tipo_item) 
                                    VALUES ('$foliocxc','$iditem','$id_pqt','$clave','$concepto','$cantidad','$precio','$subt','$tipo_item') ";			
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute(); 


                    }
                    
                    print json_encode($foliocxc, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
                    $conexion = NULL;
                }
                
            }
        } 

       

       

        break;
    
      
         
}


