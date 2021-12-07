<?php  


 include_once 'conexion.php';
 $objeto = new conn();
 $conexion = $objeto->connect();
 

 


    $consulta = "SELECT * FROM vservicios WHERE estado_serv='1' and estado_pqt='1' order by id_serv,sesiones_pqt";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    if($resultado->rowCount() >=1){
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

 
 
 
 
 
 print json_encode($data, JSON_UNESCAPED_UNICODE);
 $conexion = NULL;
