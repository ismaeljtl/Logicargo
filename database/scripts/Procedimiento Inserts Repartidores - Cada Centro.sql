DELIMITER $$
CREATE PROCEDURE `Logicargo`.`InsertRepartidores`()
BEGIN
  DECLARE x INT DEFAULT 1;
  DECLARE Jefe_id INT;

  WHILE x <= 88 DO
	INSERT INTO `Logicargo`.`Persona`
	(`user`,`password`,`nombre`,`segundo_nombre`,`apellido`,`segundo_apellido`,`rol`,`fecha_Nac`,`cedula`,`Ciudad_id`,`remember_token`)
	VALUES
	(concat_ws(x,'rep1-','@gmail.com'), '$2y$10$fOOpHnBtMFeO8dP4i5J.VOvS3t9404dUVPfpHh.LOhCOrx5xqJ6zi', 'Jesus', 'Ismael', 'Teixeira', 'Lecca', 'empleado', '1990-11-11', 11111111, x, 'vYwdWftz2xXDGE8XeNIbchTWHEyjI5eRSfO2Nm9CzJzgRWNCYtsvbD3RV2qM'),
	(concat_ws(x,'rep2-','@gmail.com'), '$2y$10$fOOpHnBtMFeO8dP4i5J.VOvS3t9404dUVPfpHh.LOhCOrx5xqJ6zi', 'Jesus', 'Ismael', 'Teixeira', 'Lecca', 'empleado', '1990-11-11', 11111111, x, 'vYwdWftz2xXDGE8XeNIbchTWHEyjI5eRSfO2Nm9CzJzgRWNCYtsvbD3RV2qM'),
	(concat_ws(x,'rep3-','@gmail.com'), '$2y$10$fOOpHnBtMFeO8dP4i5J.VOvS3t9404dUVPfpHh.LOhCOrx5xqJ6zi', 'Jesus', 'Ismael', 'Teixeira', 'Lecca', 'empleado', '1990-11-11', 11111111, x, 'vYwdWftz2xXDGE8XeNIbchTWHEyjI5eRSfO2Nm9CzJzgRWNCYtsvbD3RV2qM'),
    (concat_ws(x,'rep4-','@gmail.com'), '$2y$10$fOOpHnBtMFeO8dP4i5J.VOvS3t9404dUVPfpHh.LOhCOrx5xqJ6zi', 'Jesus', 'Ismael', 'Teixeira', 'Lecca', 'empleado', '1990-11-11', 11111111, x, 'vYwdWftz2xXDGE8XeNIbchTWHEyjI5eRSfO2Nm9CzJzgRWNCYtsvbD3RV2qM'); 
    
    SET Jefe_id = (select id from `Logicargo`.`Empleado` where Centro_Distribucion_id=x and Tipo_Empleado_id=1);
    
    INSERT INTO `Logicargo`.`Empleado`
	(`fechaInicio`,`Persona_id`,`Centro_Distribucion_id`,`Tipo_Empleado_id`, `Jefe_id`)
	VALUES
	('2011-11-11',(SELECT id FROM `Logicargo`.`Persona` WHERE user=concat_ws(x,'rep1-','@gmail.com')),x,2,Jefe_id),
    ('2011-11-11',(SELECT id FROM `Logicargo`.`Persona` WHERE user=concat_ws(x,'rep2-','@gmail.com')),x,2,Jefe_id),
	('2011-11-11',(SELECT id FROM `Logicargo`.`Persona` WHERE user=concat_ws(x,'rep3-','@gmail.com')),x,2,Jefe_id),
	('2011-11-11',(SELECT id FROM `Logicargo`.`Persona` WHERE user=concat_ws(x,'rep4-','@gmail.com')),x,2,Jefe_id);
        
    SET x = x + 1;
  END WHILE;
 END;
 
 CALL `Logicargo`.`InsertRepartidores`();