select estado.nome as Estado, cidade.nome as Cidade, rua.nome as Rua, endereco.num_predio as Num from endereco 
left join estado on endereco.id_estado = estado.id
left join cidade on endereco.id_cidade = cidade.id
left join rua on endereco.id_rua = rua.id;

select hospital.nome as Hospital, medico.nome as Medico from exacon
left join hospital on exacon.id_hospital = hospital.id
left join medico on exacon.id_medico = medico.id;

select * from exacon;
select ifnull('Consulta','Exame') as Tipo from usuario;

insert into exacon (id_hospital, id_medico, horario, id_usuario) values
(1,1,'1080-11-06 22:00', 1);

select concat(estado.nome, ', ',cidade.nome, ', ', rua.nome, ', ', endereco.num_predio) from endereco 
left join estado on endereco.id_estado = estado.id
left join cidade on endereco.id_cidade = cidade.id
left join rua on endereco.id_rua = rua.id;