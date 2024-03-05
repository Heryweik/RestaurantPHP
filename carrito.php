<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="src/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="page-nav fw-normal bg-primary d-flex justify-content-between align-item-center px-5 text-black">
        <h1 class="fw-bold">Restaurante</h1>
        <a id="checkout" class="button-checkout my-auto bg-light text-decoration-none py-2 px-4 rounded" href="pedidos.php" >Salir del Carrito</a>
    </div>
    
    <div class="container">
        <h1 class="mt-5">Detalles de la Compra</h1>
        <div class="d-flex flex-column mt-3" >
            <div class="col-md-12">
                <h2>Detalle del Pedido</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="detallePedido">
                    </tbody>
                </table>
                <p class="lead">Total: <span id="totalPedido">HNL. 0.00</span></p>
            </div>
            
            <div class="col-md-12">
                <h2>Información del Cliente</h2>
                <form action="orden.php" method="post">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Telefono:</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Direccion:</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                    </div>
                    <!-- Campo oculto para enviar los datos del carrito -->
                    <input type="hidden" id="carrito" name="carrito">
                    <button type="submit" class="btn btn-primary">Enviar Orden</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var carrito = JSON.parse(localStorage.getItem('carrito'));

        function actualizarCarrito() {
            if (carrito && carrito.length > 0) {
                var detallePedidoHTML = '';
                var totalPedido = 0;

                carrito.forEach(function(producto, index) {
                    var subtotal = producto.precio * producto.cantidad;
                    detallePedidoHTML += '<tr>';
                    detallePedidoHTML += '<td>' + producto.nombre + '</td>';
                    detallePedidoHTML += '<td><input type="number" class="form-control cantidad" min="1" value="' + producto.cantidad + '" data-index="' + index + '"></td>';
                    detallePedidoHTML += '<td>HNL.' + producto.precio + '</td>';
                    detallePedidoHTML += '<td>HNL.' + subtotal + '</td>';
                    detallePedidoHTML += '<td><button class="btn btn-danger btn-sm eliminar" data-index="' + index + '">Eliminar</button></td>';
                    detallePedidoHTML += '</tr>';
                    totalPedido += subtotal;
                });

                $('#detallePedido').html(detallePedidoHTML);
                $('#totalPedido').text('HNL.' + totalPedido);

                $('#carrito').val(JSON.stringify(carrito));
            }
        }

        actualizarCarrito();

        $(document).on('change', '.cantidad', function() {
            var index = $(this).data('index');
            var cantidad = parseInt($(this).val());

            if (!isNaN(cantidad) && cantidad > 0) {
                carrito[index].cantidad = cantidad;
                localStorage.setItem('carrito', JSON.stringify(carrito));
                actualizarCarrito();
            }
        });

        $(document).on('click', '.eliminar', function() {
            var index = $(this).data('index');
            carrito.splice(index, 1);
            localStorage.setItem('carrito', JSON.stringify(carrito));
            actualizarCarrito();
        });
    </script>

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css"
integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
  integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
  crossorigin="anonymous"></script>
</body>

</html>