-- MySQL Script generated by MySQL Workbench
-- vie 19 ago 2016 16:24:32 VET
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema organizer
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema organizer
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `organizer` DEFAULT CHARACTER SET utf8 ;
USE `organizer` ;

-- -----------------------------------------------------
-- Table `organizer`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `organizer`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(128) NOT NULL,
  `password` VARCHAR(128) NOT NULL,
  `email` VARCHAR(128) NOT NULL,
  `ProjectNotification` VARCHAR(45) NULL,
  `NewTaskNotification` VARCHAR(45) NULL,
  `UpdatedTaskNotification` VARCHAR(45) NULL,
  `CommentedTaskNotification` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `organizer`.`projecttype`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `organizer`.`projecttype` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `organizer`.`project`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `organizer`.`project` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(45) NOT NULL,
  `Description` TEXT NULL,
  `Status` INT NOT NULL,
  `Creator` INT NOT NULL,
  `projecTtype_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_project_Creator_idx` (`Creator` ASC),
  INDEX `fk_project_projectType1_idx` (`projecTtype_id` ASC),
  CONSTRAINT `fk_project_user`
    FOREIGN KEY (`Creator`)
    REFERENCES `organizer`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_projectType1`
    FOREIGN KEY (`projecTtype_id`)
    REFERENCES `organizer`.`projecttype` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `organizer`.`module`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `organizer`.`module` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `description` VARCHAR(45) NULL,
  `status` INT NULL,
  `project_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_module_project1_idx` (`project_id` ASC),
  CONSTRAINT `fk_module_project1`
    FOREIGN KEY (`project_id`)
    REFERENCES `organizer`.`project` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `organizer`.`task`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `organizer`.`task` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '								',
  `Name` VARCHAR(45) NULL,
  `Description` VARCHAR(45) NULL,
  `Status` INT NULL,
  `Create_time` VARCHAR(45) NULL,
  `Update_time` VARCHAR(45) NULL,
  `Module_id` INT NOT NULL,
  `Project_id` INT NULL,
  `User_id` INT NOT NULL,
  `Tags` VARCHAR(45) NULL,
  `Assigned` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_task_module1_idx` (`Module_id` ASC),
  INDEX `fk_task_project1_idx` (`Project_id` ASC),
  INDEX `fk_task_user1_idx` (`User_id` ASC),
  CONSTRAINT `fk_task_module1`
    FOREIGN KEY (`Module_id`)
    REFERENCES `organizer`.`module` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_task_project1`
    FOREIGN KEY (`Project_id`)
    REFERENCES `organizer`.`project` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_task_user1`
    FOREIGN KEY (`User_id`)
    REFERENCES `organizer`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `organizer`.`comment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `organizer`.`comment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Content` TEXT NOT NULL,
  `Status` INT NOT NULL COMMENT '			',
  `Create_time` VARCHAR(15) NULL DEFAULT CURRENT_TIMESTAMP,
  `Update_time` VARCHAR(15) NULL DEFAULT CURRENT_TIMESTAMP,
  `Author` INT NOT NULL,
  `Task_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comment_task1_idx` (`Task_id` ASC),
  CONSTRAINT `fk_comment_task1`
    FOREIGN KEY (`Task_id`)
    REFERENCES `organizer`.`task` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `organizer`.`tags`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `organizer`.`tags` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(10) NULL,
  `Frequency` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `organizer`.`track`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `organizer`.`track` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `session` VARCHAR(45) NULL,
  `date` VARCHAR(45) NULL,
  `time` VARCHAR(45) NULL,
  `ip` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
