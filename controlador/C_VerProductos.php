<?php
require("../modelo/Conexion.php");

$conexion = new Conexion();
$productos = $conexion->TraerProductos();

if (!empty($productos)) {
    $_SESSION['productos'] = $productos;
} else {
    echo ("No hay productos");
}
?>