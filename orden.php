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
$carrito = json_decode($_POST['carrito'], true);
$total = 0;
foreach ($carrito as $producto) {
    $total += $producto['precio'] * $producto['cantidad'];
}
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];

$sql = "INSERT INTO Orden (nombre, fecha, total, pedido, estado, email, telefono, direccion) 
        VALUES ('$nombre', NOW(), $total, '" . json_encode($carrito) . "', 1, '$email', '$telefono', '$direccion')";

if ($conn->query($sql) === TRUE) {
    // Redirigir a "pedidos.php"
    echo '<script>';
    echo 'localStorage.removeItem("carrito");';
    echo 'window.location.href = "pedidos.php";';
    echo 'alert("Nuevo registro creado exitosamente");';
    echo '</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
