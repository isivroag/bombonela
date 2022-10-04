<?php
include_once 'conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();

// Recepción de los datos enviados mediante POST desde el JS   

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$id_pros = (isset($_POST['id_pros'])) ? $_POST['id_pros'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
$obs = (isset($_POST['obs'])) ? $_POST['obs'] : '';
$concepto = (isset($_POST['concepto'])) ? $_POST['concepto'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$tipop = (isset($_POST['tipop'])) ? $_POST['tipop'] : '';
$responsable = (isset($_POST['responsable'])) ? $_POST['responsable'] : '';
$duracion = (isset($_POST['duracion'])) ? $_POST['duracion'] : '';
$cabina = (isset($_POST['cabina'])) ? $_POST['cabina'] : '';

$concepto = ucfirst(strtolower($concepto));
$obs = ucfirst(strtolower($obs));


switch ($opcion) {
        case 1: //alta
                $consulta = "SELECT * FROM citap where (id_per='$responsable' and fecha='$fecha' and estado<> 3 and estado <> 4 ) or (id_cabina='$cabina' and fecha='$fecha' and estado<> 3 and estado <> 4 ) ";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                if ($resultado->rowCount() == 0) {
                        if ($tipop == 0) {
                                $consulta = "SELECT * FROM citap where (id_pros='$id_pros' and fecha='$fecha') and estado<> 3 and estado <> 4";
                                $resultado = $conexion->prepare($consulta);
                                $resultado->execute();
                                if ($resultado->rowCount() == 0) {
                                        $consulta = "INSERT INTO citap (id_pros,id_px,fecha,concepto,obs,tipo_p,id_per,duracion,id_cabina) VALUES('$id_pros','0', '$fecha', '$concepto','$obs','$tipop','$responsable','$duracion','$cabina') ";
                                } else {
                                        $data = 0;
                                        break;
                                }
                        } else {
                                $consulta = "SELECT * FROM citap where (id_px='$id_pros' and fecha='$fecha') and estado<> 3 and estado <> 4";
                                $resultado = $conexion->prepare($consulta);
                                $resultado->execute();
                                if ($resultado->rowCount() == 0) {
                                        $consulta = "INSERT INTO citap (id_pros,id_px,fecha,concepto,obs,tipo_p,id_per,duracion,id_cabina) VALUES('0','$id_pros', '$fecha', '$concepto','$obs','$tipop','$responsable','$duracion','$cabina') ";
                                } else {
                                        $data = 0;
                                        break;
                                }
                        }

                        $resultado = $conexion->prepare($consulta);
                        if ($resultado->execute()) {
                                $data = 1;
                        } else {
                                $data = 0;
                        }
                } else {
                        $data = 0;
                }


                break;
        case 2:
                $consulta = "SELECT * FROM citap where folio_citap <> '$id' and ((id_per='$responsable' and fecha='$fecha' and estado<> 3 and estado <> 4 ) or (id_cabina='$cabina' and fecha='$fecha' and estado<> 3 and estado <> 4 ) )";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                if ($resultado->rowCount() == 0) {
                        if ($tipop == 0) {
                                $consulta = "SELECT * FROM citap where (id_pros='$id_pros' and fecha='$fecha') and estado<> 3 and estado <> 4 and folio_citap<>'$id'";
                                $resultado = $conexion->prepare($consulta);
                                $resultado->execute();
                                if ($resultado->rowCount() == 0) {
                                        $consulta = "UPDATE citap SET fecha='$fecha',concepto='$concepto',obs='$obs',id_per='$responsable',duracion='$duracion',id_cabina='$cabina' WHERE folio_citap='$id' ";
                                } else {
                                        $data = 0;
                                        break;
                                }
                        } else {
                                $consulta = "SELECT * FROM citap where (id_px='$id_pros' and fecha='$fecha') and estado<> 3 and estado <> 4 and folio_citap<>'$id'";
                                $resultado = $conexion->prepare($consulta);
                                $resultado->execute();
                                if ($resultado->rowCount() == 0) {
                                        $consulta = "UPDATE citap SET fecha='$fecha',concepto='$concepto',obs='$obs',id_per='$responsable',duracion='$duracion',id_cabina='$cabina' WHERE folio_citap='$id' ";
                                } else {
                                        $data = 0;
                                        break;
                                }
                        }

                        $resultado = $conexion->prepare($consulta);
                        if ($resultado->execute()) {
                                $data = 1;
                        } else {
                                $data = 0;
                        }
                } else {
                        $data = 0;
                }
                break;


        case 3:
                $consulta = "SELECT * FROM vcitap2 WHERE id='$id'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
                break;
        case 4:
                $consulta = "SELECT id,id_pros,id_per,title,descripcion,tipo_p,
                date(start) as fecha,time(start) as hora,obs,id_cabina,duracion
                FROM vcitap2 WHERE id='$id'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
                break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
