<?php
require("../modelo/Conexion.php");
session_start();
$conexion = new Conexion();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_producto'])) {

    $idProdoElim = $_POST['id_producto'];

    //Para saber si elimina producto del carrito o del admin
    $ident = $_POST["identificador"];
    $conexion->modProducto($idProdoElim, $ident);

    // Para saber si quiere cambiar dispoibilidad
    if (isset($_POST["IdentDisp"])) {
        $IdentDisp = $_POST["IdentDisp"];
        if ($IdentDisp) {
            $conexion->cambiarDisp($idProdoElim);
        }
    }
}

//PAra eliminar todos los resgistros de la tabla resumenes segun usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_usuarioResum'])) {
    $idUserElim = $_POST['id_usuarioResum'];
    $ident = $_POST["identificador"];
    $conexion->modProducto($idUserElim, $ident);
}

//Traigo todos los productos y resumenes restantes y los guardo en la session
$_SESSION['productosCarrito'] = $conexion->TraerCarro();
$_SESSION['productos'] = $conexion->TraerProductos();
$_SESSION['resumenes'] = $conexion->TraerResumen();

?>