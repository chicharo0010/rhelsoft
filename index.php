<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "n0m3l0";
$dbname = "form";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $asunto = $_POST['asunto'];
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $mensaje = trim($_POST['mensaje']);

    
    if (empty($nombre) || empty($email) || empty($mensaje)) {
        die("Todos los campos son obligatorios.");
    }

    
    if (!preg_match("/^[a-zA-ZÀ-ÿ\s]{1,40}$/", $nombre)) {
        die("Por favor, ingrese un nombre válido sin símbolos ni caracteres especiales.");
    }

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Por favor, ingrese un correo electrónico válido.");
    }

    
    $tabla = "";
    switch ($asunto) {
        case "queja":
            $tabla = "queja";
            break;
        case "sugerencia":
            $tabla = "sugerencia";
            break;
        case "duda":
            $tabla = "duda";
            break;
        default:
            die("Asunto no válido.");
    }

    
    $stmt = $conn->prepare("INSERT INTO $tabla (nombre, correE, mensaje) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Preparación de la consulta fallida: " . $conn->error);
    }

    $stmt->bind_param("sss", $nombre, $email, $mensaje);

    if ($stmt->execute()) {
        echo "Datos guardados correctamente en la tabla $tabla.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Método de solicitud no válido.";
}
?>