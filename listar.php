<?php
require 'config.php';

$sql = "SELECT documento, nombre, telefono, edad, correo FROM personas";
$result = mysqli_query($con, $sql);

$datos = mysqli_fetch_all($result,MYSQLI_ASSOC);

if(!empty($datos)){
    echo json_encode($datos);
}else{
    echo json_encode([]);
}
?>