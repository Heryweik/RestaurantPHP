<?php
$mysqli = new mysqli('localhost', 'root', '', 'restaurante');

$sql = "SELECT producto.ProductoID, producto.Nombre, producto.Descripcion, producto.Precio, categoria.Descripcion AS NombreCategoria 
        FROM producto 
        LEFT JOIN categoria ON producto.CategoriaID = categoria.CategoriaID";

$resultado = $mysqli->query($sql);

// Obtener los productos como un array asociativo
$productos = $resultado->fetch_all(MYSQLI_ASSOC);

// Cerrar la conexión a la base de datos
$mysqli->close();

// Configurar la cabecera para indicar que la respuesta es de tipo JSON
header('Content-Type: application/json');

// Convertir el array a JSON
$productosStorage = json_encode($productos);

echo $productosStorage;
?>

