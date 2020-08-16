
create database proyectoFinalAplicaciones;
use proyectoFinalAplicaciones;

create table Administrador(
    idAdministrador int not null auto_increment,
    nombre varchar(50) not null,
    email varchar(80) not null unique,
    clave varchar(100) not null,
    foto varchar(80),
    primary key(idAdministrador)
);

create table Cliente(
    idCliente int not null auto_increment,
    nombre varchar(50) not null,
    email varchar(80) not null unique,
    direccion varchar (100) not null,
    clave varchar(100) not null,
    foto varchar(80),
    estado int not null,
    codigoActivacion varchar(100),
    primary key(idCliente)
);

create table Despachador(
    idDespachador int not null auto_increment,
    nombre varchar(50) not null,
    email varchar(80) not null unique,
    telefono bigint not null,
    clave varchar(100) not null,
    foto varchar(80),
    estado int not null,
    primary key(idDespachador)
);

create table Conductor(
    idConductor int not null auto_increment,
    nombre varchar(50) not null,
    email varchar(80) not null unique,
    telefono bigint not null,
    clave varchar(100) not null,
    foto varchar(80),
    estado int not null,
    primary key(idConductor)
);

create table precio(
    idPrecio int not null auto_increment,
    pesoMinimo double not null,
    pesoMaximo double not null,
    precio double not null,
    primary key(idPrecio)
);


create table Accion(
    idAccion int not null,
    nombre varchar(50) not null,
    primary key (idAccion)
);

create table accionEstado(
    idAccion int not null auto_increment,
    nombre varchar(50) not null,
    descripcion varchar(100) not null,
    primary key(idAccion)
);

create table logAdministrador(
    idLogAdministrador int not null auto_increment,
    fecha datetime not null,
    browser varchar(50) not null,
    os varchar(50) not null,
    informacion text,
    FK_idAdministrador int not null,
    FK_idAccion int not null,
    primary key(idLogAdministrador),
    Foreign key (FK_idAdministrador) references administrador(idAdministrador),
    Foreign key (FK_idAccion) references Accion(idAccion)
);

create table logCliente(
    idLogCliente int not null auto_increment,
    fecha datetime not null,
    browser varchar(50) not null,
    os varchar(50) not null,
    informacion text,
    FK_idCliente int not null,
    FK_idAccion int not null,
    primary key(idLogCliente),
    Foreign key (FK_idCliente) references Cliente(idCliente),
    Foreign key (FK_idAccion) references Accion(idAccion)
);

create table logConductor(
    idLogConductor int not null auto_increment,
    fecha datetime not null,
    browser varchar(50) not null,
    os varchar(50) not null,
    informacion text,
    FK_idConductor int not null,
    FK_idAccion int not null,
    primary key(idLogConductor),
    Foreign key (FK_idConductor) references Conductor(idConductor),
    Foreign key (FK_idAccion) references Accion(idAccion)
);

create table logDespachador(
    idLogDespachador int not null auto_increment,
    fecha datetime not null,
    browser varchar(50) not null,
    os varchar(50) not null,
    informacion text,
    FK_idDespachador int not null,
    FK_idAccion int not null,
    primary key(idLogDespachador),
    Foreign key (FK_idDespachador) references Despachador(idDespachador),
    Foreign key (FK_idAccion) references Accion(idAccion)
);

create table cita(
	idCita int not null auto_increment,
	fechaCita date not null,
	FK_idConductor int not null,
	primary key(idCita),
	Foreign key(FK_idConductor) references Conductor(idConductor)
);

create table Envio(
	idEnvio int not null auto_increment,
	fechaSalida date not null,
	FK_idConductor int not null,
	primary key(idEnvio),
	Foreign key (FK_idConductor) references Conductor(idConductor)
);

create table Orden(
	idOrden int not null auto_increment,
	fecha datetime not null,
	fechaEstimacion date not null,
	direccionDestino varchar(100) not null,
	contacto varchar(100) not null,
	numeroContacto bigint not null,
	fechaLlegada date null,
	FK_idCliente int not null,
	FK_idCita int not null,
	FK_idEnvio int null,
	FK_idDespachador int null,
	primary key(idOrden),
	Foreign key (FK_idCliente) references Cliente(idCliente),
	Foreign key (FK_idCita) references Cita(idCita),
	Foreign key (FK_idEnvio) references Envio(idEnvio),
	Foreign key (FK_idDespachador) references Despachador(idDespachador)
);
create table estadoCliente(
	idEstadoCliente int not null auto_increment,
	fecha datetime not null,
	FK_idAccionEstado int not null,
	FK_idOrden int not null,
	FK_idCliente int not null,
	primary key(idEstadoCliente),
	foreign key(FK_idAccionEstado) references AccionEstado(idAccion),
	foreign key(FK_idOrden) references orden(idOrden),
	foreign key(FK_idCliente) references cliente(idCliente)
);

