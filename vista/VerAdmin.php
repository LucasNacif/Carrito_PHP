<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Formulario de Ingreso de Productos</title>
    <style>
        body {
            color: #212529;
            background-color: #d2d2d2;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 540px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .container2 {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 135px rgba(0, 0, 0, 0.1);
            margin: 24px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #343a40;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
            color: #343a40;
        }

        .form-control {
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #101112;
            border-color: #101112;
            width: 100%;
            margin-bottom: 10px;
            margin-top: 11px;
        }

        .btn-primary.large {
            width: 100%;
            margin-bottom: 10px;
        }


        .btn-primary:hover {
            background-color: #007bff;
            border-color: #007bff;
        }


        .alert {
            margin-bottom: 25px;
            border: 1px solid green;
            border-radius: 5px;
            color: green;
            margin-top: 6px;
        }

        .alert-danger {
            margin-bottom: 25px;
            border: 1px solid red;
            border-radius: 5px;
            color: red;
        }



        .form .a .btn,
        .btn-danger {
            margin-top: 4px;
            background-color: #212529;
            border-color: #212529;
            color: #ffffff;
            width: 100%;
        }


        .form .a .btn,
        .btn-danger2 {
            margin-top: 4px;
            background-color: red;
            border-color: red;
            color: #ffffff;
            width: 100%;
            position: relative;
            z-index: 0;
        }

        .btn-danger2 {
            color: #fff;
            background-color: red;
            border-color: red;
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

    <div class="container">
        <h2>Bienvenido</h2>

        
        <?php if (isset($_SESSION["verifiNomIngreso"]) && $_SESSION["verifiNomIngreso"]): ?>
            <div class="alert alert-danger" role="alert">Error al ingresar el nombre. Solo se permiten letras, numeros y algunos simbolos. Max 35 caracteres</div>
        <?php endif; ?>
        <?php unset($_SESSION["verifiNomIngreso"]); ?>

        <?php if (isset($_SESSION["verifiDescIngreso"]) && $_SESSION["verifiDescIngreso"]): ?>
            <div class="alert alert-danger" role="alert">Error al ingresar la descripcion. Solo se permiten letras, numeros y algunos simbolos. Max 100 caracteres</div>
        <?php endif; ?>
        <?php unset($_SESSION["verifiDescIngreso"]); ?>

        <?php if (isset($_SESSION["verifiPrecioIngreso"]) && $_SESSION["verifiPrecioIngreso"]): ?>
            <div class="alert alert-danger" role="alert">Error al ingresar precio, solo se adminten numeros. Max 10 caracteres</div>
        <?php endif; ?>
        <?php unset($_SESSION["verifiPrecioIngreso"]); ?>


        <form method="post" action="../controlador/C_IngresoProducto.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">Nombre del Producto:</label>
                <input class="form-control" placeholder="Solo numeros y letras" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" class="form-control" name="precio" placeholder="Solo numeros" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input class="form-control" placeholder="Solo numeros y letras" name="descripcion" required></input>
            </div>
            <div class="form-group">
                <label for="imagen">Imagen del Producto:</label>
                <input type="file" class="form-control-file" name="imagen" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Ingresar Producto</button>
        </form>
        <a href="../controlador/C_Salir.php" class="btn btn-danger">Cerrar Sesión</a>
        <a href="VerResumen.php" class="btn btn-primary">Ver resumenes</a>




        <?php if (isset($_SESSION["verifiIngreso"]) && $_SESSION["verifiIngreso"]): ?>
            <div class="alert alert-success" role="alert">Producto agregado correctamente</div>
        <?php elseif (isset($_SESSION["verifiIngreso"]) && !$_SESSION["verifiIngreso"]): ?>
            <div class="alert alert-danger" role="alert">Error al agregar el producto</div>
        <?php endif; ?>
        <?php unset($_SESSION["verifiIngreso"]); ?>

        <?php if (isset($_SESSION["verifiElimAdmin"]) && $_SESSION["verifiElimAdmin"] == 0): ?>
            <div class="alert alert-danger" role="alert">No se puede eliminar el producto porque ha sido comprado</div>
        <?php elseif (isset($_SESSION["verifiElimAdmin"]) && $_SESSION["verifiElimAdmin"] == 1): ?>
            <div class="alert alert-success" role="alert">Producto eliminado correctamente</div>
        <?php elseif (isset($_SESSION["verifiElimAdmin"]) && $_SESSION["verifiElimAdmin"] == 2): ?>
            <div class="alert alert-danger" role="alert">Error al eliminar el producto</div>
        <?php endif; ?>
        <?php unset($_SESSION["verifiElimAdmin"]); ?>




    </div>
    <div class="container2">
        <div class="row">
            <?php
            require("../controlador/C_VerProductos.php");
            if (isset($_SESSION['productos'])) {
                $productos = $_SESSION['productos'];
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
                            <form method="post" action="../controlador/C_Eliminar.php">
                                <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
                                <?php if (!$producto['disponibilidad']): ?>
                                    <div class="out-of-stock">Sin stock</div>
                                    <input type="hidden" name="IdentDisp" value="true">
                                    <button type="submit" class="btn btn-danger2">Marcar como disponible</button>
                                <?php else: ?>
                                    <input type="hidden" name="IdentDisp" value="false">
                                    <input type="hidden" name="identificador" value="admin">
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
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
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>