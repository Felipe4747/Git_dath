create database dath character set = utf8mb4 COLLATE utf8mb4_unicode_ci;
use dath;

#Usuario/Médico/Hospital
CREATE TABLE Usuario (
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(70) UNIQUE NOT NULL,
    senha VARCHAR(70) NOT NULL,
    tel CHAR(13) NOT NULL,
    CPF CHAR(14) UNIQUE NOT NULL,
    nasc DATE NOT NULL,
    tipo_s ENUM('A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-') NOT NULL,
    sexo ENUM('Masculino', 'Feminino') NOT NULL
);

create table Medico(
	id int not null auto_increment,
    nome varchar(50) not null,
    crm int not null,
    primary key(id)
);


create table Pais(
	id int not null,
    id_estado int not null,
    nome char(2),
    primary key(id)
);

create table Estado(
	id int not null,
    nome char(2),
    primary key(id)
);

create table Cidade(
	id int not null auto_increment,
    nome varchar(60),
    primary key(id)
);

create table Rua(
	id int not null auto_increment,
    nome varchar(60) not null,
    primary key(id)
);

create table Endereco(
	id int not null auto_increment,
	id_pais int not null,
    id_Estado int not null,
    id_cidade int not null,
    id_rua int not null,
    num_predio int not null,
    cep int not null,
    primary key(id),
    constraint fk_PaisEndereco foreign key(id_pais) references Pais(id),
    constraint fk_EstadoEndereco foreign key(id_estado) references Estado(id),
    constraint fk_CidadeEndereco foreign key(id_cidade) references Cidade(id),
    constraint fk_RuaEndereco foreign key(id_rua) references Rua(id)
);

create table Hospital (
	id int not null auto_increment,
    nome varchar(50) not null,
    id_endereco int not null,
    primary key(id),
    constraint fk_EnderecoHospital foreign key(id_endereco) references Endereco(id)
);

#Exa/Con
create table Exacon (
	id int not null auto_increment,
	id_hospital int not null,
    id_medico int not null,
    horario DATETIME NOT NULL,
	id_usuario int,
    primary key(id),
    constraint fk_UsuarioExacon foreign key(id_usuario) references Usuario(id),
    constraint fk_HospitalExacon foreign key(id_hospital) references Hospital(id),
    constraint fk_MedicoExacon foreign key(id_medico) references Medico(id)
);

create table Exa(
	id int not null auto_increment,
	id_exacon int not null,
    tipo varchar(100) not null,
    primary key(id),
    constraint fk_ExaCon foreign key(id_exacon) references Exacon(id)
);