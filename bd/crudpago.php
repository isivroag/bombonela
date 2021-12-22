<?php
include_once 'conexion.php';
$objeto = new conn();
$conexion = $objeto->connect();

// Recepción de los datos enviados mediante POST desde el JS   

$foliocxc = (isset($_POST['foliocxc'])) ? $_POST['foliocxc'] : '';
$fechapago = (isset($_POST['fechapago'])) ? $_POST['fechapago'] : '';
$importepago = (isset($_POST['importepago'])) ? $_POST['importepago'] : '';
$idmetodo = (isset($_POST['idmetodo'])) ? $_POST['idmetodo'] : '';
$metodo = (isset($_POST['metodo'])) ? $_POST['metodo'] : '';
$dinero = (isset($_POST['dinero'])) ? $_POST['dinero'] : '';
$cambio = (isset($_POST['cambio'])) ? $_POST['cambio'] : '';
$idcol = (isset($_POST['idcol'])) ? $_POST['idcol'] : '';
$colaborador = (isset($_POST['colaborador'])) ? $_POST['colaborador'] : '';
$tipopago = (isset($_POST['tipopago'])) ? $_POST['tipopago'] : '';
$saldoini = (isset($_POST['saldoini'])) ? $_POST['saldoini'] : '';
$saldofin = (isset($_POST['saldofin'])) ? $_POST['saldofin'] : '';
$letras = (isset($_POST['letras'])) ? $_POST['letras'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$data=0;
switch($opcion){
    case 1: //alta

        
        $consulta = "INSERT INTO pago (folio_cxc,folio_fis,fecha_pago,importe_pago,id_metodo,nom_metodo,dinero_pago,cambio_pago,id_col,nom_col,tipo_pago,saldoini_cxc,saldofin_cxc,letra_pago) 
                    VALUES('$foliocxc','0','$fechapago','$importepago','$idmetodo','$metodo','$dinero','$cambio','$idcol','$colaborador','$tipopago','$saldoini','$saldofin','$letras')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "UPDATE cxc SET saldo_cxc=saldo_cxc-'$importepago' where folio_cxc='$foliocxc'";
        $resultado = $conexion->prepare($consulta);
        if ($resultado->execute()){
            $data=1;
        }



        
        break;
    case 2: //modificación
        
        break;        
    case 3://baja
                   
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
