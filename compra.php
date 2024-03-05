<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Compras</title>
    <style>
    /* Estilo para el formulario */
    form {
        width: 300px; /* Ancho del formulario */
        margin: 0 auto; /* Centrar el formulario */
        text-align: left; /* Justificar a la izquierda */
    }

    /* Estilo para los elementos del formulario */
    form input[type="text"],
    form input[type="email"],
    form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }

    /* Estilo para el botón de enviar */
    form input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #007bff; /* Color de fondo del botón */
        color: #fff; /* Color del texto del botón */
        border: none;
        cursor: pointer;
        /* Estilo para el encabezado */
    
    }
    
    header {
        background-color: #333; /* Color de fondo del encabezado */
        color: #fff; /* Color del texto */
        padding: 20px; /* Espacio interno */
        text-align: center; /* Centrar el contenido */
    }

    /* Estilo para el botón */
    .btns {
        padding: 10px 20px; /* Relleno */
        background-color: #007bff; /* Color de fondo del botón */
        color: #fff; /* Color del texto del botón */
        border: none; /* Sin borde */
        border-radius: 5px; /* Bordes redondeados */
        cursor: pointer; /* Cambiar cursor al pasar sobre el botón */
    }

.nav a{
    color: white;
    font-size: 18px;
    margin-left: 35px;
    transition: .3s;
    
}

.nav a:hover{
    color: darkgreen;
    font-weight: bold;
}

</style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/1.0.0/css/font-awesome.css" integrity="sha384-F1Svb8AM2jFcVEkaC0k7fo7vZIvZ8tkJEAfg+WFLV9auiWtbXU5sP9Ad8XdXf3BB" crossorigin="anonymous">
    <link rel="stylesheet" href="compra.css"> 
    
    
</head>
<body>
    <header>
    <h1>GRAD</h1>
    <div class="nav">
            
            <a href="HOMEPAGE1.html">Inicio</a>
            

        </div>
</header>
    
    <section class="banner">
    <h1>Registro de Compras</h1>
    <div>
    <!-- Formulario para registrar una compra -->
    <form action="RegistroCompra.php" method="POST">
        <input type="text" name="descripcion" placeholder="Descripción">
        <input type="number" name="cantidad" placeholder="Cantidad">
        <input type="number" name="precio" placeholder="Precio">
        <input type="number" name="productoID" placeholder="ID del Producto">
        <select name="estado">
            <option value="pendiente">Pendiente</option>
            <option value="en proceso">En Proceso</option>
            <option value="completado">Completado</option>
        </select>
        <input type="submit" value="Registrar Compra">
    </form>
    </div>
    
    <!-- Mostrar todas las compras -->
    <h2>Compras Registradas</h2>
    <table>
        <thead>
            <tr>
                <th>Descripción </th>
                <th>Cantidad </th>
                <th>Precio </th>
                <th>ID del Producto </th>
                <th>Fecha de Ingreso </th>
                <th>Estado </th>
                <th>Acciones </th>
            </tr>
        </thead>
        <tbody>
            <?php
// Realizar una conexión a la base de datos (debes incluir esto al principio de tu script PHP)
$servername = "localhost";
$username = "root";
$password = "";
$database = "restaurante"; // Reemplaza "tu_base_de_datos" por el nombre de tu base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para seleccionar todas las compras de la tabla "ordencompras" ordenadas por estado
$sql = "SELECT ordencompras.*, producto.Nombre AS nombre_producto 
        FROM ordencompras 
        INNER JOIN producto ON ordencompras.ProductoID = producto.ProductoID
        ORDER BY estado";
$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Generar dinámicamente las filas de la tabla HTML con los datos de las compras
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["Descripcion"] . "</td>";
        echo "<td>" . $row["Cantidad"] . "</td>";
        echo "<td>" . $row["Precio"] . "</td>";
        echo "<td>" . $row["nombre_producto"] . "</td>";
        echo "<td>" . $row["FechaIngreso"] . "</td>";
        echo "<td>" . $row["Estado"] . "</td>";
        echo '<td><button class="marcar-llegado" data-id="' . $row['CompraID'] . '"><i class="fas fa-check"></i> Marcar como llegado</button></td>';
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No se encontraron compras.</td></tr>";
}

// Cerrar la conexión a la base de datos (debes incluir esto al final de tu script PHP)
$conn->close();
?>
        </tbody>
    </table>

    <!-- Script para cargar los datos de las compras desde PHP -->
    <script>
document.addEventListener("DOMContentLoaded", function() {
    const botones = document.querySelectorAll(".marcar-llegado");

    botones.forEach(boton => {
        boton.addEventListener("click", function() {
            const idCompra = this.getAttribute("data-id");
            marcarComoLlegado(idCompra);
        });
    });

    function marcarComoLlegado(idCompra) {
        const confirmacion = confirm("¿Seguro que desea marcar como llegado?");
        if (confirmacion) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "marcar_llegado.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText);
                    // Recargar la página o actualizar la tabla de compras
                    window.location.reload();
                }
            };
            xhr.send("idCompra=" + idCompra);
        }
    }
});
</script>

    </section>
    
</body>
</html>
