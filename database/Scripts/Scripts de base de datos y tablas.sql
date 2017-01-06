-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Pais`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Pais` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `cod_Area` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Estado` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `Pais_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Estado_Pais1_idx` (`Pais_id` ASC),
  CONSTRAINT `fk_Estado_Pais1`
    FOREIGN KEY (`Pais_id`)
    REFERENCES `mydb`.`Pais` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Ciudad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Ciudad` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `Estado_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Ciudad_Estado1_idx` (`Estado_id` ASC),
  CONSTRAINT `fk_Ciudad_Estado1`
    FOREIGN KEY (`Estado_id`)
    REFERENCES `mydb`.`Estado` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Persona` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `segundo_nombre` VARCHAR(45) NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `segundo_apellido` VARCHAR(45) NULL,
  `fecha_Nac` DATE NOT NULL,
  `cedula` INT NOT NULL,
  `Ciudad_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Persona_Ciudad1_idx` (`Ciudad_id` ASC),
  CONSTRAINT `fk_Persona_Ciudad1`
    FOREIGN KEY (`Ciudad_id`)
    REFERENCES `mydb`.`Ciudad` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Sede`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Sede` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(250) NOT NULL,
  `descripcion` VARCHAR(150) NULL,
  `Ciudad_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Sede_Ciudad1_idx` (`Ciudad_id` ASC),
  CONSTRAINT `fk_Sede_Ciudad1`
    FOREIGN KEY (`Ciudad_id`)
    REFERENCES `mydb`.`Ciudad` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Centro_Distribucion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Centro_Distribucion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(250) NOT NULL,
  `longitud` FLOAT NOT NULL,
  `latitud` FLOAT NOT NULL,
  `descripcion` VARCHAR(150) NULL,
  `Sede_id` INT NOT NULL,
  `Ciudad_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Centro_Distribucion_Sede1_idx` (`Sede_id` ASC),
  INDEX `fk_Centro_Distribucion_Ciudad1_idx` (`Ciudad_id` ASC),
  CONSTRAINT `fk_Centro_Distribucion_Sede1`
    FOREIGN KEY (`Sede_id`)
    REFERENCES `mydb`.`Sede` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Centro_Distribucion_Ciudad1`
    FOREIGN KEY (`Ciudad_id`)
    REFERENCES `mydb`.`Ciudad` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Tipo_Empleado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Tipo_Empleado` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Empleado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Empleado` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `fechaInicio` DATE NOT NULL,
  `fechaFin` DATE NULL,
  `Persona_id` INT NOT NULL,
  `Centro_Distribucion_id` INT NOT NULL,
  `Tipo_Empleado_id` INT NOT NULL,
  `Jefe_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Empleado_Persona1_idx` (`Persona_id` ASC),
  INDEX `fk_Empleado_Centro_Distribucion1_idx` (`Centro_Distribucion_id` ASC),
  INDEX `fk_Empleado_Tipo_Empleado1_idx` (`Tipo_Empleado_id` ASC),
  INDEX `fk_Empleado_Empleado1_idx` (`Jefe_id` ASC),
  CONSTRAINT `fk_Empleado_Persona1`
    FOREIGN KEY (`Persona_id`)
    REFERENCES `mydb`.`Persona` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Empleado_Centro_Distribucion1`
    FOREIGN KEY (`Centro_Distribucion_id`)
    REFERENCES `mydb`.`Centro_Distribucion` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Empleado_Tipo_Empleado1`
    FOREIGN KEY (`Tipo_Empleado_id`)
    REFERENCES `mydb`.`Tipo_Empleado` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Empleado_Empleado1`
    FOREIGN KEY (`Jefe_id`)
    REFERENCES `mydb`.`Empleado` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Cliente` (
  `idCliente` INT NOT NULL AUTO_INCREMENT,
  `user` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `Persona_id` INT NOT NULL,
  PRIMARY KEY (`idCliente`),
  INDEX `fk_Cliente_Persona1_idx` (`Persona_id` ASC),
  CONSTRAINT `fk_Cliente_Persona1`
    FOREIGN KEY (`Persona_id`)
    REFERENCES `mydb`.`Persona` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Tipo_Vehiculo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Tipo_Vehiculo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Vehiculo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Vehiculo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `marca` VARCHAR(45) NOT NULL,
  `modelo` VARCHAR(45) NOT NULL,
  `color` VARCHAR(45) NOT NULL,
  `placa` INT NULL,
  `maxCapPaq` INT NOT NULL,
  `minCapPaq` INT NOT NULL,
  `carga` VARCHAR(45) NOT NULL,
  `anio` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(45) NULL,
  `Centro_Distribucion_id` INT NOT NULL,
  `Tipo_Vehiculo_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Vehiculo_Centro_Distribucion1_idx` (`Centro_Distribucion_id` ASC),
  INDEX `fk_Vehiculo_Tipo_Vehiculo1_idx` (`Tipo_Vehiculo_id` ASC),
  CONSTRAINT `fk_Vehiculo_Centro_Distribucion1`
    FOREIGN KEY (`Centro_Distribucion_id`)
    REFERENCES `mydb`.`Centro_Distribucion` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Vehiculo_Tipo_Vehiculo1`
    FOREIGN KEY (`Tipo_Vehiculo_id`)
    REFERENCES `mydb`.`Tipo_Vehiculo` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Itinerario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Itinerario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `firma_Conf` TINYINT(1) NULL,
  `aviso_Notificacion` TINYINT(1) NULL,
  `Vehiculo_id` INT NULL,
  `Empleado_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Itinerario_Vehiculo1_idx` (`Vehiculo_id` ASC),
  INDEX `fk_Itinerario_Empleado1_idx` (`Empleado_id` ASC),
  CONSTRAINT `fk_Itinerario_Vehiculo1`
    FOREIGN KEY (`Vehiculo_id`)
    REFERENCES `mydb`.`Vehiculo` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Itinerario_Empleado1`
    FOREIGN KEY (`Empleado_id`)
    REFERENCES `mydb`.`Empleado` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Paquete`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Paquete` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `peso` VARCHAR(45) NOT NULL,
  `volumen` VARCHAR(45) NOT NULL,
  `fragilidad` TINYINT(1) NOT NULL,
  `prioridad` TINYINT(1) NOT NULL,
  `Vehiculo_id` INT NULL,
  `Centro_Distribucion_idEmisor` INT NULL,
  `Centro_Distribucion_idReceptor` INT NULL,
  `Persona_idEmisor` INT NULL,
  `Persona_idReceptor` INT NULL,
  `Itinerario_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Envio_Vehiculo1_idx` (`Vehiculo_id` ASC),
  INDEX `fk_Paquete_Centro_Distribucion1_idx` (`Centro_Distribucion_idEmisor` ASC),
  INDEX `fk_Paquete_Centro_Distribucion2_idx` (`Centro_Distribucion_idReceptor` ASC),
  INDEX `fk_Paquete_Persona1_idx` (`Persona_idEmisor` ASC),
  INDEX `fk_Paquete_Persona2_idx` (`Persona_idReceptor` ASC),
  INDEX `fk_Paquete_Itinerario1_idx` (`Itinerario_id` ASC),
  CONSTRAINT `fk_Envio_Vehiculo1`
    FOREIGN KEY (`Vehiculo_id`)
    REFERENCES `mydb`.`Vehiculo` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Paquete_Centro_Distribucion1`
    FOREIGN KEY (`Centro_Distribucion_idEmisor`)
    REFERENCES `mydb`.`Centro_Distribucion` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Paquete_Centro_Distribucion2`
    FOREIGN KEY (`Centro_Distribucion_idReceptor`)
    REFERENCES `mydb`.`Centro_Distribucion` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Paquete_Persona1`
    FOREIGN KEY (`Persona_idEmisor`)
    REFERENCES `mydb`.`Persona` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Paquete_Persona2`
    FOREIGN KEY (`Persona_idReceptor`)
    REFERENCES `mydb`.`Persona` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Paquete_Itinerario1`
    FOREIGN KEY (`Itinerario_id`)
    REFERENCES `mydb`.`Itinerario` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Tipo_telefono`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Tipo_telefono` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Telefono_Centro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Telefono_Centro` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `numero` INT NOT NULL,
  `Centro_Distribucion_id` INT NOT NULL,
  `Tipo_telefono_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Telefono_Centro_Centro_Distribucion1_idx` (`Centro_Distribucion_id` ASC),
  INDEX `fk_Telefono_Centro_Tipo_telefono1_idx` (`Tipo_telefono_id` ASC),
  CONSTRAINT `fk_Telefono_Centro_Centro_Distribucion1`
    FOREIGN KEY (`Centro_Distribucion_id`)
    REFERENCES `mydb`.`Centro_Distribucion` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Telefono_Centro_Tipo_telefono1`
    FOREIGN KEY (`Tipo_telefono_id`)
    REFERENCES `mydb`.`Tipo_telefono` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Telefono_Persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Telefono_Persona` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `numero` INT NOT NULL,
  `Persona_id` INT NOT NULL,
  `Tipo_telefono_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Telefono_Persona_Persona1_idx` (`Persona_id` ASC),
  INDEX `fk_Telefono_Persona_Tipo_telefono1_idx` (`Tipo_telefono_id` ASC),
  CONSTRAINT `fk_Telefono_Persona_Persona1`
    FOREIGN KEY (`Persona_id`)
    REFERENCES `mydb`.`Persona` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Telefono_Persona_Tipo_telefono1`
    FOREIGN KEY (`Tipo_telefono_id`)
    REFERENCES `mydb`.`Tipo_telefono` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Telefono_Sede`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Telefono_Sede` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `numero` INT NOT NULL,
  `Sede_id` INT NOT NULL,
  `Tipo_telefono_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Telefono_Sede_Sede1_idx` (`Sede_id` ASC),
  INDEX `fk_Telefono_Sede_Tipo_telefono1_idx` (`Tipo_telefono_id` ASC),
  CONSTRAINT `fk_Telefono_Sede_Sede1`
    FOREIGN KEY (`Sede_id`)
    REFERENCES `mydb`.`Sede` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Telefono_Sede_Tipo_telefono1`
    FOREIGN KEY (`Tipo_telefono_id`)
    REFERENCES `mydb`.`Tipo_telefono` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Historico_Pauete`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Historico_Pauete` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fechaHora` DATETIME NOT NULL,
  `estatusPaquete` VARCHAR(150) NOT NULL,
  `Paquete_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Historico_Pauete_Paquete1_idx` (`Paquete_id` ASC),
  CONSTRAINT `fk_Historico_Pauete_Paquete1`
    FOREIGN KEY (`Paquete_id`)
    REFERENCES `mydb`.`Paquete` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`Historico_Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Historico_Usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fechaHora` DATETIME NOT NULL,
  `accion` VARCHAR(150) NOT NULL,
  `Persona_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Historico_Usuario_Persona1_idx` (`Persona_id` ASC),
  CONSTRAINT `fk_Historico_Usuario_Persona1`
    FOREIGN KEY (`Persona_id`)
    REFERENCES `mydb`.`Persona` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
