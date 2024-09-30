<?php
require("../modelo/Conexion.php");
require("../modelo/Validacion.php");
session_start();

$conexion = new Conexion();
$validacion = new Validacion();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
// Trae datos del formulario
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$disponibilidad = true;

// Trae el nombre de la imagen
$imagen = $_FILES['imagen']['name'];

// Trae la ruta
$imagen_tmp = $_FILES['imagen']['tmp_name'];

$directorio_destino = "../controlador/imagenes/";
$imagen_destino = $directorio_destino . $imagen;

// Mueve la imagen del durectorio en el que estaba al que le indiqué
move_uploaded_file($imagen_tmp, $imagen_destino);


if (!$validacion->validarNombreProd($nombre)) {
    $_SESSION['verifiNomIngreso'] = true;

} else if (!$validacion->validarDescripcion($descripcion)) {
    $_SESSION['verifiDescIngreso'] = true;

} else if (!$validacion->validarPrecio($precio)) {
    $_SESSION['verifiPrecioIngreso'] = true;

} else {
    $valid = $conexion->ingresoProducto($nombre, $descripcion, $precio, $disponibilidad, $imagen);

    if ($valid) {
        $_SESSION["verifiIngreso"] = true;
    } else {
        $_SESSION["verifiIngreso"] = false;
    }
}
header("Location: ../vista/VerAdmin.php");
}
?>