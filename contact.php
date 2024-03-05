<?php
// Iniciar la sesión
session_start();

// Conexión a la base de datos (puedes incluir esta parte en un archivo aparte y reutilizarla)
$servername = "localhost"; // Cambia localhost por la dirección de tu servidor MySQL
$username = "root"; // Cambia tu_usuario por tu nombre de usuario de MySQL
$password = ""; // Cambia tu_contraseña por tu contraseña de MySQL
$database = "restaurante"; // Cambia nombre_de_tu_base_de_datos por el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";

// Recibir los datos del formulario
$usuario = $_POST['usuario'];
$password = $_POST['password'];

// Preparar la consulta SQL para verificar el usuario y la contraseña
$sql = "SELECT Id FROM cuentasclientes WHERE usuario='$usuario' AND contrasenia='$password'";

// Ejecutar la consulta
$result = $conn->query($sql);

// Verificar si se encontró una coincidencia
if ($result->num_rows > 0) {
    // Obtener el ID del cliente
    $row = $result->fetch_assoc();
    $idCliente = $row['Id'];
    
    // Guardar el ID del cliente en la sesión
    $_SESSION['idCliente'] = $idCliente;
    
    // Mostrar el ID del cliente en un alert
    echo "<script>alert('ID de cliente: " . $_SESSION['idCliente'] . "');</script>";
    echo "<script>window.location.href = 'homepageCliente.html';</script>";
} else {
    echo "<script>alert('Usuario o contraseña incorrectos');</script>";
    echo "<script>window.location.href = 'index.php';</script>";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
