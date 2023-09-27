-- Tabla Departamento
CREATE TABLE departamento (
    iddepartamento INT AUTO_INCREMENT PRIMARY KEY,
    departamento VARCHAR(255) NOT NULL
);

-- Tabla Tipo_Usuario
CREATE TABLE tipo_usuario (
    idtipo_usuario INT AUTO_INCREMENT PRIMARY KEY,
    tipo_usuario VARCHAR(255) NOT NULL
);

-- Tabla Estado
CREATE TABLE estado (
    idestado INT AUTO_INCREMENT PRIMARY KEY,
    estado VARCHAR(255) NOT NULL
);

-- Tabla Regiones
CREATE TABLE regiones (
    idregiones INT AUTO_INCREMENT PRIMARY KEY,
    regiones VARCHAR(255) NOT NULL
);

-- Tabla Comunas
CREATE TABLE comunas (
    idcomunas INT AUTO_INCREMENT PRIMARY KEY,
    comunasCol VARCHAR(255) NOT NULL,
    Regiones_idregiones INT NOT NULL
);

-- Tabla Tipo_Encomienda
CREATE TABLE tipo_encomienda (
    idTipo_encomienda INT AUTO_INCREMENT PRIMARY KEY,
    encomienda VARCHAR(255) NOT NULL
);

-- Tabla Codigos
CREATE TABLE codigos (
    codigo VARCHAR(255) PRIMARY KEY,
    codigo_activo VARCHAR(255) NOT NULL
);

-- Tabla Usuario
CREATE TABLE usuario (
    idusuario INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    rut VARCHAR(12) NOT NULL,
    nombre_usuario VARCHAR(255) NOT NULL,
    apellido_p VARCHAR(255) NOT NULL,
    apellido_m VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    tipo_departamento INT NOT NULL,
    tipo_usuario_idtipo_usuario INT NOT NULL
);



-- Tabla Movimiento
CREATE TABLE movimiento (
    idMovimiento INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    usuario_idusuario INT NOT NULL,
    correspondencia_codigo_barras VARCHAR(255) NOT NULL,
    estado_idestado INT NOT NULL,
    detalle_movimiento TEXT NOT NULL
);

-- Tabla Correspondencia
CREATE TABLE correspondencia (
    codigo_barras VARCHAR(255) PRIMARY KEY,
    destinatario VARCHAR(255) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    detalle TEXT NOT NULL,
    codigo_interno VARCHAR(255) NOT NULL,
    numero_seguimiento VARCHAR(255) NOT NULL,
    usuario_idusuario INT NOT NULL,
    tipo_encomienda_idTipo_encomienda INT NOT NULL,
    Comunas_idcomunas INT NOT NULL,
    codigo_masivo INT
);

-- Tabla Cliente Frecuentes
CREATE TABLE cliente_frecuentes (
    idcliente_frecuentes INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    comunas_idcomunas INT NOT NULL,
    usuario_idusuario INT NOT NULL
);



-- Agregar claves foráneas a la tabla Usuario
ALTER TABLE usuario ADD CONSTRAINT FK_TipoDepartamento_usuario FOREIGN KEY (tipo_departamento) REFERENCES departamento(iddepartamento);
ALTER TABLE usuario ADD CONSTRAINT FK_TipoUsuario_usuario FOREIGN KEY (tipo_usuario_idtipo_usuario) REFERENCES tipo_usuario(idtipo_usuario);

-- Agregar claves foráneas a la tabla Movimiento
ALTER TABLE movimiento ADD CONSTRAINT FK_Usuario_movimiento FOREIGN KEY (usuario_idusuario) REFERENCES usuario(idusuario);
ALTER TABLE movimiento ADD CONSTRAINT FK_Correspondencia_movimiento FOREIGN KEY (correspondencia_codigo_barras) REFERENCES correspondencia(codigo_barras);
ALTER TABLE movimiento ADD CONSTRAINT FK_Estado_movimiento FOREIGN KEY (estado_idestado) REFERENCES estado(idestado);

-- Agregar claves foráneas a la tabla Correspondencia
ALTER TABLE correspondencia ADD CONSTRAINT FK_Usuario_correspondencia FOREIGN KEY (usuario_idusuario) REFERENCES usuario(idusuario);
ALTER TABLE correspondencia ADD CONSTRAINT FK_TipoEncomienda_correspondencia FOREIGN KEY (tipo_encomienda_idTipo_encomienda) REFERENCES tipo_encomienda(idTipo_encomienda);
ALTER TABLE correspondencia ADD CONSTRAINT FK_Comunas_correspondencia FOREIGN KEY (Comunas_idcomunas) REFERENCES comunas(idcomunas);


-- Agregar claves foráneas a la tabla Cliente Frecuentes
ALTER TABLE cliente_frecuentes ADD CONSTRAINT FK_Comunas__clientes_frecuentes FOREIGN KEY (comunas_idcomunas) REFERENCES comunas(idcomunas);
ALTER TABLE cliente_frecuentes ADD CONSTRAINT FK_Usuario__clientes_frecuentes FOREIGN KEY (usuario_idusuario) REFERENCES usuario(idusuario);

-- Agregar claves foráneas a la tabla Comunas
ALTER TABLE comunas ADD CONSTRAINT FK_Regiones__comunas FOREIGN KEY (Regiones_idregiones) REFERENCES regiones(idregiones);

--AGREGAR DATOS


INSERT INTO regiones (idregiones, regiones) VALUES (1, 'MAULE');
INSERT INTO comunas (idcomunas, comunasCol, Regiones_idregiones) 
    VALUES (1, 'TALCA', 1), (2, 'CURICÓ', 1), (3, 'CAUQUENES', 1), (4, 'LINARES', 1);
INSERT INTO tipo_usuario (idtipo_usuario, usuario) VALUES (1, 'Administrativo'), (2, 'Funcionario');
INSERT INTO usuario (idusuario, username, password, rut, nombre_usuario, apellido_p, apellido_m, email, tipo_departamento, tipo_usuario_idtipo_usuario)
    VALUES (1, 'admin', '1234', '1-0', 'usuario por defecto', 'apellido 1', 'apellido 2', 'email@gmail.com', 1, 1);
INSERT INTO  codigo (codigo, codigo_activo)
    VALUES ('1234', 'HABILITADO'), ('12345', 'HABILITADO'), ('123456', 'HABILITADO'), ('1234567', 'HABILITADO');
INSERT INTO departamento (iddepartamento, departamento) VALUES (1, 'RRHH');
INSERT INTO tipo_encomienda (idTipo_encomienda, encomienda) 
    VALUES  (1, 'Sobre'), (2, 'balija'), (3, 'Caja');

/*
AGREGAR DATOS POR DEFECTO DE:

- regiones
    - MAULE
- comunas
    - TALCA
    - CURICÓ
    - CAUQUENES
    - LINARES  
- tipo usuario
    - Administrativo
    - Funcionario
- usuario
    - algun usuario de prueba    
- codigo
    - se pueden agregar masivamente
- departamento
    - TI
    - RRHH
- tipo encomienda
    - Sobre
    - balija
    - Caja

*/