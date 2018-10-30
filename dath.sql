create database dath character set = utf8mb4 COLLATE utf8mb4_unicode_ci;
use dath;

#Tabela com os dados dos usuários
CREATE TABLE usuario (
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

#Exacon = Exames e Consultas
create table Hospital (
	id int not null auto_increment,
    nome varchar(50) not null,
    cep int not null,
    pais char(2),
    estado char(2) not null,
    cidade varchar(60) not null,
    rua varchar(50) not null,
    num_predio int not null,
    primary key(id)
);

create table Medico(
	id int not null auto_increment,
    nome varchar(50) not null,
    crm int not null,
    primary key(id)
);

create table Exacon (
	id int not null auto_increment,
	id_hospital int not null,
    id_medico int not null,
    Horario DATETIME NOT NULL,
	Id_Usuario int,
    primary key(id),
    constraint fk_UsuarioExacon foreign key(id_Usuario) references Usuario(id),
    constraint fk_HospitalExacon foreign key(id_Hospital) references Hospital(id),
    constraint fk_MedicoExacon foreign key(id_Medico) references Medico(id)
);

create table Exa(
	id int not null auto_increment,
	id_exacon int not null,
    tipo varchar(100) not null,
    primary key(id),
    constraint fk_ExaCon foreign key(id_exacon) references Exacon(id)
);
#ALTER TABLE exacon AUTO_INCREMENT = 1;