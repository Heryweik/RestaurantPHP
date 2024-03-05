<?php
// Conexión a la base de datos y otras configuraciones
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "restaurante";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el ID de la compra enviado por AJAX
    $idCompra = $_POST['idCompra'];
    
    // Verificar si la compra ya está marcada como completa
    $sql_check_compra = "SELECT Estado FROM ordencompras WHERE CompraID = $idCompra";

    $result = $conn->query($sql_check_compra);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["Estado"] == 'completado') {
            echo "Esta compra ya está marcada como completa.";
            exit; // Salir del script si la compra ya está marcada como completa
        }
    }
    

    // Actualizar el estado y la fecha de ingreso en la tabla "ordencompras"
    $fechaIngreso = date('Y-m-d');
    $sql_update_compra = "UPDATE ordencompras SET Estado = 'completado', FechaIngreso = '$fechaIngreso' WHERE CompraID = $idCompra";

    if ($conn->query($sql_update_compra) === TRUE) {
        // Obtener la fecha de caducidad
        $fechaCaducidad = date('Y-m-d', strtotime($fechaIngreso . ' +7 days'));

        // Actualizar el inventario asociado a la compra
        $sql_update_inventario = "UPDATE inventario SET FechaCaducidad = '$fechaCaducidad' WHERE CompraID = $idCompra";

        if ($conn->query($sql_update_inventario) === TRUE) {
            echo "Compra marcada como llegada con éxito y el inventario actualizado.";
        } else {
            echo "Error al actualizar el inventario: " . $conn->error;
        }
    } else {
        echo "Error al marcar la compra como llegada: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
