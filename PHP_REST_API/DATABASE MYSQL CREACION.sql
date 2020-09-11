DROP DATABASE IF EXISTS comunicacion_senas;
CREATE DATABASE comunicacion_senas;
Use comunicacion_senas;

DROP TABLE IF EXISTS Senas;
CREATE TABLE Senas (
Id_Senas INT(10) NOT NULL PRIMARY KEY,
Imagen VARCHAR(50) NOT NULL,
Autor VARCHAR(50) not NULL,
Fecha_Publicacion DATE NOT NULL
);

DROP TABLE IF EXISTS significado;
CREATE TABLE significado(
Id_Significado INT (10) PRIMARY KEY NOT NULL,
Significado VARCHAR (50) not NULL
);

DROP TABLE IF EXISTS significado_senas;
CREATE TABLE significado_senas  (
  Id_Senas int(10) NOT NULL,
  Id_Significado int(10) NOT NULL,
  PRIMARY KEY (Id_Senas, Id_Significado),
  FOREIGN KEY (Id_Senas) REFERENCES Senas (Id_senas),
  FOREIGN KEY (Id_Significado) REFERENCES significado(Id_Significado)
);


DROP TABLE IF EXISTS Simbologia;
CREATE TABLE Simbologia (
Id_Simbologia INT (10) PRIMARY KEY NOT NULL,
Mensaje_Asociado VARCHAR (100) NOT NULL,
Dir_Gif VARCHAR (200) NOT NULL
);

DROP TABLE IF EXISTS Relacion;
CREATE TABLE Relacion(
Id_senas INT (10) NOT NULL,
Id_Simbologia INT (10) NOT NULL,
PRIMARY KEY (Id_senas, Id_Simbologia),
FOREIGN KEY (Id_Senas) REFERENCES Senas(Id_Senas),
FOREIGN KEY (Id_Simbologia) REFERENCES Simbologia(Id_Simbologia)
);

DROP TABLE IF EXISTS Mensaje ;
CREATE TABLE Mensaje (
Id_Mensaje INT (10) NOT NULL,
Texto VARCHAR (50) NOT NULL
);

DROP TABLE IF EXISTS Integracion;
CREATE TABLE Integracion(
Id_Mensaje INT (10) NOT NULL,
Id_Simbologia INT (10) NOT NULL,
PRIMARY KEY (Id_Mensaje,Id_Simbologia),
FOREIGN KEY (Id_Mensaje) REFERENCES Mensaje(Id_Mensaje),
FOREIGN KEY (Id_Simbologia) REFERENCES Simbologia (Id_Simbologia)
);


DROP TABLE IF EXISTs Usuario ;
CREATE TABLE Usuario(
Id_Usuario INT (10) NOT NULL PRIMARY KEY ,
Nombres VARCHAR (50),
Apellidos VARCHAR (50),
Correo VARCHAR (50),
Passwrd VARCHAR (50),
Tipo ENUM ('S','C','A') #USUARIO SORDO , COMUN , ADMINISTRADOR
);



DROP TABLE IF EXISTS Envio;
CREATE TABLE Envio (
  Id_Mensaje INT (10) NOT NULL,
  Id_Usuario INT (10) NOT NULL,
  Fecha_Envio DATE NOT NULL,
  Hora_Envio TIME NOT NULL,
  PRIMARY KEY (Id_Mensaje, Id_Usuario),
  FOREIGN KEY (Id_Mensaje) REFERENCES Mensaje(Id_Mensaje),
  FOREIGN KEY (Id_Usuario) REFERENCES Usuario (Id_Usuario)
);

DROP TABLE IF EXISTS Contacto;
CREATE TABLE Contacto(
Id_Usuario INT (10) NOT NULL  PRIMARY KEY,
Nickname VARCHAR(50) NOT NULL ,
FOREIGN KEY (Id_Usuario) REFERENCES Usuario(Id_Usuario)
);


DROP TABLE IF EXISTS Imbox;
CREATE TABLE Imbox(
Id_Mensaje INT (10) NOT NULL,
Id_Contacto INT (10) NOT NULL,
PRIMARY KEY (Id_Mensaje, Id_Contacto),
FOREIGN KEY (Id_Mensaje) REFERENCES Mensaje(Id_Mensaje),
FOREIGN KEY (Id_Contacto) REFERENCES Contacto (Id_Contacto)
);