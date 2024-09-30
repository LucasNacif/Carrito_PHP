<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            color: #212529;
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-top: -21px;
        }

        .container {
            max-width: 900px;
            background-color: #00000024;
            border-radius: 7px;
            /* box-shadow: 0px 0px 20px 0px; */
            box-shadow: #00000021;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            margin: auto;
            margin-top: 10px;

        }

        .container2 {
            max-width: 900px;
            background-color: #00000033;
            border-radius: 7px;
            box-shadow: 0px 0px -30px 0px;
            box-shadow: #00000021;
            padding: 20px;
            display: flex;
            justify-content: space-evenly;
            margin: auto;
            margin-top: 50px;
            flex-direction: column;
            align-content: flex-start;
            align-items: flex-start;
        }

        .productos-container,
        .detalle-container {
            background-color: #00000017;
            width: 48%;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 7px;

        }

        .card {
            border: 1px solid #dee2e6;
            transition: transform 0.3s;
            margin-bottom: 15px;
            position: relative;
            display: flex;
            flex-direction: row;
            width: 350px;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-img-top {
            height: 100px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            max-width: 128px;
        }

        .card-img-top img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .card-body {
            padding: 10px;
        }

        .btn-primary {
            background-color: #212529;
            border-color: #212529;
            color: #ffffff;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary.large {
            width: 100%;
            margin-bottom: 10px;
        }

        .btn-primary.large:hover {
            background-color: green;
            border-color: green;
        }

        .total-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-top: 20px;
        }

        h2,
        h4 {
            color: #212529;
            margin-bottom: 20px;
            padding-top: 4px;
        }

        p {
            margin: 10px 0;
        }
    </style>
    <title>Finalizar Venta</title>
</head>

<body>

    <div class="container2 mt-5">
        <h2 class="titulo">Detalles de la compra</h2>
        <p>
            <a href="../vista/verCarrito.php"> <button class="btn btn-primary">Volver al carrito</button></a>
        </p>

       
        
        <?php if (isset($_SESSION["validTel"]) && !$_SESSION["validTel"]): ?>
            <div class="alert alert-danger" role="alert">Error al ingresar el telefono. Solo se admiten numeros </div>
        <?php endif; ?>
        <?php unset($_SESSION["validTel"]); ?>

        <?php if (isset($_SESSION["validDirecc"]) && !$_SESSION["validDirecc"]): ?>
            <div class="alert alert-danger" role="alert">Error al ingresar su direccion. Ingrese en un formato valido</div>
        <?php endif; ?>
        <?php unset($_SESSION["validDirecc"]); ?>

        <?php if (isset($_SESSION["validCorreo"]) && !$_SESSION["validCorreo"]): ?>
            <div class="alert alert-danger" role="alert">Error al ingresar su correo. Use el formato: ejemplo@gmail.com</div>
        <?php endif; ?>
        <?php unset($_SESSION["validCorreo"]); ?>

    </div>

    <div class="container">
        <div class="productos-container">
            <h2>Productos seleccionados</h2>
            <?php
            require("../controlador/C_verCarrito.php");
            if (isset($_SESSION['productosCarrito'])) {
                $productos = $_SESSION['productosCarrito'];
            } else {
                $productos = [];
            }
            ?>
            <?php if (isset($productos)): ?>
                <?php foreach ($productos as $producto): ?>
                    <div class="card mb-4">
                        <div class="card-img-top">
                            <?php if (isset($producto['imagen']) && !empty($producto['imagen'])): ?>
                                <img src="../controlador/imagenes/<?php echo $producto['imagen']; ?>" alt="Producto">
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">
                                <?php echo isset($producto['nombre_producto']) ? $producto['nombre_producto'] : 'Nombre no disponible'; ?>
                            </h6>
                            <p class="card-text">Precio: $
                                <?php echo isset($producto['precio']) ? number_format($producto['precio'], 2) : 'Precio no disponible'; ?>
                            </p>
                            <p class="card-text">
                                <?php echo isset($producto['descripcion']) ? $producto['descripcion'] : 'Descripción no disponible'; ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay productos disponibles.</p>
            <?php endif; ?>
        </div>


        <div class="detalle-container">
            <h2>Informacion de contacto</h2>
            <div class="total-container">
                <p>Usuario:
                    <?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ''; ?>
                </p>
                <p>Fecha:
                    <?php echo (date('Y-m-d'));
                    $_SESSION["fecha"] = date('Y-m-d') ?>
                </p>

                <form method="post" action="../controlador/C_RegistrarCompra.php">
                    <div class="form-group">
                        <label for="Correo">Correo electronico:</label>
                        <input type="email" class="form-control" name="Correo" required>
                    </div>
                    <div class="form-group">
                        <label for="tel">Telefono: </label>
                        <input type="tel" class="form-control" name="tel" maxlength="10" minlength="10" required>
                    </div>
                    <div class="form-group">
                        <label for="Direccion">Direccion: </label>
                        <input type="text" class="form-control" name="Direccion" required>
                    </div>

                    <button type="submit" class="btn btn-primary large">Comprar</button>
                </form>
                <h4>Total: $
                    <?php $total = 0; ?>
                    <?php foreach ($productos as $producto): ?>
                        <?php $total += $producto['precio']; ?>
                    <?php endforeach; ?>
                    <?php echo number_format($total, 2); ?>
                </h4>

            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


</body>

</html>