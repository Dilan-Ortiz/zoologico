<?php
$con = mysqli_connect("localhost", "root", "", "zoologico");
if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>