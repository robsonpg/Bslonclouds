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
// Função para inserir as propriedades da amostra e sua imagem
function insertSampleDataImage($sample_name, $sample_frame_rate, $sample_config, $sample_laser_type, $sample_other_lt,
                               $sample_wavelength, $sample_permission, $sample_image, $sample_image_width,
                               $sample_image_height, $sample_image_timestamp) {

    $image_size = $sample_image_width . 'x' . $sample_image_height;

    //################################################
    // Converte timestamp para mysql
    $sample_image_date = date("Y-m-d H:i:s",$sample_image_timestamp/1000);

    $db = DB::getInstance();

    $sql = "INSERT INTO bsl_sample_data (
                    bsl_sample_data_name,
                    bsl_sample_data_frame_rate,
                    bsl_sample_data_configuration_type,
                    bsl_sample_data_laser_type,
                    bsl_sample_data_other_laser_type,
                    bsl_sample_data_laser_wavelength,
                    bsl_sample_data_image,
                    bsl_sample_data_image_size,
                    bsl_sample_data_image_date,
                    bsl_sample_data_image_insert_date,
                    bsl_sample_data_permission)
            VALUES (
                    '$sample_name',
                    $sample_frame_rate,
                    $sample_config,
                    $sample_laser_type,
                    '$sample_other_lt',
                    $sample_wavelength,
                    '$sample_image',
                    '$image_size',
                    '$sample_image_date',
                    now(),
                    $sample_permission);";

//    $sql = "INSERT INTO bsl_sample_data (
//                    bsl_sample_data_name,
//                    bsl_sample_data_frame_rate,
//                    bsl_sample_data_configuration_type,
//                    bsl_sample_data_laser_type,
//                    bsl_sample_data_other_laser_type,
//                    bsl_sample_data_laser_wavelength,
//                    bsl_sample_data_image,
//                    bsl_sample_data_image_size,
//                    bsl_sample_data_image_date,
//                    bsl_sample_data_image_insert_date,
//                    bsl_sample_data_permission)
//            VALUES (
//                    '$sample_name',
//                    $sample_frame_rate,
//                    $sample_config,
//                    $sample_laser_type,
//                    '$sample_other_lt',
//                    $sample_wavelength,
//                    LOAD_FILE('/app/upload/img/temp.image.bmp'),
//                    '$image_size',
//                    '$sample_image_date',
//                    now(),
//                    $sample_permission);";

    $res = $db->query($sql);

    //$res2 = $db->update('bsl_sample_data', 14, ['bsl_sample_data_image' => $sample_image]);

    //return $sql;
    return $res->errorString();

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
//#############################################################################
// Acrécimo da coluna de tipo alternativo de laser
//ALTER TABLE `bslonc02_bslonc`.`bsl_sample_data`
//ADD COLUMN `bsl_sample_data_other_laser_type` VARCHAR(45) NULL AFTER `bsl_sample_data_laser_type`;
//#############################################################################
// Após avaliação do armazenamento em BLOB e TEXT vamos optar por TEXT pois
// A imagem ficará menor e de fácil manipulação
//ALTER TABLE `bslonc02_bslonc`.`bsl_sample_data`
//CHANGE COLUMN `bsl_sample_data_image` `bsl_sample_data_image` TEXT NOT NULL ;


?>