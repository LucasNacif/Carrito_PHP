<?php

class Conexion
{

    private $con;

    public function __construct()
    {
        $this->con = new mysqli("localhost:3307", "root", "", "carrito");
    }
    public function ComUsuario($usuarioForm, $contrasenaForm)
    {
        $credenciales_correctas = false;
        $permisoBD = null;
        

        $sql = "SELECT * FROM usuario WHERE usuarioNom = ?";
        $stmt = mysqli_prepare($this->con, $sql);
        mysqli_stmt_bind_param($stmt, "s", $usuarioForm);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        
        if ($result && $row = mysqli_fetch_assoc($result)) {
            if (md5($contrasenaForm) == $row["contrasena"]) {
                $credenciales_correctas = true;
                $permisoBD = $row["permiso"];
            }
        }


        mysqli_stmt_close($stmt);

        if ($credenciales_correctas) {
            $_SESSION['usuario'] = $usuarioForm;
            $_SESSION["autentificado"] = true;
            $_SESSION["permiso"] = $permisoBD;
            header("Location: /CARRITO/controlador/C_Credenciales.php");
            exit();
        } else {
            $_SESSION["autentificado"] = false;
            header("Location: /CARRITO/controlador/C_Credenciales.php");
            exit();
        }

    }
    public function registrarUserNuevo($nuevoUser, $nuevoPas, $permiso)
    {
        session_start();

        //primero revisamos si no hay algun usuario con el mismo nombre
        $stmtResume = $this->con->prepare("SELECT 'usaurio' FROM usuario WHERE usuarioNom = ?");
        $stmtResume->bind_param("s", $nuevoUser);
        $stmtResume->execute();
        $result = $stmtResume->get_result();

        if ($result->fetch_assoc() > 0) {
            $_SESSION["Nuevo"] = 2;
        } else {
            // Hash
            $pass_md5 = md5($nuevoPas);

            $sql = "INSERT INTO `usuario`(`usuarioNom`, `contrasena`, `permiso`) VALUES (?, ?, ?)";
            $stmt = $this->con->prepare($sql);

            $stmt->bind_param("sss", $nuevoUser, $pass_md5, $permiso);

            if ($stmt->execute()) {
                $_SESSION["Nuevo"] = 1;
            } else {
                $_SESSION["Nuevo"] = 0;
            }

        }


        header("Location: ../index.php");
        exit();
    }
    public function TraerProductos()
    {
        $sql = "SELECT * FROM productos";
        $result = $this->con->query($sql);

        if (!$result) {
            echo "Error en la consulta: " . $this->con->error;
            return [];
        }

        $productos = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }
        }
        return $productos;
    }


    public function TraerUsuario($nombre)
    {
        $sql = "SELECT id_usuario FROM usuario WHERE usuarioNom = ?";

        // Preparar la consulta
        $stmt = $this->con->prepare($sql);

        // Vincular el parámetro
        $stmt->bind_param("s", $nombre);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $result = $stmt->get_result();

        // Comprobar si hubo algún error
        if (!$result) {
            echo "Error en la consulta: " . $stmt->error;
            return [];
        }

        // Obtener el primer resultado
        $row = $result->fetch_assoc();

        // Cerrar la consulta preparada
        $stmt->close();

        // Devolver el resultado
        return $row['id_usuario'];
    }
    public function TraerCarro()
    {
        $sql = "SELECT * FROM carro c inner join productos p on p.id_producto = c.id_producto";
        $result = $this->con->query($sql);

        if (!$result) {
            echo "Error en la consulta: " . $this->con->error;
            return [];
        }

        $productos = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }
        }
        return $productos;
    }
    public function TraerResumen()
    {
        $sql = "SELECT * FROM resumenes r INNER JOIN productos p ON p.id_producto = r.id_producto INNER JOIN usuario u ON u.id_usuario = r.id_usuario ";
        $result = $this->con->query($sql);

        if (!$result) {
            return [];
        }
        $resumenes = [];
        if ($result->num_rows > 0) {
            foreach ($result as $resultados) {
                $resumenes[] = $resultados;


            }
            return $resumenes;
        }

    }
    public function salir()
    {
        //se limpia el carritoo
        $stmtCarro = $this->con->prepare("DELETE FROM carro");
        $stmtCarro->execute();
        $stmtCarro->close();

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = array();
        session_destroy();

        header("Location: /CARRITO/index.php");

        exit();
    }
    public function modProducto($idParaElim, $ident)
    {
        if ($ident == "carro") {
            $stmt = $this->con->prepare("DELETE FROM carro WHERE id_producto = ?");
            $stmt->bind_param("i", $idParaElim);
            if ($stmt->execute()) {
                $_SESSION["verifiElimCarro"] = true;
                header("Location: ../vista/verCarrito.php");
            } else {
                $_SESSION["verifiElimCarro"] = false;
                header("Location: ../vista/verCarrito.php");
            }
            $stmt->close();

        } else if ($ident == "admin") {
            // primero se elimina del carrito
            $stmtCarro = $this->con->prepare("DELETE FROM carro WHERE id_producto = ?");
            $stmtCarro->bind_param("i", $idParaElim);
            $stmtCarro->execute();
            $stmtCarro->close();

            //Se verifica que el producto no este en la tabla resumenes
            $stmtResume = $this->con->prepare("SELECT id_producto FROM resumenes WHERE id_producto = ?");
            $stmtResume->bind_param("i", $idParaElim);
            $stmtResume->execute();
            $result = $stmtResume->get_result();

            if ($result->fetch_assoc() > 0) {
                $_SESSION["verifiElimAdmin"] = 0;
                header("Location: ../vista/VerAdmin.php");
                $stmtResume->close();
            } else {
                // sino esta en la tabla resumenes, se elimina de la tabla productos
                $stmtProductos = $this->con->prepare("DELETE FROM productos WHERE id_producto = ?");
                $stmtProductos->bind_param("i", $idParaElim);
                if ($stmtProductos->execute()) {
                    $_SESSION["verifiElimAdmin"] = 1;
                    header("Location: ../vista/VerAdmin.php");
                } else {
                    $_SESSION["verifiElimAdmin"] = 2;
                    header("Location: ../vista/VerAdmin.php");
                }
                $stmtProductos->close();
            }

        } else if ($ident == "resumen") {
            //Primero traemos los id de los productos qeu compro ese usuario para ponerlos disponibles otra vez
            $stmtProductoDisp = $this->con->prepare("UPDATE productos p
                                                     INNER JOIN resumenes r ON p.id_producto = r.id_producto
                                                     SET p.disponibilidad = 1
                                                     WHERE r.id_usuario = ?");
            $stmtProductoDisp->bind_param("i", $idParaElim);

            if ($stmtProductoDisp->execute()) {
                //si se ejecuta la consulta anterior, entonces recien ahi se eliminan los registros 
                $stmtResumenElim = $this->con->prepare("DELETE FROM resumenes WHERE id_usuario = ?");
                $stmtResumenElim->bind_param("i", $idParaElim);

                if ($stmtResumenElim->execute()) {
                    $_SESSION['verifiResumeElim'] = true;
                } else {
                    $_SESSION['verifiResumeElim'] = false;
                }
                $stmtResumenElim->close();
            } else {
                // Manejar el caso en que la actualización de disponibilidad falle
                $_SESSION['verifiResumeElim'] = false;
            }

            $stmtProductoDisp->close();
            header('Location: ../vista/VerResumen.php');
        }


    }

    public function cambiarDisp($idProdoCamb)
    {
        $stmt = $this->con->prepare("UPDATE productos SET disponibilidad = 1 WHERE id_producto = ?");
        $stmt->bind_param("i", $idProdoCamb);

        if ($stmt->execute()) {
            header("location: ../vista/VerAdmin.php");
        } else {
            header("location: ../vista/VerAdmin.php");
        }
        $stmt->close();

    }
    public function limpiarCarro()
    {
        session_start();
        unset($_SESSION['productosCarrito']);

        $stmtDelCarro = $this->con->prepare("DELETE FROM carro");
        $stmtDelCarro->execute();
        $stmtDelCarro->close();


    }
    public function ingresoProducto($nombre, $descripcion, $precio, $disponibilidad, $imagen)
    {
        $sql = "INSERT INTO productos (nombre_producto, descripcion, precio, disponibilidad, imagen) VALUES ('$nombre', '$descripcion', '$precio', '$disponibilidad', '$imagen')";
        if ($this->con->query($sql) === TRUE) {
            return true;
        } else {
            header("Location: ../controlador/C_IngresoProducto.php");
        }
        $this->con->close();

    }
    public function añadirProdCarrito($idProductoAgregar)
    {
        session_start();
        $sqlVerificar = "SELECT id_producto FROM carro WHERE id_producto = ?";
        $stmtVerificar = $this->con->prepare($sqlVerificar);
        $stmtVerificar->bind_param("i", $idProductoAgregar);
        $stmtVerificar->execute();
        $stmtVerificar->store_result();

        if ($stmtVerificar->num_rows > 0) {
            $_SESSION["verifiAñadCarro"] = 0;
            header("Location: ../vista/VerProductos.php");
        } else {
            $sql = "INSERT INTO `carro`(`id_producto`) VALUES (?)";
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param("i", $idProductoAgregar);

            if ($stmt->execute()) {
                $_SESSION["verifiAñadCarro"] = 1;
                header("Location: ../vista/VerProductos.php");
            } else {
                $_SESSION["verifiAñadCarro"] = 2;
                header("Location: ../vista/VerProductos.php");
            }

            $stmt->close();
        }

        $stmtVerificar->close();
    }
    public function registrarCompra($correo, $telefono, $direccion, $idsProductos, $idUsuario, $fecha)
    {
        session_start();
        // Actualizar disponibilidad de productos
        foreach ($idsProductos as $idProducto) {
            $updateQuery = "UPDATE productos SET disponibilidad = 0 WHERE id_producto = ?";
            $updateStmt = $this->con->prepare($updateQuery);
            $updateStmt->bind_param("i", $idProducto);
            $updateStmt->execute();
            $updateStmt->close();
        }

        $conexion = new Conexion();
        $conexion->limpiarCarro();

        // Insertar datos en la tabla resumenes
        $insertQuery = "INSERT INTO resumenes (id_producto, id_usuario, fecha, correo, tel, direccion) VALUES (?, ?, ?, ?, ?, ?)";
        $insertStmt = $this->con->prepare($insertQuery);

        foreach ($idsProductos as $idProducto) {
            $insertStmt->bind_param("iissss", $idProducto, $idUsuario, $fecha, $correo, $telefono, $direccion);
            $insertStmt->execute();

            if ($insertStmt->error) {
                echo "Error al procesar la compra: " . $insertStmt->error;
                $_SESSION["VerifiRechazo"] = true;
            }
        }

        $_SESSION["VerifiRechazo"] = false;
       header("Location: ../vista/VerProductos.php");
        $insertStmt->close();
    }

}


