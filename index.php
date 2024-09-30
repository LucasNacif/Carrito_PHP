
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Iniciar Sesión</title>
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
            display: flex;
            flex-direction: column;
            align-items: stretch;
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
            margin-top: 4px;
        }

        .btn-primary:hover {
            background-color: #101112;
            border-color: #101112;
        }

        .alert {
            margin-bottom: 25px;
            border: 1px solid green;
            border-radius: 5px;
            color: green;
        }

        .alert-danger {
            margin-bottom: 25px;
            border: 1px solid red;
            border-radius: 5px;
            color: red;
        }
    </style>
    <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
</head>

<body>

    <div class="container">

        <?php include("./controlador/verificacion.php") ?>

        <h2>Iniciar Sesión</h2>

        <?php if (isset($_SESSION["Nuevo"]) && $_SESSION["Nuevo"] == 1): ?>
            <div class="alert alert-success" role="alert">Usuario agregado correctamente</div>
        <?php elseif (isset($_SESSION["Nuevo"]) && $_SESSION["Nuevo"] == 0): ?>
            <div class="alert alert-danger" role="alert">Error de registro</div>
        <?php elseif (isset($_SESSION["Nuevo"]) && $_SESSION["Nuevo"] == 2): ?>
            <div class="alert alert-danger" role="alert">Tu nombre de usuario ya esta en uso</div>
        <?php endif; ?>
        <?php unset($_SESSION["Nuevo"]); ?>

        <?php if (isset($_SESSION["captcha_error"]) && $_SESSION["captcha_error"] == true): ?>
            <div class="alert alert-danger" role="alert">Error en la verificación de hCaptcha</div>
        <?php endif; ?>
        <?php unset($_SESSION['captcha_error']); ?>

        <?php if (isset($_SESSION["CredenIncorrect"]) && $_SESSION["CredenIncorrect"]): ?>
            <div class="alert alert-danger" role="alert">Credenciales incorrectas. Regístrate si no tienes cuenta</div>
        <?php endif; ?>
        <?php unset($_SESSION["CredenIncorrect"]); ?>

        <?php if (isset($_SESSION["verifiValidacionUsuar"]) && !$_SESSION["verifiValidacionUsuar"]): ?>
            <div class="alert alert-danger" role="alert">Error en el nombre de usuario. Solo se permiten letras, números y
                guiones bajos.</div>
        <?php endif; ?>
        <?php unset($_SESSION["verifiValidacionUsuar"]); ?>


        <?php if (isset($_SESSION["verifiValidacionContra"]) && !$_SESSION["verifiValidacionContra"]): ?>
            <div class="alert alert-danger" role="alert">Error en la contraseña. Debe contener al menos una letra mayúscula,
                una letra minúscula y un número.</div>
        <?php endif; ?>
        <?php unset($_SESSION["verifiValidacionContra"]); ?>


        <form method="post" action="controlador/C_CompararUsers.php">
            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" class="form-control" placeholder="Se permiten letras, numeros y algunos simbolos" name="usuario" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" class="form-control" placeholder="Se permiten letras, numeros y algunos simbolos" name="contrasena" required>
            </div>
            <div class="h-captcha" data-sitekey="7c074b56-49b4-444e-b325-c4d915096e4f" data-theme="dark"
                data-error-callback="onError"></div>
            <br>

            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
        <a href="vista/VerRegistro.php" class="btn btn-primary">Registrarse</a>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>