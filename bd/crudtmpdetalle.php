<?php
include_once 'conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();

// Recepción de los datos enviados mediante POST desde el JS   

$folio = (isset($_POST['folio'])) ? $_POST['folio'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$idpqt = (isset($_POST['idpqt'])) ? $_POST['idpqt'] : '';
$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
$clave = (isset($_POST['clave'])) ? $_POST['clave'] : '';
$concepto = (isset($_POST['concepto'])) ? $_POST['concepto'] : '';
$cantidad = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : '';
$precio = (isset($_POST['precio'])) ? $_POST['precio'] : '';
$importe = (isset($_POST['importe'])) ? $_POST['importe'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$data=0;
switch($opcion){
    case 1: //alta

        
        $consulta = "INSERT INTO tmpdet_cxc (folio,id_item,id_pqt,clave,concepto,cantidad,precio,subtotal,tipo_item) 
                    VALUES('$folio','$id','$idpqt','$clave','$concepto','$cantidad','$precio','$importe','$tipo')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "UPDATE tmpcxc SET subtotal=subtotal+'$importe',total=total+'$importe'where folio='$folio'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();



        $consulta = "SELECT * FROM tmpdet_cxc  where folio='$folio' and id_item='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        
        break;        
    case 3://baja
                   
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
