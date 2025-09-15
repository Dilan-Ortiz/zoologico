<?php
$host = "localhost";
$dbname = "zoologico";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $documento = trim($_POST['documento']);
        $nombre = trim($_POST['nombre']);
        $telefono = trim($_POST['telefono']);
        $edad = trim($_POST['edad']);
        $correo = trim($_POST['correo']);

        $stmt = $pdo->prepare("INSERT INTO personas (documento, nombre, telefono, edad, correo) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$documento, $nombre, $telefono, $edad, $correo]);

        echo json_encode(["message" => "Datos guardados correctamente."]);
    } else {
        echo json_encode(["error" => "Método no permitido."]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Error en el servidor: " . $e->getMessage()]);
}
?>
