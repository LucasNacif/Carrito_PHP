<?php
require('../modelo/Validacion.php');
require_once("../modelo/Conexion.php");
session_start();
$validacion = new Validacion();
$conexion = new Conexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $correo = $_POST['Correo'];
    $telefono = $_POST['tel'];
    $direccion = $_POST['Direccion'];
    $fecha = $_SESSION["fecha"];
    $nomUsuario = $_SESSION['usuario'];

    if (!$validacion->validarTel($telefono)) {
        $_SESSION['validTel'] = false;
        header("Location: ../vista/VerFin.php");

    } elseif (!$validacion->validarDireccion($direccion)) {
        $_SESSION['validDirecc'] = false;
        header("Location: ../vista/VerFin.php");

    } elseif (!$validacion->validarCorreo($correo)) {
        $_SESSION['validCorreo'] = false;
        header("Location: ../vista/VerFin.php");
    } else {
        $idUsuario = $conexion->TraerUsuario($nomUsuario);

        // Obtener los IDs de los productos del carrito
        $idsProductos = array();
        if (isset($_SESSION['productosCarrito'])) {
            $productos = $_SESSION['productosCarrito'];
            foreach ($productos as $producto) {
                $idsProductos[] = $producto['id_producto'];
            }
            if (!empty($idsProductos)) {
                $conexion->registrarCompra($correo, $telefono, $direccion, $idsProductos, $idUsuario, $fecha);
               
            } else {
                $_SESSION["VerifiRechazo"] = true;
                header("Location: ../vista/VerProductos.php");
            }
        } else {
            $_SESSION["VerifiRechazo"] = false;
            header("Location: ../vista/VerProductos.php");
        }
    }


}


?>