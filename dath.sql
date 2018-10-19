create database dath character set = utf8mb4 COLLATE utf8mb4_unicode_ci;
use dath;

#Tabela com os dados dos usuários
create table usuario (
	Id INTEGER not null  primary key AUTO_INCREMENT,
	Nome varchar(50) NOT NULL,
	Email VARCHAR(70) UNIQUE NOT NULL,
	Senha VARCHAR(70) NOT NULL,
    Tel CHAR(13) NOT NULL,
    CPF char(14) UNIQUE NOT NULL,
    Nasc date not null,
    Tipo_S enum('A+','A-','B+','B-','O+','O-','AB+','AB-') not null,
    Sexo enum('Masculino','Feminino') not null
);

#Exacon = Exames e Consultas
create table exacon (
	Id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Tipo ENUM('Exame', 'Consulta') NOT NULL,
    Hospital VARCHAR(50) NOT NULL,
    Medico VARCHAR(30) NOT NULL,
    Horario DATETIME NOT NULL,
	Id_Usuario int,
    constraint fk_UsuarioExacon foreign key (Id_Usuario) references Usuario (Id)
);

#ALTER TABLE exacon AUTO_INCREMENT = 1;