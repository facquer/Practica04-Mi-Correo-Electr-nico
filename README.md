# Practica04-Mi-Correo-Electr-nico
<strong>•DIAGRAMA E-R</strong><br>
![Imagen Git](capturas/diagrama.png)<br>
Nombre de la base: base_correo<br>
CREATE TABLE USUARIOS (<br>
    usu_codigo int(11) NOT NULL AUTO_INCREMENT,<br>
    usu_cedula varchar(20) NOT NULL,<br>
    usu_nombres varchar(50) NOT NULL,<br>
    usu_apellidos varchar(50) NOT NULL,<br>
    usu_correo varchar(20) NOT NULL,<br>
    usu_password varchar(255) NOT NULL,<br>
    usu_fecha_nac date NOT NULL,<br>
    usu_imagen longblob DEFAULT NULL,<br>
    usu_img_extencion varchar(50) DEFAULT 'NULL',<br>
    usu_eliminado varchar(1) NOT NULL DEFAULT 'N',<br>
    usu_fecha_creacion timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,<br>
    usu_fecha_modificacion timestamp NULL DEFAULT NULL,<br>
    usu_rol_id int NOT NULL,<br>
    PRIMARY KEY (usu_codigo),<br>
    UNIQUE KEY usu_cedula (usu_cedula),<br>
    FOREIGN KEY (usu_rol_id) REFERENCES roles(rol_codigo)<br>
    ) ENGINE=INNODB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;<br>


CREATE TABLE ROLES(<br>
    rol_codigo int PRIMARY KEY NOT NULL AUTO_INCREMENT,<br>
    rol_descripcion varchar(25) NOT NULL,<br>
    rol_usu_creacion varchar(7) NOT NULL,<br>
    rol_usu_modifica varchar(20),<br>
    rol_usu_fecha_modifica timestamp DEFAULT CURRENT_TIMESTAMP,<br>
    rol_usu_elimina varchar(7),<br>
    rol_usu_fecha_elimina timestamp DEFAULT CURRENT_TIMESTAMP<br>
    ) ENGINE=INNODB DEFAULT charset=utf8 AUTO_INCREMENT=1;<br>


CREATE TABLE CORREOS(<br>
    cor_codigo int PRIMARY KEY NOT NULL AUTO_INCREMENT,<br>
    cor_fec_mensaje timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,<br>
    cor_asunto varchar(200) NOT NULL,<br>
    cor_mensaje varchar(1000) NOT NULL,<br>
    cor_usu_elimina int,<br>
    cor_estado_elimina varchar(1) DEFAULT 'N',<br>
    cor_usu_fec_elimina timestamp DEFAULT CURRENT_TIMESTAMP,<br>
    cor_usu_destino varchar(50) NOT NULL,<br>
    cor_id_usu_remitente int NOT NULL,<br>
    FOREIGN KEY (cor_id_usu_remitente) REFERENCES usuarios(usu_codigo)<br>
    );<br>

INSERT INTO ROLES VALUES (1,'Admin','Administrador','N','S','N','S');<br>

INSERT INTO ROLES VALUES (2,'Usuario','Usuario','N','S','N','S');<br>
<br>
<br>
<strong>•PROGRAMA FUNCIONANDO</strong><br>
![Imagen Git](capturas/inicio.png)<br>
![Imagen Git](capturas/registro.png)<br>
![Imagen Git](capturas/mensajes.png)<br>
![Imagen Git](capturas/nuevo.png)<br>
![Imagen Git](capturas/cuenta.png)<br>
