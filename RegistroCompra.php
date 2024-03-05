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
$descripcion = $_POST['descripcion'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];
$productoID = $_POST['productoID'];
$estado = $_POST['estado'];

// Insertar los datos en la tabla "ordencompras"
$sql_ordencompras = "INSERT INTO ordencompras (descripcion, cantidad, precio, productoID, estado) 
                    VALUES ('$descripcion', '$cantidad', '$precio', '$productoID', '$estado')";

if ($conn->query($sql_ordencompras) === TRUE) {
    echo "Registro en ordencompras exitoso. ";
    
    // Obtener el ID de la última compra insertada en la tabla "ordencompras"
    $last_insert_id = $conn->insert_id;
    
    // Insertar los datos en la tabla "inventario"
    $sql_inventario = "INSERT INTO inventario (Disponibles, productoID, compraID) 
                        VALUES ('$cantidad', '$productoID', '$last_insert_id')";

    if ($conn->query($sql_inventario) === TRUE) {
        echo "Registro en inventario exitoso. ";
    } else {
        echo "Error al registrar en inventario: " . $conn->error;
    }
} else {
    echo "Error al registrar en ordencompras: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();

header("Location: compra.php");
exit();
?>
