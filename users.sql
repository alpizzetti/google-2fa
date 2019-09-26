-- MySQL Script generated by MySQL Workbench
-- Thu Sep 26 10:37:02 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema google2fa
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema google2fa
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `google2fa` DEFAULT CHARACTER SET utf8 ;
USE `google2fa` ;

-- -----------------------------------------------------
-- Table `google2fa`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `google2fa`.`users` (
  `uid` INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(120) NOT NULL,
  `password` VARCHAR(200) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `google_auth_code` VARCHAR(16) NULL,
  PRIMARY KEY (`uid`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;