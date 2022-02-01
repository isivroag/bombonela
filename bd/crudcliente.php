<?php
include_once 'conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();

// Recepción de los datos enviados mediante POST desde el JS   
$nom = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$fecha_nac = (isset($_POST['fechanac'])) ? $_POST['fechanac'] : '';
$genero = (isset($_POST['genero'])) ? $_POST['genero'] : '';
$rfc = (isset($_POST['rfc'])) ? $_POST['rfc'] : '';
$curp = (isset($_POST['curp'])) ? $_POST['curp'] : '';
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$correo = (isset($_POST['correo'])) ? $_POST['correo'] : '';
$whatsapp = (isset($_POST['whatsapp'])) ? $_POST['whatsapp'] : '';
$ocupacion = (isset($_POST['ocupacion'])) ? $_POST['ocupacion'] : '';
$estudios = (isset($_POST['estudios'])) ? $_POST['estudios'] : '';
$edocivil = (isset($_POST['edocivil'])) ? $_POST['edocivil'] : '';
$medio = (isset($_POST['medio'])) ? $_POST['medio'] : '';

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


//$id_pros = (isset($_POST['id_pros'])) ? $_POST['id_pros'] : '';
//$id_cita = (isset($_POST['id_cita'])) ? $_POST['id_cita'] : '';


switch ($opcion) {
    case 1: //alta
        $consulta = "INSERT INTO wcliente (nom_clie,gen_clie,nac_clie,curp_clie,rfc_clie,dir_clie,tel_clie,correo_clie,ws_clie,ocupacion_clie,niv_clie,ecivil_clie,medio_clie) 
        VALUES('$nom','$genero','$fecha_nac','$curp','$rfc','$direccion','$telefono','$correo','$whatsapp','$ocupacion','$estudios','$edocivil','$medio') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM wcliente ORDER BY id_clie DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
        $conexion = NULL;
        break;
    case 2: //modificación
        $consulta = "UPDATE wcliente SET nom_clie='$nom',gen_clie='$genero',nac_clie='$fecha_nac',curp_clie='$curp',rfc_clie='$rfc',
        dir_clie='$direccion',tel_clie='$telefono',correo_clie='$correo',ws_clie='$whatsapp',ocupacion_clie='$ocupacion',niv_clie='$estudios',
        ecivil_clie='$edocivil', medio_clie='$medio' WHERE id_clie='$id' ";
        $resultado = $conexion->prepare($consulta);
        if ($resultado->execute()) {
            $consulta2 = "SELECT * FROM wcliente WHERE id_clie='$id' ";
            $resultado2 = $conexion->prepare($consulta2);
            $resultado2->execute();
            $data = $resultado2->fetchAll(PDO::FETCH_ASSOC);

            print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
            $conexion = NULL;
        }


        break;
    case 3: //baja
        $consulta = "UPDATE wcliente SET estado_clie=0 WHERE id_clie='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = 1;
        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
        $conexion = NULL;
        break;
    case 4:

        break;
}
