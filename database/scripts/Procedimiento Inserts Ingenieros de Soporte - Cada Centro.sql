DELIMITER $$
CREATE PROCEDURE `Logicargo`.`InsertIngSoporte`()
BEGIN
  DECLARE x INT DEFAULT 1;

  WHILE x <= 88 DO
	INSERT INTO `Logicargo`.`Persona`
	(`user`,`password`,`nombre`,`segundo_nombre`,`apellido`,`segundo_apellido`,`rol`,`fecha_Nac`,`cedula`,`Ciudad_id`,`remember_token`)
	VALUES
	(concat_ws(x,'ingSoporte','@gmail.com'), '$2y$10$fOOpHnBtMFeO8dP4i5J.VOvS3t9404dUVPfpHh.LOhCOrx5xqJ6zi', 'Kevin', 'Andres', 'Porras', 'Blanco', 'empleado', '1990-11-11', 11111111, x, 'vYwdWftz2xXDGE8XeNIbchTWHEyjI5eRSfO2Nm9CzJzgRWNCYtsvbD3RV2qM'); 
    
    INSERT INTO `Logicargo`.`Empleado`
	(`fechaInicio`,`Persona_id`,`Centro_Distribucion_id`,`Tipo_Empleado_id`)
	VALUES
	('2011-11-11',(SELECT id FROM `Logicargo`.`Persona` WHERE user=concat_ws(x,'ingSoporte','@gmail.com')),x,4);
    SET x = x + 1;
  END WHILE;
 END;
 
 CALL `Logicargo`.`InsertIngSoporte`();