create table estadoDespachador(
	idEstadoDespachador int not null auto_increment,
	fecha datetime not null,
	FK_idAccionEstado int not null,
	FK_idOrden int not null,
	FK_idDespachador int not null,
	primary key(idEstadoDespachador),
	foreign key(FK_idAccionEstado) references AccionEstado(idAccion),
	foreign key(FK_idOrden) references orden(idOrden),
	foreign key(FK_idDespachador) references despachador(idDespachador)
);

create table EstadoConductor(
	idEstadoConductor int not null auto_increment,
	fecha datetime not null,
	FK_idAccionEstado int not null,
	FK_idOrden int not null,
	FK_idConductor int not null,
	primary key(idEstadoConductor),
	Foreign key (FK_idAccionEstado) references AccionEstado(idAccion),
	Foreign key (FK_idOrden) references Orden(idOrden),
	Foreign key (FK_idConductor) references Conductor(idConductor)
);

create table comentarioDespachador(
	idComentarioDespachador int not null auto_increment,
	fecha datetime not null,
	comentario varchar(500) not null,
	FK_idEstadoDespachador int not null,
	primary key(idComentarioDespachador),
	foreign key(FK_idEstadoDespachador) references EstadoDespachador(idEstadoDespachador)
);

create table comentarioConductor(
	idComentarioConductor int not null auto_increment,
	fecha datetime not null,
	comentario varchar(500) not null,
	FK_idEstadoConductor int not null,
	primary key(idComentarioConductor),
	foreign key(FK_idEstadoConductor) references EstadoConductor(idEstadoConductor)
);

create table comentarioCliente(
	idComentarioCliente int not null auto_increment,
	fecha datetime not null,
	comentario varchar(500) not null,
	FK_idEstadoCliente int not null,
	primary key(idComentarioCliente),
	foreign key(FK_idEstadoCliente) references EstadoCliente(idEstadoCliente)
);

create table item(
	idItem int not null auto_increment,
	referencia varchar(50) not null,
	nombre varchar(50) not null,
	descripcion varchar(500) not null,
	peso int not null,
	fabricante varchar(50) not null,
	precio float not null,
	FK_idOrden int not null,
	primary key(idItem),
	foreign key(FK_idOrden) references Orden(idOrden)
);


insert into administrador (nombre, email, clave) values('Admin Admin', 'admin@gmail.com', md5('123'));
insert into cliente (nombre, email, direccion, clave, estado) values('Cliente Cliente', 'cliente@gmail.com', 'calle 55 a sur # 78j - 41', md5('123'), 1);

insert into Conductor (nombre, email, telefono, clave, estado) values('Conductor Conductor', 'conductor@gmail.com', '7793395', md5('123'), 1);
insert into Despachador (nombre, email, telefono, clave, estado) values('Despachador Despachador', 'despachador@gmail.com', '7793395', md5('123'), 1);

insert into precio values (1, 0.1,1,5000);
insert into precio values (2, 1.1,3,10000);
insert into precio values (3, 3.1,5,20000);
insert into precio values (4, 5.1,10,50000);
insert into precio values (5, 10.1,30,80000);

insert into Accion values (1, 'Inicio de sesion');
insert into Accion values (2, 'Cierre de sesion');
insert into Accion values (3, 'Crear cliente');
insert into Accion values (4, 'Actualizar estado cliente');
insert into Accion values (5, 'Actualizar información cliente');
insert into Accion values (6, 'Crear conductor');
insert into Accion values (7, 'Actualizar estado conductor');
insert into Accion values (8, 'Actualizar información conductor');
insert into Accion values (9, 'Crear despachador');
insert into Accion values (10, 'Actualizar estado despachador');
insert into Accion values (11, 'Actualizar información despachador');
insert into Accion values (12, 'Actualizar información personal');
insert into Accion values (13, 'Cambiar contraseña');
insert into Accion values (14, 'Crear orden');
insert into Accion values (15, 'Crear comentario cliente');
insert into Accion values (16, 'Crear comentario despachador');
insert into Accion values (17, 'Crear comentario conductor');
insert into Accion values (18, 'Generar PDF');
insert into Accion values (19, 'Registrar Cliente');

insert into accionEstado values(1, 'Registro de envío','El cliente realiza el registro del envio a través de la plataforma');
insert into accionEstado values(2, 'En recoleccion','El conductor se encuentra en proceso de recolección');
insert into accionEstado values(3, 'Recogido','Se recogen todos los paquetes de los clientes que se enviaran');
insert into accionEstado values(4, 'No recogido','El paquete no ha sido recogido');
insert into accionEstado values(5, 'Recibido','El paquete llego a la bodega');
insert into accionEstado values(6, 'En Bodega','El paquete esta en bodega y esta siendo registrado para el envio');
insert into accionEstado values(7, 'Despachado','El paquete ya fue enviado a su destino');
insert into accionEstado values(8, 'En camino','El paquete va en camino a su destino');
insert into accionEstado values(9, 'Entregado','El paquete ya fue entregado al destinatario');

/*
insert into accionEstado(nombre,descripcion) values('No Entregado','El paquete no ha sido entregado al destinatario');
insert into accionEstado(nombre,descripcion) values('Devolucion','El paquete no ha sido entregado al destinatario');

*/