<?php

class Validacion
{
    public function validarUsuario($usuario)
    {
        $patronUsuario = "/^[a-zA-Z0-9_]+$/";
        return preg_match($patronUsuario, $usuario);
    }
    public function validarContrasena($contrasena)
    {
        $patronContrasena = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/";
        return preg_match($patronContrasena, $contrasena);
    }
    public function validarCorreo($correo)
    {
        $patronCorreo = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        return preg_match($patronCorreo, $correo);
    }
    public function validarTel($tel)
    {
        $patronTel = '/^\+?[0-9]+$/';
        return preg_match($patronTel, $tel);
    }
    public function validarDireccion($direccion)
    {
        $patronDireccion = '/^[a-zA-Z0-9\s,.-]+$/';
        return preg_match($patronDireccion, $direccion);
    }
    public function validarNombreProd($nombre)
    {
        $patronNombre = '/^[a-zA-Z0-9\s.,-]{1,35}$/';
        return preg_match($patronNombre, $nombre);
    }
    public function validarPrecio($precio)
    {
        $patronPrecio = '/^\d{1,10}(\.\d{1,2})?$/';
        return preg_match($patronPrecio, $precio);
    }
    public function validarDescripcion($descripcion)
    {
        $patronDescripcion = '/^[a-zA-Z0-9\s.,-]{1,100}$/';
        return preg_match($patronDescripcion, $descripcion);
    }


}


?>