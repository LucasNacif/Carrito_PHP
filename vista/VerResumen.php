<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resúmenes de compra</title>

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
            box-shadow: 0px 0px -30px 0px;
            padding: 20px;
            margin: auto;
            margin-top: 10px;
        }

        .card {
            border: 1px solid #dee2e6;
            transition: transform 0.3s;
            margin-bottom: 15px;
            position: relative;
            display: flex;
            flex-direction: row;
            width: 100%;
            align-items: center;
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
            flex: 1;
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

        .Datos_user {
            background-color: #b6b6b6;
            color: #000000;
            padding: 10px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .btn-primary.large {
            width: 100%;
            margin-bottom: 10px;
        }

        .btn-primary.large:hover {
            background-color: green;
            border-color: green;
        }

        h2,
        h5 {
            color: #212529;
            margin-bottom: 10px;
            padding-top: 4px;
        }

        p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="titulo">Resúmenes de compra</h2>
        <p>
            <a href="./VerAdmin.php" class="btn btn-primary">Volver</a>
        </p>

        <?php if (isset($_SESSION['veriResumen']) && $_SESSION['veriResumen']): ?>
            <div class="alert alert-danger" role="alert">No hay resúmenes disponibles</div>
        <?php endif; ?>
        <?php unset($_SESSION['veriResumen']); ?>

        <?php if (isset($_SESSION['verifiResumeElim']) && $_SESSION['verifiResumeElim']): ?>
            <div class="alert alert-success" role="alert">Se eliminó correctamente</div>
        <?php elseif (isset($_SESSION['verifiResumeElim']) && !$_SESSION['verifiResumeElim']): ?>
            <div class="alert alert-danger" role="alert">Fallo al eliminarse</div>
        <?php endif; ?>
        <?php unset($_SESSION['verifiResumeElim']); ?>

        <?php
        require("../controlador/C_VerResumen.php");
        if (isset($_SESSION["resumenes"])) {
            $Resumenes = $_SESSION["resumenes"];
        }
        ?>

        <?php if (isset($Resumenes)): ?>
            <?php foreach ($Resumenes as $Resumen): ?>
                <?php if (!isset($nomEnProceso) or $nomEnProceso != $Resumen['usuarioNom']): ?>
                    <p>____________________________________________________________________________________________________________________________________
                    </p>
                    <div class="card mb-4 Datos_user">
                        <div class="card-body">
                            <h5 class="card-title">Comprador:
                                <?php echo isset($Resumen['usuarioNom']) ? $Resumen['usuarioNom'] : "Usuario no disponible" ?>
                            </h5>
                            <p>Telefono:
                                <?php echo isset($Resumen['tel']) ? $Resumen['tel'] : "Usuario no disponible" ?>
                            </p>
                            <p>Dirección:
                                <?php echo isset($Resumen['direccion']) ? $Resumen['direccion'] : "Dirección no disponible" ?>
                            </p>
                            <p>Correo:
                                <?php echo isset($Resumen['correo']) ? $Resumen['correo'] : "Correo no disponible" ?>
                            </p>
                            <p>Fecha:
                                <?php echo isset($Resumen['fecha']) ? $Resumen['fecha'] : "Fecha no disponible" ?>
                            </p>
                            <form method="post" action="../controlador/C_Eliminar.php">
                                <input type="hidden" name="id_usuarioResum" value="<?php echo $Resumen['id_usuario'] ?>">
                                <input type="hidden" name="identificador" value="resumen">
                                <button type="submit" class="btn btn-danger large">Eliminar del carrito</button>
                            </form>
                        </div>

                    </div>
                    <?php $nomEnProceso = $Resumen['usuarioNom'] ?>

                <?php endif; ?>

                <div class="card mb-4">
                    <div class="card-img-top">
                        <?php if (isset($Resumen['imagen']) && !empty($Resumen['imagen'])): ?>
                            <img src="../controlador/imagenes/<?php echo $Resumen['imagen']; ?>" alt="Producto">
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">
                            <?php echo isset($Resumen['nombre_producto']) ? $Resumen['nombre_producto'] : 'Nombre no disponible'; ?>
                        </h6>
                        <p class="card-text">Precio: $
                            <?php echo isset($Resumen['precio']) ? number_format($Resumen['precio'], 2) : 'Precio no disponible'; ?>
                        </p>
                        <p class="card-text">
                            <?php echo isset($Resumen['descripcion']) ? $Resumen['descripcion'] : 'Descripción no disponible'; ?>
                        </p>
                    </div>
                </div>

            <?php endforeach; ?>

        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>