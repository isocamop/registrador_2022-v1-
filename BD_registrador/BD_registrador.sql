CREATE DATABASE registrador;
USE registrador;


CREATE TABLE historial ( 
id	 		int primary key, 
datos 		double(6,2)  null, 
fecha 		datetime null, 
id_sensor	int(11) null
);


select * from historial