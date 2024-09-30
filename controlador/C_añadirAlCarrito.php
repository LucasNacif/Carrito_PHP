<?php
require("../modelo/Conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_producto'])) {
    $idProductoElim = $_POST['id_producto'];
    $conexion = new Conexion();
    $conexion->añadirProdCarrito($idProductoElim);
}
?>