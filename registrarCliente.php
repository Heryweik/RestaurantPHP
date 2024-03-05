<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "restaurante";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir los datos del formulario
$usuario = $_POST['usuario'];
$correo = $_POST['correo'];
$contrasenia = $_POST['contrasenia'];

// Insertar los datos en la tabla cuentasclientes
$sql_insert_cuenta = "INSERT INTO cuentasclientes (Usuario, Contrasenia, correo) VALUES ('$usuario', '$contrasenia', '$correo')";

if ($conn->query($sql_insert_cuenta) === TRUE) {
    // Obtener el ID de la cuenta de cliente recién creada
    $idCuentaCliente = $conn->insert_id;

    // Insertar los datos en la tabla clientes asociados a la cuenta de cliente
    $sql_insert_cliente = "INSERT INTO cliente (CuentaClienteID) VALUES ('$idCuentaCliente')";

    if ($conn->query($sql_insert_cliente) === TRUE) {
        echo "<script>alert('Usuario y cliente registrados correctamente'); window.location.href='index.php';</script>";
    } else {
        echo "Error al registrar cliente: " . $conn->error;
    }
} else {
    echo "Error al registrar usuario: " . $conn->error;
}

$conn->close();
?>
