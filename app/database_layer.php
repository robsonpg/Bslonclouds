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
function insertSampleData($sample_unique_id, $sample_name, $sample_frame_rate, $sample_config, $sample_laser_type, $sample_other_lt,
                               $sample_wavelength, $sample_permission, $sample_amount_of_images, $sample_owner) {

    $db = DB::getInstance();

    $sql = "INSERT INTO bsl_sample_data (
                    bsl_sample_data_name,
                    bsl_sample_data_frame_rate,
                    bsl_sample_data_configuration_type,
                    bsl_sample_data_laser_type,
                    bsl_sample_data_other_laser_type,
                    bsl_sample_data_laser_wavelength,
                    bsl_sample_data_permission,
                    bsl_sample_data_insert_timestamp,
                    bsl_sample_data_amount_of_images,
                    bsl_sample_data_unique_id,
                    bsl_sample_data_owner_id)
            VALUES (
                    '$sample_name',
                    $sample_frame_rate,
                    $sample_config,
                    $sample_laser_type,
                    '$sample_other_lt',
                    $sample_wavelength,
                    $sample_permission,
                    now(),
                    $sample_amount_of_images,
                    '$sample_unique_id',
                    $sample_owner);";

    $res = $db->query($sql);

    // Pega id da amostra inserida
    $sql = "SELECT bsl_sample_data_id FROM bsl_sample_data where bsl_sample_data_unique_id = '$sample_unique_id'";
    $res = $db->query($sql);
    return $res->results()[0]->bsl_sample_data_id;
}

//##############################################################################
// Função para inserir as propriedades da amostra e sua imagem
function insertSampleImage($sample_file_name, $sample_data_id, $sample_image_blob, $sample_image_width,
                               $sample_image_height, $sample_image_timestamp) {

    $image_size = $sample_image_width . 'x' . $sample_image_height;

    //################################################
    // Converte timestamp para mysql
    $sample_image_date = date("Y-m-d H:i:s",$sample_image_timestamp/1000);

    $db = DB::getInstance();

    $sql = "INSERT INTO bsl_sample_images (
                    bsl_sample_images_name,
                    bsl_sample_images_data_id,
                    bsl_sample_images_size,
                    bsl_sample_images_blob,
                    bsl_sample_images_timestamp,
                    bsl_sample_images_insert_timestamp)
            VALUES (
                    '$sample_file_name',
                    $sample_data_id,
                    '$image_size',
                    '$sample_image_blob',
                    '$sample_image_date',
                    now());";



    $res = $db->query($sql);

    //$res2 = $db->update('bsl_sample_data', 14, ['bsl_sample_data_image' => $sample_image]);

    //return $sql;
    return $res->errorString();

}

//##########################################################
// Retorna todos identificadores das pesquisas, usado para
// Validação
function getAllResearchesID(): array
{
    $db = DB::getInstance();
    $sql = "SELECT bsl_sample_data_unique_id FROM bsl_sample_data order by bsl_sample_data_unique_id";
    $res = $db->query($sql);
    return $res->results();
}

//##############################################################################
// Retorna todas as pesquisas do usuário e as publicas
function getUserAndPublicResearches($userid) {
    $db = DB::getInstance();
    $sql = "SELECT * FROM bsl_sample_data where bsl_sample_data_owner_id = $userid or 
                                    bsl_sample_data_permission = " . PERMISSION_PUBLIC . " 
                                    order by bsl_sample_data_unique_id";
    $res = $db->query($sql);
    return $res;
}

//##############################################################################
// Apaga a pesquisa (TOTALMENTE)
function deleteResearch($uid) {
    $db = DB::getInstance();
    // Pega o identificador da pesquisa
    $sql = "SELECT bsl_sample_data_id FROM bsl_sample_data WHERE bsl_sample_data_unique_id = '$uid'";
    $res = $db->query($sql);

    if ($res->count() > 0) {
        $sample_data_id = $res->results()[0]->bsl_sample_data_id;
        // Apaga todasa imagens da pesquisa
        $sql = "DELETE FROM bsl_sample_images WHERE bsl_sample_images_data_id = $sample_data_id";
        $res = $db->query($sql);
        // Apaga os dados da pesquisa
        $sql = "DELETE FROM bsl_sample_data WHERE bsl_sample_data_id = $sample_data_id";
        $res = $db->query($sql);
        return $res;
    } else {
        return "Error while deleting";
    }
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

//##############################################################################
// Tabela de imagens
//    CREATE TABLE `bslonc02_bslonc`.`bsl_sample_images` (
//    `bsl_sample_images_id` INT NOT NULL AUTO_INCREMENT,
//      `bsl_sample_images_data_id` INT NOT NULL,
//      `bsl_sample_images_name` VARCHAR(128) NOT NULL,
//      `bsl_sample_images_size` VARCHAR(45) NOT NULL,
//      `bsl_sample_images_blob` BLOB NOT NULL,
//      `bsl_sample_images_insert_timestamp` DATETIME NOT NULL,
//      PRIMARY KEY (`bsl_sample_images_id`),
//      UNIQUE INDEX `bsl_sample_images_id_UNIQUE` (`bsl_sample_images_id` ASC) VISIBLE);
//    ALTER TABLE `bslonc02_bslonc`.`bsl_sample_images`
//    ADD COLUMN `bsl_sample_images_timestamp` DATETIME NULL AFTER `bsl_sample_images_blob`;
//    ALTER TABLE `bslonc02_bslonc`.`bsl_sample_data`
//    DROP COLUMN `bsl_sample_data_image_insert_date`,
//    DROP COLUMN `bsl_sample_data_image_date`,
//    DROP COLUMN `bsl_sample_data_image_size`,
//    DROP COLUMN `bsl_sample_data_image`;
//    ALTER TABLE `bslonc02_bslonc`.`bsl_sample_data`
//    ADD COLUMN `bsl_sample_data_insert_timestamp` DATETIME NULL AFTER `bsl_sample_data_permission`;
//    ALTER TABLE `bslonc02_bslonc`.`bsl_sample_data`
//    ADD COLUMN `bsl_sample_data_amount_of_images` INT NOT NULL AFTER `bsl_sample_data_insert_timestamp`,
//    CHANGE COLUMN `bsl_sample_data_insert_timestamp` `bsl_sample_data_insert_timestamp` DATETIME NOT NULL ;



?>