-- -----------------------------------------------------
-- Table `document_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `document_type` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(45) NULL COMMENT '',
  `status` VARCHAR(1) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `person`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `person` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `document_type_id` INT NOT NULL COMMENT '',
  `document` VARCHAR(15) NULL COMMENT '',
  `name` VARCHAR(45) NULL COMMENT '',
  `last_name` VARCHAR(45) NULL COMMENT '',
  `phone` VARCHAR(20) NULL COMMENT '',
  `picture_url` VARCHAR(500) NULL COMMENT '',
  `status` VARCHAR(1) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_person_document_type_idx` (`document_type_id` ASC)  COMMENT '',
  CONSTRAINT `fk_person_document_type`
    FOREIGN KEY (`document_type_id`)
    REFERENCES `document_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


insert into document_type (name, status) values ('DNI', 'A');
insert into document_type (name, status) values ('PASAPORTE', 'A');
insert into document_type (name, status) values ('CARNET EXTRANJERO', 'A');