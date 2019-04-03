-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema BD_Tienda
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema BD_Tienda
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `BD_Tienda` DEFAULT CHARACTER SET utf8 ;
USE `BD_Tienda` ;

-- -----------------------------------------------------
-- Table `BD_Tienda`.`Cesta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_Tienda`.`Cesta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `costeTotal` DOUBLE NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_Tienda`.`Cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_Tienda`.`Cliente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `passwd` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellidos` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `domicilio` VARCHAR(45) NULL,
  `monedero` DOUBLE NOT NULL DEFAULT 0.00,
  `fechaCreacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaModificacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Cesta_id` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) VISIBLE,
  INDEX `fk_Cliente_Cesta1_idx` (`Cesta_id` ASC) VISIBLE,
  CONSTRAINT `fk_Cliente_Cesta1`
    FOREIGN KEY (`Cesta_id`)
    REFERENCES `BD_Tienda`.`Cesta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_Tienda`.`Tienda`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_Tienda`.`Tienda` (
  `id` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_Tienda`.`Empleado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_Tienda`.`Empleado` (
  `id` VARCHAR(45) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `photoPath` VARCHAR(45) NULL,
  `passwd` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellidos` VARCHAR(45) NOT NULL,
  `activo` TINYINT(1) NOT NULL DEFAULT 1,
  `cargo` ENUM('encargado', 'ventas') NOT NULL,
  `isAdministrador` TINYINT(1) NOT NULL DEFAULT 0,
  `Tienda_id` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) VISIBLE,
  INDEX `fk_Empleado_Tienda1_idx` (`Tienda_id` ASC) VISIBLE,
  CONSTRAINT `fk_Empleado_Tienda1`
    FOREIGN KEY (`Tienda_id`)
    REFERENCES `BD_Tienda`.`Tienda` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_Tienda`.`Categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_Tienda`.`Categoria` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_Tienda`.`Producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_Tienda`.`Producto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `marca` VARCHAR(45) NOT NULL,
  `modelo` VARCHAR(45) NOT NULL,
  `precio` DOUBLE NOT NULL,
  `Categoria_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_Producto_Categoria1_idx` (`Categoria_id` ASC) VISIBLE,
  CONSTRAINT `fk_Producto_Categoria1`
    FOREIGN KEY (`Categoria_id`)
    REFERENCES `BD_Tienda`.`Categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BD_Tienda`.`Unidad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BD_Tienda`.`Unidad` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Producto_id` INT NOT NULL,
  `Cesta_id` INT NOT NULL,
  PRIMARY KEY (`id`, `Producto_id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_Unidad_Producto1_idx` (`Producto_id` ASC) VISIBLE,
  INDEX `fk_Unidad_Cesta1_idx` (`Cesta_id` ASC) VISIBLE,
  CONSTRAINT `fk_Unidad_Producto1`
    FOREIGN KEY (`Producto_id`)
    REFERENCES `BD_Tienda`.`Producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Unidad_Cesta1`
    FOREIGN KEY (`Cesta_id`)
    REFERENCES `BD_Tienda`.`Cesta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
