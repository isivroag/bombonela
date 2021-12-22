<?php  


 include_once 'CifrasEnLetras.php';
 $valor = (isset($_POST['valor'])) ? $_POST['valor'] : '';
 $enpesos = new CifrasEnLetras();
 $pesos=$enpesos->convertirEurosEnLetras(floatval($valor));

 
 
 
 
 
 print json_encode($pesos, JSON_UNESCAPED_UNICODE);
 $conexion = NULL;
