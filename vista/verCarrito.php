<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
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
            width: 20%;
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
            background-color: green;
            border-color: green;
        }

        .btn-danger.large {
            width: 100%;
            margin-bottom: 10px;
        }

        .btn-danger.large:hover {
            background-color: red;
            border-color: red;
        }

        .row {
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: 2px;
        }
    </style>
    <title>CARRITO</title>
</head>

<body>

    <div class="container mt-5">
        <h2 class="titulo">Carrito de Compras</h2>
        <p>
            <a href="VerProductos.php" class="btn btn-primary">Volver a Productos</a>
            <a href="VerFin.php" class="btn btn-danger">Finalizar compra</a>
        </p>

        <?php if (isset($_SESSION["verifiElimCarro"]) && $_SESSION["verifiElimCarro"]): ?>
            <div class="alert alert-success" role="alert">Producto eliminado correctamente</div>
        <?php elseif (isset($_SESSION["verifiElimCarro"]) && !$_SESSION["verifiElimCarro"]): ?>
            <div class="alert alert-danger" role="alert">No se pudo eliminar el producto</div>
        <?php endif; ?>
        <?php unset($_SESSION["verifiElimCarro"]); ?>


        <div class="row">
            <?php
            require("../controlador/C_verCarrito.php");
            if (isset($_SESSION['productosCarrito'])) {
                $productos = $_SESSION['productosCarrito'];
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
                                <form method="post" action="../controlador/C_Eliminar.php">
                                    <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
                                    <input type="hidden" name="identificador" value="carro">
                                    <button type="submit" class="btn btn-danger large">Eliminar del carrito</button>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay productos disponibles</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>