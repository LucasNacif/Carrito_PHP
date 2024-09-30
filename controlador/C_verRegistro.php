<?php
session_start();

require_once("../modelo/Conexion.php");
require_once("../modelo/Validacion.php");
$validacion = new Validacion();
$conexion = new Conexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuevoUser = $_POST["usuarioNuevo"];
    $nuevoPas = $_POST["contrasenaNueva"];
    $permiso = 0;

    if (!$validacion->validarUsuario($nuevoUser)) {
        $_SESSION['verifiValidRegistroUsuar'] = false;
    } else if (!$validacion->validarContrasena($nuevoPas)) {
        $_SESSION['verifiValidRegistroContra'] = false;
    } else {
        $conexion->registrarUserNuevo($nuevoUser, $nuevoPas, $permiso);
    }
    header('Location: ../vista/VerRegistro.php');
}else {
    echo "Acceso no permitido.";
}


?>