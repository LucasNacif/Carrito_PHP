<!-- 
usuarios:
Lucas 12345678
usuario 87654321
usuario1 09876543
usuario2 12345678 -->

CONSULTA PARA PRUEBAS

INSERTAR PRODUCTOS
<!--
INSERT INTO `productos` (`nombre_producto`, `descripcion`, `precio`, `disponibilidad`, `imagen`) VALUES
('Camisa', 'Camisa de algodón', 2500, 1, 'Camisa.jpg'),
('Pantalón', 'Pantalón de estilo moderno', 3500, 1, 'Pantalon.jpg'),
('Zapatos', 'Zapatos de cuero', 1500, 1, 'Zapatos.jpg'),
('Vestido', 'Vestido elegante para ocasiones especiales', 4500, 1, 'Vestido.jpg'),
('Chaqueta', 'Chaqueta de invierno acolchada', 3000, 1, 'Chaqueta.jpg'),
('Sombrero', 'Sombrero de ala ancha para el verano', 500, 1, 'Sombrero.jpg'),
('Bufanda', 'Bufanda suave y abrigada para el frío', 300, 1, 'Bufanda.jpg'),
('Calcetines', 'Calcetines cómodos', 100, 1, 'Calcetines.jpg');
-->

INSERTAR RESGISTROS DE COMPRAS
<!-- 

-- VENTA 1
SET @idUsuarioVenta = 31;
SET @fechaVenta = CURDATE();
SET @correoVenta = 'correo@ejemplo.com';
SET @telVenta = '123456789';
SET @direccionVenta = 'Calle Ejemplo, Ciudad';

-- Productos comprados en esta venta
SET @idProducto1 = 217;
SET @idProducto2 = 218;
SET @idProducto3 = 219;

-- Insertar registros en la tabla resumenes
INSERT INTO resumenes (id_producto, id_usuario, fecha, correo, tel, direccion) VALUES
    (@idProducto1, @idUsuarioVenta, @fechaVenta, @correoVenta, @telVenta, @direccionVenta),
    (@idProducto2, @idUsuarioVenta, @fechaVenta, @correoVenta, @telVenta, @direccionVenta),
    (@idProducto3, @idUsuarioVenta, @fechaVenta, @correoVenta, @telVenta, @direccionVenta);

-- Actualizar disponibilidad de los productos a falso
UPDATE productos SET disponibilidad = 0 WHERE id_producto IN (@idProducto1, @idProducto2, @idProducto3); 

-- VENTA 2

SET @idUsuarioVenta = 32;
SET @fechaVenta = CURDATE();
SET @correoVenta = 'correo@ejemplo.com';
SET @telVenta = '123456789';
SET @direccionVenta = 'Calle Ejemplo, Ciudad';

-- Productos comprados en esta venta
SET @idProducto1 = 220;
SET @idProducto2 = 221;
SET @idProducto3 = 222;

-- Insertar registros en la tabla resumenes
INSERT INTO resumenes (id_producto, id_usuario, fecha, correo, tel, direccion) VALUES
    (@idProducto1, @idUsuarioVenta, @fechaVenta, @correoVenta, @telVenta, @direccionVenta),
    (@idProducto2, @idUsuarioVenta, @fechaVenta, @correoVenta, @telVenta, @direccionVenta),
    (@idProducto3, @idUsuarioVenta, @fechaVenta, @correoVenta, @telVenta, @direccionVenta);

-- Actualizar disponibilidad de los productos a falso
UPDATE productos SET disponibilidad = 0 WHERE id_producto IN (@idProducto1, @idProducto2, @idProducto3); 

-- VENTA 3

SET @idUsuarioVenta = 33; 
SET @fechaVenta = CURDATE();
SET @correoVenta = 'correo@ejemplo.com';
SET @telVenta = '123456789';
SET @direccionVenta = 'Calle Ejemplo, Ciudad';


SET @idProducto1 = 223; 
SET @idProducto2 = 224;

-- Insertar registros en la tabla resumenes
INSERT INTO resumenes (id_producto, id_usuario, fecha, correo, tel, direccion) VALUES
    (@idProducto1, @idUsuarioVenta, @fechaVenta, @correoVenta, @telVenta, @direccionVenta),
    (@idProducto2, @idUsuarioVenta, @fechaVenta, @correoVenta, @telVenta, @direccionVenta);

-- Actualizar disponibilidad de los productos a falso
UPDATE productos SET disponibilidad = 0 WHERE id_producto IN (@idProducto1, @idProducto2); 

-->






