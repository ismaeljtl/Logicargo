DELIMITER $$
CREATE PROCEDURE `Logicargo`.`InsertVehiculos`()
BEGIN
  DECLARE x INT DEFAULT 1;

  WHILE x <= 88 DO
	INSERT INTO `Logicargo`.`Vehiculo`
	(`marca`,`modelo`,`color`,`placa`,`maxCapPaq`,`minCapPaq`,`anio`,`Centro_Distribucion_id`,`Tipo_Vehiculo_id`,`Estado_Vehiculo_id`)
	VALUES
	('Schwinn','411','grey','',5,0,2016,x,1,1),
	('Schwinn','411','grey','',5,0,2016,x,1,1),
	('Schwinn','411','Gris','',5,0,2016,x,1,1),
	('Schwinn','411','grey','',5,0,2016,x,1,1),
	('Schwinn','411','grey','',5,0,2016,x,1,1),
	('Schwinn','411','grey','',5,0,2016,x,1,1),
	('Schwinn','411','grey','',5,0,2016,x,1,1),
	('Schwinn','411','grey','',5,0,2016,x,1,1),
	('Bera','BR200-RR','blue','15DF78S',30,6,2015,x,2,1),
	('Bera','BR200-RR','blue','15DF78S',30,6,2015,x,2,1),
	('Bera','BR200-RR','blue','15DF78S',30,6,2015,x,2,1),
	('Toyota','Machito','white','14FD23A',2000,31,2015,x,3,1),
	('Toyota','Machito','white','14FD23A',2000,31,2015,x,3,1);
    SET x = x + 1;
  END WHILE;
 END;
 
 CALL `Logicargo`.`InsertVehiculos`();