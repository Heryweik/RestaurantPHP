<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['idCliente'])) {
    // Redirigir al usuario a la página de inicio de sesión si no ha iniciado sesión
    header("Location: index.php");
    exit();
}

// Obtener el ID de cuentaCliente del usuario desde la sesión
$idCliente = $_SESSION['idCliente'];

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "restaurante";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir los datos del formulario de reserva
$fecha = $_POST['fecha'];
$hora_inicio = $_POST['HoraI'];
$hora_fin = $_POST['HoraF'];
$nombre = $_POST['nombre'];
$personas = $_POST['personas'];
$mesa = $_POST['mesa']; // Agregamos la mesa

// Calcular el tiempo de reserva en horas
$hora_inicio_dt = new DateTime($hora_inicio);
$hora_fin_dt = new DateTime($hora_fin);
$diff = $hora_inicio_dt->diff($hora_fin_dt);
$horas_reservadas = $diff->h + ($diff->days * 24); // Convertir días a horas si la reserva abarca varios días

// Calcular el monto de la reserva
$reserva_monto = 100 + (25 * $horas_reservadas);

// Insertar la reserva en la tabla de reservas junto con el ID del cliente
$sql = "INSERT INTO reservaciones (ClienteID, Fecha, HoraIni, HoraFin, Nombre, Capacidad, MesaID, ReservaMonto) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $idCliente, $fecha, $hora_inicio, $hora_fin, $nombre, $personas, $mesa, $reserva_monto);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Reserva realizada con éxito.";
    header("Location: homepageCliente.html");
} else {
    echo "Error al realizar la reserva: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
