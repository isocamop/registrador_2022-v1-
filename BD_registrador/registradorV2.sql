CREATE TABLE historial ( 
id	 		int primary key, 
datos 		double(6,2)  null, 
fecha 		datetime null, 
id_sensor	int(11) null
);

CREATE TABLE usuario
(
	codigo char(5) primary key,
    nombre varchar(20) null,
    apellidos varchar(30) null,
    clave varchar(60) not null
);

insert into usuario values

(1,'jose','pomacosi', 'jp1'),
(2,'angel','calderon','ac2'),
(3,'yerson','tintaya','yt3'),
(4,'moises','vilca luna','mvl4');

update usuario set clave = md5(clave);

select * from usuario;

-- ----------------------------------------
select * from historial
-- ------------------------
select id, datos
from historial
-- -------------------------
select id, datos
from historial
where id_sensor in (1,71);
-- ------------------------
select fecha, datos
from historial
where id_sensor in (1);
-- ------------------------
select id, datos as datos_1, datos as datos_2
from historial
where id_sensor in (1) and id_sensor in (71) 
order by datos_1, datos_2
-- ------------------------

SELECT id, datos as datos_1, datos as datos_2 
FROM historial
WHERE id_sensor LIKE '1' and id_sensor in (71);