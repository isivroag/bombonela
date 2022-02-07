<?php
include_once 'conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();

// Recepción de los datos enviados mediante POST desde el JS   

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$dir = (isset($_POST['dir'])) ? $_POST['dir'] : '';
$tel = (isset($_POST['tel'])) ? $_POST['tel'] : '';
$cel = (isset($_POST['cel'])) ? $_POST['cel'] : '';
$correo = (isset($_POST['correo'])) ? $_POST['correo'] : '';
$idpuesto = (isset($_POST['idpuesto'])) ? $_POST['idpuesto'] : '';


$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$color = (isset($_POST['color'])) ? $_POST['color'] : '';




$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO colaborador (nom_col,dir_col,tel_col,cel_col,correo_col,id_puesto,color_col) 
            VALUES('$nombre','$dir','$tel','$cel','$correo','$idpuesto','$color') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT * FROM vcolaborador ORDER BY id_col DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE colaborador SET nom_col='$nombre', tel_col='$tel', color_col='$color', dir_col='$dir',cel_col='$cel',correo_col='$correo',id_puesto='$idpuesto' WHERE id_col='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM vcolaborador WHERE id_col='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "UPDATE colaborador SET estado_col=0 WHERE id_col='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data=1;                          
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
