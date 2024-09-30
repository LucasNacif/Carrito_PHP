<?php session_start();?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Registro</title>
    <style>
        body {
            background-color: #d2d2d2;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);

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
            background-color: #212529;
            border-color: #212529;
            color: #ffffff;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #101112;
            border-color: #101112;
        }

        .alert {
            margin-bottom: 25px;
            border: 1px solid #dc3545;
            border-radius: 5px;
            color: #dc3545;
        }

        .alert:hover {
            background-color: #f8d7da;
        }
    </style>

</head>

<body>




    <div class="container">
        <h2>Registro</h2>

        <?php if (isset($_SESSION['verifiValidRegistroUsuar']) and !$_SESSION['verifiValidRegistroUsuar']): ?>
            <div class="alert alert-danger" role="alert">Error en el nombre de usuario. Solo se permiten letras, números y
                guiones bajos.</div>
        <?php endif; ?>
        <?php unset($_SESSION['verifiValidRegistroUsuar']); ?>

        <?php if (isset($_SESSION['verifiValidRegistroContra']) and !$_SESSION['verifiValidRegistroContra']): ?>
            <div class="alert alert-danger" role="alert">Error en la contraseña. Debe contener al menos una letra
                mayúscula,una
                letra minúscula y un número.</div>
        <?php endif; ?>
        <?php unset($_SESSION['verifiValidRegistroContra']); ?>

        <form method="POST" action="../controlador/C_verRegistro.php">
            <div class="form-group">
                <label for="usuarioNuevo">Nuevo Usuario:</label>
                <input type="text" class="form-control" name="usuarioNuevo" maxlength="12" required>
            </div>
            <div class="form-group">
                <label for="contrasenaNueva">Nueva Contraseña:</label>
                <input type="password" class="form-control" name="contrasenaNueva" maxlength="12" minlength="8"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Registrarse</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>