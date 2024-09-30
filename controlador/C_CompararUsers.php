<?php
require("../modelo/Conexion.php");
require("../modelo/Validacion.php");
session_start();
$conexion = new Conexion();
$validacion = new Validacion();

// hCaptcha
$data = [
    "secret" => "ES_c57343ec9d7b4bae926dda8472d3610d",
    "response" => $_POST["h-captcha-response"]
];

$verify = curl_init();
curl_setopt($verify, CURLOPT_URL, "https://api.hcaptcha.com/siteverify");
curl_setopt($verify, CURLOPT_POST, true);
curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($verify);
$responseData = json_decode($response);

if ($responseData->success) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuarioForm = $_POST["usuario"];
        $contrasenaForm = $_POST["contrasena"];

        if (!$validacion->validarUsuario($usuarioForm)) {
            $_SESSION['verifiValidacionUsuar'] = false;
        } elseif (!$validacion->validarContrasena($contrasenaForm)) {
            $_SESSION['verifiValidacionContra'] = false;
        } else {
            $conexion->ComUsuario($usuarioForm, $contrasenaForm);
        }
        header("location: ../index.php");
    } else {
        echo "Acceso no permitido.";
    }
} else {
    $_SESSION['captcha_error'] = true;
    header("location: ../index.php");
}

?>