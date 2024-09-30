<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>PRODUCTOS</title>
    <style>
        body {
            color: #212529;
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 900px;
            background-color: #00000021;
            border-radius: 2px;
            box-shadow: 0px 0px 20px 0px;
            box-shadow: #00000021;
            padding: 13px;
        }

        .titulo {
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            margin-bottom: 11px;
            padding: 17px;
            background-color: #00000021;
        }

        .card {
            border: 1px solid #dee2e6;
            transition: transform 0.3s;
            margin-bottom: 15px;
            padding: 8px;
        }



        .card-img-top {
            height: 200px;
            overflow: hidden;
            display: flex;
            justify-content: space-around;

        }

        .card-img-top:hover {
            transform: scale(1.15);

        }

        .card-img-top img {
            object-fit: cover;

        }

        .card-img-placeholder {
            background-color: #e9ecef;
            height: 100%;
        }

        .btn-primary {

            background-color: #212529;
            border-color: #212529;
            color: #ffffff;
            width: 14%;
        }


        .btn-primary:hover {
            background-color: #007bff;
            border-color: #007bff;
        }



        .btn-danger {
            background-color: #212529;
            border-color: #212529;
            color: #ffffff;
        }

        .btn-danger:hover {
            background-color: red;
            border-color: red;
        }

        .btn-primary.large {
            width: 100%;
            margin-bottom: 10px;
        }

        .btn-primary.large:hover {
            background-color: green;
            border-color: green;
        }

        .row {
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: 2px;
        }

        .out-of-stock {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            font-size: 20px;
            color: red;
        }
    </style>
</head>

<body>
    <div class="container mt-5">



        <h2 class="titulo">Bienvenido</h2>
        <p>
            <a href="./verCarrito.php" class="btn btn-primary">Ver Carrito</a>
            <a href="../controlador/C_Salir.php" class="btn btn-danger">Cerrar Sesión</a>
        </p>

        <?php if (isset($_SESSION["VerifiRechazo"]) && $_SESSION["VerifiRechazo"]): ?>
            <div class="alert alert-danger" role="alert">Compra rechazada</div>
        <?php elseif (isset($_SESSION["VerifiRechazo"]) && !$_SESSION["VerifiRechazo"]): ?>
            <div class="alert alert-success" role="alert">Compra procesada con exito</div>
        <?php endif; ?>
        <?php unset($_SESSION["VerifiRechazo"]); ?>

        <?php if (isset($_SESSION["verifiAñadCarro"]) && $_SESSION["verifiAñadCarro"] == 1): ?>
            <div class="alert alert-success" role="alert">Producto añadido al carrito</div>
        <?php elseif (isset($_SESSION["verifiAñadCarro"]) && $_SESSION["verifiAñadCarro"] == 2): ?>
            <div class="alert alert-danger" role="alert">Error al añadir al carro el producto</div>
        <?php elseif (isset($_SESSION["verifiAñadCarro"]) && $_SESSION["verifiAñadCarro"] == 0): ?>
            <div class="alert alert-danger" role="alert">El producto ya se encuentra en el carrito</div>
        <?php endif; ?>
        <?php unset($_SESSION["verifiAñadCarro"]); ?>

        <div class="row">
           
           <?php
            require("../controlador/C_VerProductos.php");
            if (isset($_SESSION['productos'])) {
                $productos = $_SESSION['productos'];
            } else {
                $productos = [];
            }
            ?>


            <?php if (isset($productos)): ?>
                <?php foreach ($productos as $producto): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-img-top">
                                <?php if (isset($producto['imagen']) && !empty($producto['imagen'])): ?>
                                    <img src="../controlador/imagenes/<?php echo $producto['imagen']; ?>" alt="Producto">
                                <?php endif; ?>
                                <?php if (!$producto['disponibilidad']): ?>
                                    <div class="out-of-stock">Sin stock</div>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo isset($producto['nombre_producto']) ? $producto['nombre_producto'] : 'Nombre no disponible'; ?>
                                </h5>
                                <p class="card-text">Precio: $
                                    <?php echo isset($producto['precio']) ? number_format($producto['precio'], 2) : 'Precio no disponible'; ?>
                                </p>
                                <p class="card-text">
                                    <?php echo isset($producto['descripcion']) ? $producto['descripcion'] : 'Descripción no disponible'; ?>
                                </p>
                            </div>
                            <form method="post" action="../controlador/C_añadirAlCarrito.php">
                                <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
                                <?php if (!$producto['disponibilidad']): ?>
                                    <div class="out-of-stock">Sin stock</div>
                                    <button type="submit" class="btn btn-primary large">Sin Stock</button>
                                <?php else: ?>
                                    <button type="submit" class="btn btn-primary large">Añadir al carrito</button>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay productos disponibles.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>