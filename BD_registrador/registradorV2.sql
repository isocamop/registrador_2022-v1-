
CREATE TABLE sensor ( 
id_sensor	 int primary key, 
tipo 		char(20)  null, 
codigo		char(20) null,
Descripcion_tp text NULL
);


CREATE TABLE historial ( 
id	 		int primary key, 
datos 		double(6,2)  null, 
fecha 		datetime null, 
id_sensor	int(11) null,
FOREIGN KEY (id_sensor) REFERENCES sensor(id_sensor)
);


CREATE TABLE historialc ( 
id	 		int primary key, 
temp 		double(6,2)  null, 
hume    	double(6,2)  null, 
radi 		double(6,2)  null, 
cali 		double(6,2)  null, 
fecha 		datetime null
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
select * from historialc
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

-- -----------fitro para tempertura------------
select id, temp
from historialc
where id and temp

-- -----------fitro para humedad---------------
select id, hume
from historialc
where id and hume
-- -----------fitro para radiacion-------------
select id, radi
from historialc
where id and radi
-- -----------fitro para calidad---------------
select id, cali
from historialc
where id and cali
-- -----------fitro para humedad y temperatura-
select id, temp, hume
from historialc
where id and temp and hume
-- -----------fitro para humedad y temperatura-
select id, hume, radi
from historialc
where id and hume and radi
-- ---------todas los datos-------------------
select id, temp, hume, radi, cali 
from historialc
