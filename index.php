<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/a2dd6045c4.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginCliente.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Login | Restaurante </title>
    <style>
        /* Estilos para el rectángulo con el icono de pico */
        .portal-empleados {
            position: fixed;
            bottom: 20px; /* Ajusta la distancia desde la parte inferior */
            right: 20px; /* Ajusta la distancia desde la derecha */
            background-color: #ffffff; /* Cambia el color de fondo */
            border: 1px solid #000000; /* Agrega un borde */
            padding: 10px; /* Añade relleno */
            display: flex; /* Hace que los elementos internos se alineen horizontalmente */
            align-items: center; /* Centra verticalmente los elementos internos */
        }
        .portal-empleados a {
            text-decoration: none; /* Elimina la decoración de subrayado del enlace */
            color: #000000; /* Cambia el color del texto */
            margin-left: 5px; /* Añade un margen a la izquierda del enlace */
        }
    </style>
</head>
<body>
    <section>
        <div class="contenedor">
            <div class="formulario">
                <form name="frmLoginCliente" method="post" action="contact.php">
                    <h2>Inicia Sesión</h2>
                    <div class="input-contenedor">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="text" id="usuario" name="usuario" required>
                        <label for="#">Usuario</label>
                    </div>
                    <div class="input-contenedor">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password" name="password" required>
                        <label for="#">Contraseña</label>
                    </div>
                    <div class="olvidar">
                        <label for="#">
                            <input type="checkbox"> Recordar
                            <a href="RegistroCliente.html">Olvidé mi contraseña</a>
                        </label>
                    </div>
                    <div class="botonCliente">
                        <input type="submit" name="Submit" id="Submit" value="Ingresar">
                    </div>
                </form>
                <div class="registrar">
                    <p>No tengo Cuenta<p/> <a href="RegistroCliente.html"> Crear una</a>
                </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Rectángulo con el icono de pico y el enlace al portal de empleados -->
    <div class="portal-empleados">
        <i class="fas fa-tools"></i> <!-- Icono de pico -->
        <a href="LOGIN.html">Portal de Empleados</a> <!-- Enlace al portal de empleados -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
