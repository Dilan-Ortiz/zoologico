<?php
require('config.php');

$tipo = $_FILES['dataCliente']['type'];
$tamanio = $_FILES['dataCliente']['size'];
$archivotmp = $_FILES['dataCliente']['tmp_name'];
$lineas = file(filename: $archivotmp);

$i = 0;

foreach ($lineas as $linea) {
    $cantidad_registros = count(value: $lineas);
    $cantidad_regist_agregados = ($cantidad_registros - 1);

    if ($i != 0) {
        $datos = explode(separator: ";", string: $linea);

        $documento  = !empty($datos[0]) ? ($datos[0]) : '';
        $nombre  = !empty($datos[1]) ? ($datos[1]) : '';
        $telefono = !empty($datos[2]) ? ($datos[2]) : '';
        $edad = !empty($datos[3]) ? ($datos[3]) : '';
        $correo = !empty($datos[4]) ? ($datos[4]) : '';


if (!empty($documento)) {
    $checkemail_duplicidad = ("SELECT documento FROM personas WHERE documento='" . ($documento) . "' ");
    $ca_dupli = mysqli_query(mysql: $con, query: $checkemail_duplicidad);
    $cant_duplicidad = mysqli_num_rows(result: $ca_dupli);
}
    
    if ($cant_duplicidad == 0) {
        $insertarData = "INSERT INTO personas(
            documento, nombre, telefono, edad, correo
        ) VALUES(
            '$documento',
            '$nombre',
            '$telefono',
            '$edad',
            '$correo'
        )";
        mysqli_query(mysql: $con, query: $insertarData);
    }
else {
    $updateData = ("UPDATE personas SET documento='" . $documento . "',
        nombre='" . $nombre . "', telefono='" . $telefono . "',
        edad='" . $edad . "', correo='" . $correo . "'
        WHERE documento='" . $documento . "'
    ");
    $result_update = mysqli_query(mysql: $con, query: $updateData);
}
}
$i++;
}
?>

<a href="index.php">Atras</a>
