<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <!-- Incluir los estilos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    .image {
        object-fit: cover;
        aspect-ratio: 16 / 9;
    }
</style>

<body>
    <div class="page-nav fw-normal bg-primary d-flex justify-content-between align-item-center px-5">
        <h1>Restaurante</h1>
        <a id="checkout" class="button-checkout text-black my-auto bg-light text-decoration-none py-1 px-4 rounded" href="carrito.php" >Ver Carrito</a>
    </div>
    <?php
        $mysqli = new mysqli('localhost', 'root', '', 'restaurante');

        $sql = "SELECT producto.ProductoID, producto.Nombre, producto.Descripcion, producto.Precio, categoria.Descripcion AS NombreCategoria 
                FROM producto 
                LEFT JOIN categoria ON producto.CategoriaID = categoria.CategoriaID";

        $resultado = $mysqli->query($sql);

        $productosPorCategoria = array();

        while ($producto = $resultado->fetch_assoc()) {
            $categoria = $producto['NombreCategoria'];

            if (!isset($productosPorCategoria[$categoria])) {
                $productosPorCategoria[$categoria] = array();
            }

            $productosPorCategoria[$categoria][] = $producto;
        }

        $mysqli->close();
        ?>
    
    <div class="container d-flex flex-column justify-content-center">
    <h1 class="mt-5">Listado de Productos</h1>

    <?php
    foreach ($productosPorCategoria as $categoria => $productos) {
    ?>
        <h2 class='text-center'><?php echo $categoria; ?></h2>
        <div class="row mt-3" id="productosRow">
            <?php
            foreach ($productos as $producto) {
            ?>
                <div class="col-md-4 mb-3 m-auto">
                    <div class="card ">
                        <img src="./images/<?php echo $producto['ProductoID']; ?>.jpg" class="card-img-top w-80 image" alt="Imagen del producto">
                        <div class="card-body d-flex justify-content-center flex-column text-center">
                            <h5 class="card-title"><?php echo $producto['Nombre']; ?></h5>
                            <p class="card-text"><?php echo $producto['Descripcion']; ?></p>
                            <p class="card-text">Precio: HNL. <?php echo $producto['Precio']; ?></p>
                            <p class="card-text">Categoría: <?php echo $producto['NombreCategoria']; ?></p>
                            <input type="number" class="form-control" id="cantidad_<?php echo $producto['ProductoID']; ?>" value="1" min="1">
                            <button class="btn btn-primary mt-2 " onclick="agregarAlCarrito(<?php echo htmlspecialchars(json_encode($producto), ENT_QUOTES, 'UTF-8'); ?>)">Agregar al carrito</button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>

        

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function agregarAlCarrito(producto) {
            if (typeof producto === 'string') {
                producto = JSON.parse(producto);
            }
            var cantidadInput = document.getElementById('cantidad_' + producto.ProductoID);
            var cantidad = parseInt(cantidadInput.value);


            var productoAgregado = {
                id: producto.ProductoID,
                nombre: producto.Nombre,
                precio: producto.Precio,
                cantidad: cantidad,
                total: producto.Precio * cantidad
            };

            var carrito = JSON.parse(localStorage.getItem('carrito')) || [];


            var productoExistenteIndex = carrito.findIndex(function(item) {
                return item.id === producto.ProductoID;
            });


            if (productoExistenteIndex === -1) {
                carrito.push(productoAgregado);
            } else {

                carrito[productoExistenteIndex].cantidad += cantidad;
                carrito[productoExistenteIndex].total += producto.Precio * cantidad;
            }


            localStorage.setItem('carrito', JSON.stringify(carrito));


            alert('Producto agregado al carrito');
        }
    </script>
</body>

</html>