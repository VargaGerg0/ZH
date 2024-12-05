-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Film`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Filmek` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Cim` VARCHAR(45) NULL,
  `ev` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Ertekeles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Ertekeles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Nev` VARCHAR(45) NULL,
  `Pont` VARCHAR(45) NULL,
  `Filmek_id` INT NOT NULL,
  PRIMARY KEY (`id`, `Filmek_id`),
  INDEX `fk_Ertekeles_Filmek_idx` (`Filmek_id` ASC),
  CONSTRAINT `fk_Ertekeles_Film`
    FOREIGN KEY (`Filmek_id`)
    REFERENCES `mydb`.`Filmek` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO Filmek(Cim,Ev) VALUE
('Shrek','2001'),
('Thor','2011'),
('Dűne','2021');
INSERT INTO Ertekeles (Nev,Pont,Filmek_id) VALUE 
('Enikő','4','1'),
('Tamás','2','1'),
('Péter','5','2'),
('Anna','4','2'),
('Zoltán','3','2');
