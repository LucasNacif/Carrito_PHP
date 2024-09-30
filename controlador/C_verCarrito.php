<?php
require("../modelo/Conexion.php");

$conexion = new Conexion();
$productosCar = $conexion->TraerCarro();

if (!empty($productosCar)) {
    $_SESSION['productosCarrito'] = $productosCar;
} else {
    $_SESSION['productosCarrito'] = [];
    echo ("No hay productos");
}
?>