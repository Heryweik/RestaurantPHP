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
$sql = "SELECT Id FROM cuentasempleados WHERE usuario='$usuario' AND contrasenia='$password'";

// Ejecutar la consulta
$result = $conn->query($sql);

// Verificar si se encontró una coincidencia
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $idEmpleado = $row['Id'];
    $_SESSION['idEmpleado'] = $idEmpleado;
    echo "<script>alert('ID de empleado: " . $_SESSION['idEmpleado'] . "');</script>";
    echo "<script>window.location.href = 'HOMEPAGE1.html';</script>";
} else {
    echo "<script>alert('Usuario o contraseña incorrectos');</script>";
    echo "<script>window.location.href = 'LOGIN.html';</script>";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
