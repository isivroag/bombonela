<?php
//filter.php  

include_once 'conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();

// Recepción de los datos enviados mediante POST desde el JS   


$texto = (isset($_POST['texto'])) ? $_POST['texto'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
date_default_timezone_set('America/Mexico_City');
 $fecha=date("Y-m-d");

$data = 0;
switch ($opcion) {
    case 1: //buscar tipo de cita y actualizar
        $consulta = "SELECT * FROM vcitap2 WHERE title like '%".$texto."%' and estado<>4 and date(start)>='$fecha' ORDER BY start ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);


        break;
    case 2:
        $consulta = "SELECT * FROM vcitap2 WHERE title like '%".$texto."%' and estado<>4 ORDER BY start ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}



print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
