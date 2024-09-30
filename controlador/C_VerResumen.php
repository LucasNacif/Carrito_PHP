<?php
require("../modelo/Conexion.php");

$conexion = new Conexion();
$Resumenes = $conexion->TraerResumen();

if (!empty($Resumenes)) {
    $_SESSION["resumenes"] = $Resumenes;
} else {
    $_SESSION["veriResumen"] = true;
}
?>