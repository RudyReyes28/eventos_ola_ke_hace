CREATE SCHEMA `eventos_ola_ke_hace` ;

CREATE TABLE `eventos_ola_ke_hace`.`usuario_registrado` (
  `idusuario_registrado` INT NOT NULL AUTO_INCREMENT,
  `tipo_usuario` VARCHAR(45) NOT NULL,
  `ussername` VARCHAR(45) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idusuario_registrado`));

CREATE TABLE `eventos_ola_ke_hace`.`usuario_publicacion` (
  `idusuario_publicacion` INT NOT NULL AUTO_INCREMENT,
  `registro_usuario` INT NOT NULL,
  `cant_publicaciones` INT NULL DEFAULT 0,
  `privilegio_auto` TINYINT NULL DEFAULT 0,
  `estado_ban` TINYINT NULL DEFAULT 0,
  `nombre_c` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idusuario_publicacion`),
  INDEX `fk_usserp_idregistro_idx` (`registro_usuario` ASC) VISIBLE,
  CONSTRAINT `fk_usserp_idregistro`
    FOREIGN KEY (`registro_usuario`)
    REFERENCES `eventos_ola_ke_hace`.`usuario_registrado` (`idusuario_registrado`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT);
    
CREATE TABLE `eventos_ola_ke_hace`.`usuario_admin` (
  `idusuario_admin` INT NOT NULL AUTO_INCREMENT,
  `id_registro` INT NOT NULL,
  `nombre_c` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idusuario_admin`),
  INDEX `fk_usserad_idregistro_idx` (`id_registro` ASC) VISIBLE,
  CONSTRAINT `fk_usserad_idregistro`
    FOREIGN KEY (`id_registro`)
    REFERENCES `eventos_ola_ke_hace`.`usuario_registrado` (`idusuario_registrado`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT);

CREATE TABLE `eventos_ola_ke_hace`.`usuario_participante` (
  `idusuario_participante` INT NOT NULL AUTO_INCREMENT,
  `id_registro` INT NOT NULL,
  `nombre_C` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idusuario_participante`),
  INDEX `fk_usserpar_idregistro_idx` (`id_registro` ASC) VISIBLE,
  CONSTRAINT `fk_usserpar_idregistro`
    FOREIGN KEY (`id_registro`)
    REFERENCES `eventos_ola_ke_hace`.`usuario_registrado` (`idusuario_registrado`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT);
    

