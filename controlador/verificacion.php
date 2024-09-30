<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header("Location: /CARRITO/controlador/C_Credenciales.php");
}