<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "restaurante";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}

$nombre = $_POST['nombre'];
$fecha = $_POST['fecha'];
$total = $_POST['total'];
$pedido = $_POST['pedido'];
$estado = $_POST['estado'];

$sql = "INSERT INTO Orden (nombre, fecha, total, pedido, estado) VALUES ('$nombre', '$fecha', $total, '$pedido', $estado)";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo registro creado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();