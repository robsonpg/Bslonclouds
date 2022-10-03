<?php
//########################################################################
// 21/07/2022 - Robson
// Nessa arquivo ficarão as funções relativas a camada de acesso a banco
//
//########################################################################
require_once "constants.php";

//########################################################################
// Função que retorna as especialidades médicas cadastradas no BD
function getMedicalSpecialties() {
    $db = DB::getInstance();
    $sql = "SELECT * FROM cp_medical_specialties order by cp_medical_specialties_name asc";
    $res = $db->query($sql);
    return $res;
}

//##############################################################################
// Tabelas no banco de dados
//##############################################################################
//CREATE TABLE `bslonc02_bslonc`.`bsl_sample_data` (
//`bsl_sample_data_id` INT NOT NULL AUTO_INCREMENT,
//  `bsl_sample_data_name` VARCHAR(128) NOT NULL,
//  `bsl_sample_data_frame_rate` INT NOT NULL,
//  `bsl_sample_data_configuration_type` VARCHAR(45) NOT NULL,
//  `bsl_sample_data_laser_type` VARCHAR(45) NOT NULL,
//  `bsl_sample_data_laser_wavelength` INT NOT NULL,
//  `bsl_sample_data_image` BLOB NOT NULL,
//  `bsl_sample_data_image_size` VARCHAR(45) NOT NULL,
//  `bsl_sample_data_image_date` DATETIME NOT NULL,
//  `bsl_sample_data_image_insert_date` DATETIME NOT NULL,
//  `bsl_sample_data_permission` INT NOT NULL,
//  PRIMARY KEY (`bsl_sample_data_id`),
//  UNIQUE INDEX `bsl_sample_data_id_UNIQUE` (`bsl_sample_data_id` ASC) VISIBLE)
//ENGINE = InnoDB
//DEFAULT CHARACTER SET = utf8mb4;
//#############################################################################
// Acrécimo do campo de permissão da amostra
//ALTER TABLE `bslonc02_bslonc`.`bsl_sample_data`
//ADD COLUMN `bsl_sample_data_permission` INT NOT NULL AFTER `bsl_sample_data_image_insert_date`;


?>