CREATE TABLE `eventos_ola_ke_hace`.`publicacion` (
  `idpublicacion` INT NOT NULL AUTO_INCREMENT,
  `lugar` VARCHAR(45) NOT NULL,
  `fecha` DATE NOT NULL,
  `hora` TIME NOT NULL,
  `usuario_publicador` INT NOT NULL,
  `categoria` VARCHAR(45) NOT NULL,
  `url` VARCHAR(45) NULL,
  `asistencias` INT NULL DEFAULT 0,
  `cant_cupo` INT NOT NULL,
  `tipo_publico` VARCHAR(45) NOT NULL,
  `cant_reportes` INT NULL DEFAULT 0,
  `estado` VARCHAR(45) NULL,
  PRIMARY KEY (`idpublicacion`),
  INDEX `fk_publicacion_idusuario_idx` (`usuario_publicador` ASC) VISIBLE,
  CONSTRAINT `fk_publicacion_idusuario`
    FOREIGN KEY (`usuario_publicador`)
    REFERENCES `eventos_ola_ke_hace`.`usuario_publicacion` (`idusuario_publicacion`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT);
    
CREATE TABLE `eventos_ola_ke_hace`.`elemento_publicacion` (
  `idelemento_publicacion` INT NOT NULL AUTO_INCREMENT,
  `id_publicacion` INT NOT NULL,
  `tipo_elemento` VARCHAR(45) NOT NULL,
  `contenido` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`idelemento_publicacion`),
  INDEX `fk_elementop_idp_idx` (`id_publicacion` ASC) VISIBLE,
  CONSTRAINT `fk_elementop_idp`
    FOREIGN KEY (`id_publicacion`)
    REFERENCES `eventos_ola_ke_hace`.`publicacion` (`idpublicacion`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT);

CREATE TABLE `eventos_ola_ke_hace`.`reporte_publicacion` (
  `idreporte_publicacion` INT NOT NULL AUTO_INCREMENT,
  `id_publicacion` INT NOT NULL,
  `id_usuario_participante` INT NOT NULL,
  `motivo_reporte` VARCHAR(255) NOT NULL,
  `reporte_aprobado` VARCHAR(45) NULL,
  PRIMARY KEY (`idreporte_publicacion`),
  INDEX `fk_reporte_idpublicacion_idx` (`id_publicacion` ASC) VISIBLE,
  INDEX `fk_usuariop_reporte_idx` (`id_usuario_participante` ASC) VISIBLE,
  CONSTRAINT `fk_reporte_idpublicacion`
    FOREIGN KEY (`id_publicacion`)
    REFERENCES `eventos_ola_ke_hace`.`publicacion` (`idpublicacion`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_usuariop_reporte`
    FOREIGN KEY (`id_usuario_participante`)
    REFERENCES `eventos_ola_ke_hace`.`usuario_participante` (`idusuario_participante`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT);
    
CREATE TABLE `eventos_ola_ke_hace`.`asistir_evento` (
  `id_evento` INT NOT NULL AUTO_INCREMENT,
  `id_publicacion` INT NOT NULL,
  `id_usuario_p` INT NOT NULL,
  `estado_evento` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_evento`),
  INDEX `fk_evento_idpublicacion_idx` (`id_publicacion` ASC) VISIBLE,
  INDEX `fk_evento_usuario_p_idx` (`id_usuario_p` ASC) VISIBLE,
  CONSTRAINT `fk_evento_idpublicacion`
    FOREIGN KEY (`id_publicacion`)
    REFERENCES `eventos_ola_ke_hace`.`publicacion` (`idpublicacion`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `fk_evento_usuario_p`
    FOREIGN KEY (`id_usuario_p`)
    REFERENCES `eventos_ola_ke_hace`.`usuario_participante` (`idusuario_participante`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT);
    



--GENERANDO QUERYS PARA GUARDAR USUARIOS PUBLICADOR

--publicadores
INSERT INTO eventos_ola_ke_hace.usuario_registrado (tipo_usuario, ussername, password)
VALUES ('publicador', 'publicador1', '$2y$10$i3BcKKLwOmuhZs57qoxKT.k2T13ZqCVSj0lPgrumD28WEl61jCIta');
INSERT INTO eventos_ola_ke_hace.usuario_registrado (tipo_usuario, ussername, password)
VALUES ('publicador', 'publicador2', '$2y$10$ZKcdzPDten8vZ4l9hsIFXug.OHxq31vZw8R.UsBcuXSxfKBLGrEfC');
INSERT INTO eventos_ola_ke_hace.usuario_registrado (tipo_usuario, ussername, password)
VALUES ('publicador', 'publicador3', '$2y$10$8nxiPoDxVZzu3JvA0fRy8OQGEt4ic1yty3Cvri9sLgY1gnqynRLDS');
INSERT INTO eventos_ola_ke_hace.usuario_registrado (tipo_usuario, ussername, password)
VALUES ('publicador', 'publicador4', '$2y$10$jTPuKKniARAttn5xD4eanuRndsdsuyj60rV/8sNzXOsYR3KXZX8JC');
INSERT INTO eventos_ola_ke_hace.usuario_registrado (tipo_usuario, ussername, password)
VALUES ('publicador', 'publicador5', '$2y$10$jDl/LuI0TI8oDXCNLRWb7ely2BcYbboys/xOO7/OEOEnwGpmNFMz6');

--usuario participantes
INSERT INTO eventos_ola_ke_hace.usuario_registrado (tipo_usuario, ussername, password)
VALUES ('participante', 'participante1', '$2y$10$idmLLy1TzNqlWh8xySCM7OsJC2yAsRpw7YNuqbQnzLw/.ykbUe8dS');
INSERT INTO eventos_ola_ke_hace.usuario_registrado (tipo_usuario, ussername, password)
VALUES ('participante', 'participante2', '$2y$10$.RU0DZKInYz54Ramp4yX8ua3Xel0gsNNEz9AEn8VB7Nkg1cwyNxre');
INSERT INTO eventos_ola_ke_hace.usuario_registrado (tipo_usuario, ussername, password)
VALUES ('participante', 'participante3', '$2y$10$81.tModb2INfLMLhUfr7PuClI/VL.EkAoRbVFmWAhDCvkc9UhGpwC');
INSERT INTO eventos_ola_ke_hace.usuario_registrado (tipo_usuario, ussername, password)
VALUES ('participante', 'participante4', '$2y$10$CLBmWX8FTA9a/o8qc8SroeRVTgsPsAZbrXoIIQLE.utgXKhIeh0ii');
INSERT INTO eventos_ola_ke_hace.usuario_registrado (tipo_usuario, ussername, password)
VALUES ('participante', 'participante5', '$2y$10$gHG0jX43I.QdnHnFpWn8ZeIlp1yeTXzufIBmQSsCgu4Tiv4BNBDVi');


--administrador
INSERT INTO eventos_ola_ke_hace.usuario_registrado (tipo_usuario, ussername, password)
VALUES ('administrador', 'administrador1', '$2y$10$r15lgILXt6ua5RGk2mP..e4na7yrmQxAgonsP7aMsZlMh9.i2gZ3O');

--tabla usuario participante
INSERT INTO eventos_ola_ke_hace.usuario_publicacion (registro_usuario, nombre_c) VALUES
(1, 'Juan Carlos Lopez Espinoza'),
(2, 'Amanda Amarilis Rodriguez Paz'),
(3, 'Pedro Armando Porro Rey'),
(4, 'Amarilis Dayana Belen Juarez'),
(5, 'Mario Ricardo Dardon Barillas');

INSERT INTO eventos_ola_ke_hace.usuario_participante (id_registro, nombre_c) VALUES
(6, 'Maria Antonieta de las Nieves'),
(7, 'Roberto Gomez Bolanios'),
(8, 'Richard Lopez Jerez'),
(9, 'Marilin Adriana Reyes Perez'),
(10, 'Lionel Andres Messi Cuchitini');

INSERT INTO eventos_ola_ke_hace.usuario_admin(id_registro, nombre_c) VALUES
(11, 'Rudy Alessandro Reyes Oxlaj');


DELIMITER //

CREATE FUNCTION crear_publicacion(
    lugar VARCHAR(45),
    fecha DATE,
    hora TIME,
    usuario_publicador INT,
    categoria VARCHAR(45),
    url VARCHAR(45),
    cant_cupo INT,
    tipo_publico VARCHAR(45)
)
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE estado_publicacion VARCHAR(45);
    DECLARE id_publicacion INT;
    
    -- Paso 2: Verificar si el usuario tiene privilegio automático
    SELECT privilegio_auto INTO @privilegio_auto
    FROM usuario_publicacion
    WHERE idusuario_publicacion = usuario_publicador;
    
    -- Si tiene privilegio_auto, el estado será 'publicado', de lo contrario 'pendiente'
    IF @privilegio_auto = 1 THEN
        SET estado_publicacion = 'publicado';
        
        -- Incrementar la cantidad de publicaciones del usuario
        UPDATE usuario_publicacion
        SET cant_publicaciones = cant_publicaciones + 1
        WHERE idusuario_publicacion = usuario_publicador;
    ELSE
        SET estado_publicacion = 'pendiente';
    END IF;
    
    -- Paso 3: Insertar los datos en la tabla publicacion
    INSERT INTO publicacion (lugar, fecha, hora, usuario_publicador, categoria, url, cant_cupo, tipo_publico, estado)
    VALUES (lugar, fecha, hora, usuario_publicador, categoria, url, cant_cupo, tipo_publico, estado_publicacion);
    
    -- Obtener el ID de la publicación insertada
    SET id_publicacion = LAST_INSERT_ID();
    
    -- Retornar el ID de la nueva publicación
    RETURN id_publicacion;
END //

DELIMITER ;


CREATE VIEW vista_publicaciones_usuario AS
SELECT 
    p.idpublicacion, 
    p.lugar, 
    p.fecha, 
    p.hora, 
    p.usuario_publicador, 
    p.categoria, 
    p.url,
    p.asistencias, 
    p.cant_cupo, 
    p.tipo_publico, 
    p.cant_reportes, 
    p.estado, 
    u.nombre_c 
FROM 
    publicacion p
INNER JOIN 
    usuario_publicacion u 
    ON u.idusuario_publicacion = p.usuario_publicador;
	
	
	
DELIMITER //
CREATE FUNCTION manejar_reporte(
    in_id_publicacion INT,
    in_id_usuario_participante INT,
    in_motivo_reporte VARCHAR(255)
) 
RETURNS VARCHAR(45)
DETERMINISTIC
BEGIN
    DECLARE cant_reportes_actuales INT;
    DECLARE nuevo_estado VARCHAR(45);

    -- Paso 2: Inserción del reporte en la tabla reporte_publicacion
    INSERT INTO reporte_publicacion (id_publicacion, id_usuario_participante, motivo_reporte, reporte_aprobado)
    VALUES (in_id_publicacion, in_id_usuario_participante, in_motivo_reporte, 'pendiente');

    -- Paso 3: Actualizar la cantidad de reportes en la tabla publicacion
    UPDATE publicacion 
    SET cant_reportes = cant_reportes + 1
    WHERE idpublicacion = in_id_publicacion;

    -- Paso 4: Obtener la cantidad de reportes actualizados
    SELECT cant_reportes INTO cant_reportes_actuales
    FROM publicacion 
    WHERE idpublicacion = in_id_publicacion;

    -- Verificar si los reportes son 3 o más para marcar el estado como 'reportado'
    IF cant_reportes_actuales >= 3 THEN
        UPDATE publicacion 
        SET estado = 'reportado'
        WHERE idpublicacion = in_id_publicacion;
        SET nuevo_estado = 'reportado';
    ELSE
        SET nuevo_estado = 'activo';
    END IF;

    -- Retornar el estado de la publicación
    RETURN nuevo_estado;
    
END//
DELIMITER ;


DELIMITER //

CREATE FUNCTION registrar_asistencia(
    in_id_publicacion INT,
    in_id_usuario INT,
    in_estado_evento VARCHAR(45)
) 
RETURNS VARCHAR(255)
DETERMINISTIC
BEGIN
    DECLARE mensaje VARCHAR(255);

    -- Verificar si el usuario ya está registrado en el evento
    IF EXISTS (
        SELECT 1 FROM asistir_evento 
        WHERE id_publicacion = in_id_publicacion 
         AND id_usuario_p = in_id_usuario AND estado_evento = 'asistiendo'
    ) THEN
        SET mensaje = 'El usuario ya está registrado para este evento.';
    ELSE
        -- Insertar el registro de asistencia en la tabla asistir_evento
        INSERT INTO asistir_evento (id_publicacion, id_usuario_p, estado_evento) 
        VALUES (in_id_publicacion, in_id_usuario, in_estado_evento);
        
        -- Actualizar el contador de asistencias en la tabla publicacion
        UPDATE publicacion 
        SET asistencias = asistencias + 1
        WHERE idpublicacion = in_id_publicacion;
        
        SET mensaje = 'Asistencia registrada exitosamente.';
    END IF;

    RETURN mensaje;
END //

DELIMITER ;


CREATE VIEW vista_eventos_asistidos AS
SELECT 
    p.idpublicacion, 
    p.lugar, 
    p.fecha, 
    p.hora, 
    p.usuario_publicador, 
    p.categoria, 
    p.url,
    p.asistencias, 
    p.cant_cupo, 
    p.tipo_publico, 
    p.cant_reportes, 
    p.estado,
    ae.id_usuario_p,
    ae.estado_evento,
	ae.id_evento
FROM 
    publicacion p
INNER JOIN 
    asistir_evento ae
    ON ae.id_publicacion = p.idpublicacion;
	
	

DELIMITER //

CREATE FUNCTION cancelar_asistencia(
    in_id_evento INT,
    in_id_publicacion INT
)
RETURNS VARCHAR(100)
DETERMINISTIC
BEGIN
    DECLARE msg VARCHAR(100);
    
    -- Cambiar el estado del evento a "cancelado"
    UPDATE asistir_evento
    SET estado_evento = 'cancelado'
    WHERE id_evento = in_id_evento;

    -- Verificar si el estado se cambió correctamente
    IF ROW_COUNT() = 0 THEN
        SET msg = 'No se encontró el evento o ya estaba cancelado.';
        RETURN msg;
    END IF;
    
    -- Reducir en uno la cantidad de asistencias en la tabla publicacion
    UPDATE publicacion
    SET asistencias = asistencias - 1
    WHERE idpublicacion = in_id_publicacion;

    -- Verificar si se actualizó la asistencia correctamente
    IF ROW_COUNT() = 0 THEN
        SET msg = 'Error al actualizar la asistencia en la tabla publicacion.';
        RETURN msg;
    END IF;
    
    -- Si todo fue exitoso, devolver un mensaje de éxito
    SET msg = 'Asistencia cancelada exitosamente.';
    RETURN msg;
END //

DELIMITER ;


DELIMITER //

CREATE FUNCTION aprobar_publicacion(in_idpublicacion INT)
RETURNS VARCHAR(100)
DETERMINISTIC
BEGIN
    DECLARE msg VARCHAR(100);
    DECLARE in_usuario_publicador INT;

    -- Cambiar el estado de la publicación a 'publicado'
    UPDATE publicacion
    SET estado = 'publicado'
    WHERE idpublicacion = in_idpublicacion;

    -- Verificar si se actualizó el estado de la publicación
    IF ROW_COUNT() = 0 THEN
        SET msg = 'Error: No se encontró la publicación o ya estaba publicada.';
        RETURN msg;
    END IF;

    -- Obtener el ID del usuario publicador
    SELECT usuario_publicador INTO in_usuario_publicador
    FROM publicacion
    WHERE idpublicacion = in_idpublicacion;

    -- Incrementar en 1 el número de publicaciones del usuario publicador
    UPDATE usuario_publicacion
    SET cant_publicaciones = cant_publicaciones + 1
    WHERE idusuario_publicacion = in_usuario_publicador;

    -- Verificar si el número de publicaciones ahora es mayor a 2
    IF (SELECT cant_publicaciones FROM usuario_publicacion WHERE idusuario_publicacion = in_usuario_publicador) > 2 THEN
        -- Establecer el privilegio_auto a 1
        UPDATE usuario_publicacion
        SET privilegio_auto = 1
        WHERE idusuario_publicacion = in_usuario_publicador;
    END IF;

    -- Si todo fue exitoso, devolver un mensaje de éxito
    SET msg = 'Publicación aprobada exitosamente.';
    RETURN msg;
END //

DELIMITER ;


DELIMITER //

CREATE FUNCTION aprobarReportePublicacion(id_id_publicacion INT)
RETURNS VARCHAR(100)
DETERMINISTIC
BEGIN
    DECLARE publicador_id INT;
    DECLARE privilegio_auto_a INT;
    DECLARE mensaje VARCHAR(100);

    -- 1. Cambiar el estado de todos los reportes de la publicación a 'aprobado' si están en 'pendiente'
    UPDATE reporte_publicacion
    SET reporte_aprobado = 'aprobado'
    WHERE id_publicacion = id_id_publicacion AND reporte_aprobado = 'pendiente';

    -- 2. Cambiar el estado de la publicación a 'reportado'
    UPDATE publicacion
    SET estado = 'reportado'
    WHERE idpublicacion = id_id_publicacion;

    -- Obtener el ID del publicador de la publicación
    SELECT usuario_publicador INTO publicador_id
    FROM publicacion
    WHERE idpublicacion = id_id_publicacion;

    -- 3. Descontar 1 a la cantidad de publicaciones del usuario publicador
    UPDATE usuario_publicacion
    SET cant_publicaciones = cant_publicaciones - 1
    WHERE idusuario_publicacion = publicador_id;

    -- 4. Verificar el privilegio automático del usuario publicador
    SELECT privilegio_auto INTO privilegio_auto_a
    FROM usuario_publicacion
    WHERE idusuario_publicacion = publicador_id;

    IF privilegio_auto_a = 1 THEN
        -- Si privilegio_auto es 1, colocarlo en 0
        UPDATE usuario_publicacion
        SET privilegio_auto = 0
        WHERE idusuario_publicacion = publicador_id;
        SET mensaje = 'Privilegio automático desactivado para el usuario publicador.';
    ELSE
        -- Si privilegio_auto no es 1, banear al usuario (estado_ban = 1)
        UPDATE usuario_publicacion
        SET estado_ban = 1
        WHERE idusuario_publicacion = publicador_id;
        SET mensaje = 'Usuario publicador ha sido baneado.';
    END IF;

    RETURN mensaje;
END //

DELIMITER ;

DELIMITER //

CREATE FUNCTION registrar_usuario_publicador(
    nombreCompleto VARCHAR(45),
    username VARCHAR(45),
    contrasena VARCHAR(100)
) RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE nuevo_id INT;

    -- Paso 1: Insertar en usuario_registrado
    INSERT INTO usuario_registrado (tipo_usuario, ussername, password)
    VALUES ('publicador', username, contrasena);

    -- Obtener el ID generado para usuario_registrado
    SET nuevo_id = LAST_INSERT_ID();

    -- Paso 2: Insertar en usuario_publicacion usando el ID anterior
    INSERT INTO usuario_publicacion (registro_usuario, nombre_c, cant_publicaciones, privilegio_auto, estado_ban)
    VALUES (nuevo_id, nombreCompleto, 0, 0, 0);

    -- Retornar el ID del usuario registrado
    RETURN nuevo_id;
END //

DELIMITER ;


DELIMITER //

CREATE FUNCTION registrar_usuario_participante(
    nombreCompleto VARCHAR(45),
    username VARCHAR(45),
    contrasena VARCHAR(100)
) RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE nuevo_id INT;

    -- Paso 1: Insertar en usuario_registrado
    INSERT INTO usuario_registrado (tipo_usuario, ussername, password)
    VALUES ('participante', username, contrasena);

    -- Obtener el ID generado para usuario_registrado
    SET nuevo_id = LAST_INSERT_ID();

    -- Paso 2: Insertar en usuario_publicacion usando el ID anterior
    INSERT INTO usuario_participante (id_registro, nombre_c)
    VALUES (nuevo_id, nombreCompleto);

    -- Retornar el ID del usuario registrado
    RETURN nuevo_id;
END //

DELIMITER ;