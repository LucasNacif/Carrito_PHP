<?php
session_start();

if ($_SESSION["autentificado"] == true) {
    $permiso = $_SESSION["permiso"];

    if ($permiso == 0) {
        header("Location: /CARRITO/vista/VerProductos.php");
    } elseif ($permiso == 1) {
        header("Location: /CARRITO/vista/VerAdmin.php");
    } else {
        echo "Permiso no válido. Contacta al administrador.";
    }
    
} else {
    $_SESSION["CredenIncorrect"] = true;
    header("Location: ../index.php");
}
?>