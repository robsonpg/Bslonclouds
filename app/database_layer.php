<?php
//########################################################################
// 21/07/2022 - Robson
// Nessa arquivo ficarão as funções relativas a camada de acesso a banco
//
//########################################################################
require_once "constants.php";

//##############################################################################
// Função para inserir as propriedades da amostra e sua imagem
function insertSampleData($sample_unique_id, $sample_name, $sample_frame_rate, $sample_config, $sample_laser_type,
                          $sample_other_lt, $sample_wavelength, $sample_permission, $sample_amount_of_images,
                          $sample_owner, $sample_pub, $sample_cover_image_data, $sample_obs) {

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
                    bsl_sample_data_owner_id,
                    bsl_sample_data_published_DOI_URL,
                    bsl_sample_data_cover_image,
                    bsl_sample_data_status,
                    bsl_sample_data_obs)
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
                    $sample_owner,
                    '$sample_pub',
                    '$sample_cover_image_data',
                    " . RESEARCH_STATUS_WAINTING_REVISION . ",
                    '$sample_obs');";

    $res = $db->query($sql);

    // Pega id da amostra inserida
    $sql = "SELECT bsl_sample_data_id FROM bsl_sample_data where bsl_sample_data_unique_id = '$sample_unique_id'";
    $res = $db->query($sql);
    return $res->results()[0]->bsl_sample_data_id;
}

//##############################################################################
// Função para inserir as propriedades da amostra e sua imagem
function insertSampleImage($sample_file_name, $sample_data_id, $sample_image_width,
                               $sample_image_height, $sample_image_timestamp, $base64) {

    $image_size = $sample_image_width . 'x' . $sample_image_height;

    //################################################
    // Converte timestamp para mysql
    $sample_image_date = date("Y-m-d H:i:s",$sample_image_timestamp/1000);

    $db = DB::getInstance();

    $sql = "INSERT INTO bsl_sample_images (
                    bsl_sample_images_name,
                    bsl_sample_images_data_id,
                    bsl_sample_images_size,
                    bsl_sample_images_timestamp,
                    bsl_sample_images_insert_timestamp,
                    bsl_sample_images_base64)
            VALUES (
                    '$sample_file_name',
                    $sample_data_id,
                    '$image_size',
                    '$sample_image_date',
                    now(),
                    '$base64');";



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
    $sql = "SELECT * FROM bsl_sample_data where (bsl_sample_data_owner_id = $userid or 
                                    bsl_sample_data_permission = " . PERMISSION_PUBLIC . ") and
                                    bsl_sample_data_status = " . RESEARCH_STATUS_ACCEPTED ." 
                                    order by bsl_sample_data_unique_id";
    $res = $db->query($sql);
    return $res;
}

//##############################################################################
// Retorna todas as pesquisas para que o moderador possa ver
function getAllResearches(): ?DB
{
    $db = DB::getInstance();
    $sql = "SELECT * FROM bsl_sample_data order by bsl_sample_data_unique_id";
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

//############################################################################
// Retorna uma imagem armazenada
function getResearchImage($imageID) {
    $db = DB::getInstance();
    $sql = "SELECT * FROM bsl_sample_images where bsl_sample_images_id = $imageID limit 1";
    $res = $db->query($sql);
    return $res;
}

//############################################################################
// Retorna todas imagens de uma pesquisa
function getResearchImagesIDs($research_ID) {
    $db = DB::getInstance();
    $sql = "SELECT bsl_sample_images_id, bsl_sample_images_name FROM bsl_sample_images where 
        bsl_sample_images_data_id = $research_ID order by bsl_sample_images_name";
    $res = $db->query($sql);
    return $res;
}

//############################################################################
// Retorna os dados de uma pesquisa
function getResearchData($research_uID) {
    $db = DB::getInstance();
    $sql = "SELECT * FROM bsl_sample_data where 
        bsl_sample_data_unique_id = '$research_uID' limit 1";
    $res = $db->query($sql);
    return $res;
}

//#############################################################################
// Faz update nas propriedades da pesquisa
function updateSampleData($sample_uid, $sample_name, $sample_frame_rate, $sample_config,
                          $sample_laser_type, $sample_other_lt, $sample_wavelength, $sample_permission,
                          $sample_pub, $sample_cover_image_data, $sample_obs) {
    $db = DB::getInstance();
    $sql = "UPDATE bsl_sample_data
                SET
                    bsl_sample_data_name = '$sample_name',
                    bsl_sample_data_frame_rate = $sample_frame_rate,
                    bsl_sample_data_configuration_type = $sample_config,
                    bsl_sample_data_laser_type = $sample_laser_type,
                    bsl_sample_data_other_laser_type = '$sample_other_lt',
                    bsl_sample_data_laser_wavelength = $sample_wavelength,
                    bsl_sample_data_permission = $sample_permission,
                    bsl_sample_data_insert_timestamp = now(),
                    bsl_sample_data_published_DOI_URL = '$sample_pub',
                    bsl_sample_data_cover_image = '$sample_cover_image_data',
                    bsl_sample_data_obs = '$sample_obs'
            WHERE bsl_sample_data_unique_id = '$sample_uid'";
    $res = $db->query($sql);
    return $res;
}

//############################################################################
// Renomeia a pesquisa
function renameSample($sample_uid, $sample_new_name) {
    $db = DB::getInstance();
    $sql = "UPDATE bsl_sample_data
                SET
                    bsl_sample_data_unique_id = '$sample_new_name'
            WHERE bsl_sample_data_unique_id = '$sample_uid'";
    $res = $db->query($sql);
    return $res;
}

//############################################################################
// Retorna os dados de uma pesquisa
function getResearchOwnerData($owner_ID) {
    $db = DB::getInstance();
    $sql = "SELECT * FROM users where id = '$owner_ID' limit 1";
    $res = $db->query($sql);
    if ($res->count() > 0) {
        $res = $res->results()[0];
    } else {
        $res = null;
    }
    return $res;
}

//##############################################################################
// Aceita a pesquisa enviado por um pesquisador
function acceptResearch($sample_uid): ?DB
{
    $db = DB::getInstance();
    $sql = "UPDATE bsl_sample_data
                SET
                    bsl_sample_data_status = " . RESEARCH_STATUS_ACCEPTED . "
            WHERE bsl_sample_data_unique_id = '$sample_uid'";
    $res = $db->query($sql);
    return $res;
}

//############################################################################
// Retorna os dados de uma pesquisa
function getModeratorsUsers(): ?array
{
    $db = DB::getInstance();
    $sql = "SELECT * FROM users where id in 
                          (SELECT 
                              user_id 
                          FROM 
                              user_permission_matches 
                          where permission_id = " . ATTR_MODERATOR . ")";
    $res = $db->query($sql);
    if ($res->count() > 0) {
        $res = $res->results();
    } else {
        $res = null;
    }
    return $res;
}

//############################################################################
// Retorna o número de pesquisas públicas
function getNumberPublicResearch() {
    $db = DB::getInstance();
    $sql = "SELECT count(*) as number FROM bsl_sample_data where bsl_sample_data_permission = " . PERMISSION_PUBLIC;
    $res = $db->query($sql);
    if ($res->count() > 0) {
        $res = $res->results()[0]->number;
    } else {
        $res = null;
    }
    return $res;
}

function getNumberOfResearches() {
    $db = DB::getInstance();
    $sql = "SELECT count(*) as number FROM users where id in (SELECT 
                              user_id 
                          FROM 
                              user_permission_matches 
                          where permission_id != " . ATTR_ADMIN . ")";
    $res = $db->query($sql);
    if ($res->count() > 0) {
        $res = $res->results()[0]->number;
    } else {
        $res = null;
    }
    return $res;

}

//##############################################################################
// Retorna todas as pesquisas publicas
function getPublicResearches(): ?DB
{
    $db = DB::getInstance();
    $sql = "SELECT * FROM bsl_sample_data sd, users u where 
                                    sd.bsl_sample_data_permission = " . PERMISSION_PUBLIC . " and
                                    sd.bsl_sample_data_status = " . RESEARCH_STATUS_ACCEPTED ." and
                                    u.id = sd.bsl_sample_data_owner_id 
                                    order by RAND() asc limit 5";
    $res = $db->query($sql);
    return $res;
}

function getImagesAndNamesPublicResearches(): ?DB
{
    $db = DB::getInstance();
    $sql = "SELECT bsl_sample_data_name, bsl_sample_data_cover_image FROM bsl_sample_data sd, users u where 
                                    sd.bsl_sample_data_permission = " . PERMISSION_PUBLIC . " and
                                    sd.bsl_sample_data_status = " . RESEARCH_STATUS_ACCEPTED ." and
                                    u.id = sd.bsl_sample_data_owner_id 
                                    order by RAND() asc limit 5";
    $res = $db->query($sql);
    return $res;
}

//##############################################################################
// Retorna todas as pesquisas publicas
function getNumberofPublicImages() {
    $db = DB::getInstance();
    $sql = "SELECT count(*) as number FROM bsl_sample_images where bsl_sample_images_data_id in (SELECT 
                              bsl_sample_data_id 
                          FROM 
                              bsl_sample_data 
                          where bsl_sample_data_permission = " . PERMISSION_PUBLIC . ")";
    $res = $db->query($sql);
    if ($res->count() > 0) {
        $res = $res->results()[0]->number;
    } else {
        $res = null;
    }
    return $res;

}

//##############################################################################
// Insere dados do visitante do site para estatísticas da landpage
function insertDatabaseVisitorInfo($visitorinfo) {

    if (!is_null($visitorinfo->geoplugin_city)) {
        $db = DB::getInstance();

        // Verifica se é de um pais e cidade existente no banco de dados
        $sql = "SELECT * FROM bsl_visitors_data where bsl_visitors_data_city = " . $visitorinfo->geoplugin_city . " and 
        bsl_visitors_data_country = " . $visitorinfo->geoplugin_countryName;
        $res = $db->query($sql);

        // Se sim, incrementa contador
        if ($res->count() > 0) {
            // Existe uma visita da cidade
            $sql = "UPDATE bsl_visitors_data SET bsl_visitors_data_city_count = bsl_visitors_data_city_count + 1, 
                             bsl_visitors_data_country_count = bsl_visitors_data_country_count + 1,
                             bsl_visitors_data_timestamp = now();";
            $res = $db->query($sql);
        } else {
            // Não existe visita, acrescenta no banco de dados
            $sql = "INSERT INTO bslonc02_bslonc.bsl_visitors_data
                    (bsl_visitors_data_country,
                    bsl_visitors_data_country_count,
                    bsl_visitors_data_city,
                    bsl_visitors_data_city_count,
                    bsl_visitors_data_continent,
                    bsl_visitors_data_continent_count,
                    bsl_visitors_data_timestamp,
                    bsl_visitors_data_latitude,
                    bsl_visitors_data_longitude)
                    VALUES
                    ('" . $visitorinfo->geoplugin_countryName . "',1," .
                "'" . $visitorinfo->geoplugin_city . "',1," .
                "'" . $visitorinfo->geoplugin_continentName . "',1 , now()," .
                $visitorinfo->geoplugin_latitude . "," .
                $visitorinfo->geoplugin_longitude .
                ")";
            $res = $db->query($sql);
        }
        return true;
    } else {
        return false;
    }
}

//#############################################################################################
// Retorna dados de todas visitas
function getAllDatabaseVisitorInfo(): ?DB
{
    $db = DB::getInstance();
    $sql = "SELECT * FROM bsl_visitors_data";
    $res = $db->query($sql);
    return $res;
}

function getCountryTotals(): ?DB
{
    $db = DB::getInstance();
    $sql = "SELECT *, sum(bsl_visitors_data_country_count) as count FROM bsl_visitors_data 
        group by bsl_visitors_data_country 
        order by count desc limit 5";
    $res = $db->query($sql);
    return $res;
}

function getTotalVisitors() {
    $db = DB::getInstance();
    $sql = "SELECT count(*) as count FROM logs WHERE logtype = 'VisitorInfo' limit 1;";
    $res = $db->query($sql);
    return $res->results()[0]->count;
}

function registerDownload($research_id, $user_id)
{
    $db = DB::getInstance();
    $sql = "INSERT INTO bsl_downloads
            (bsl_downloads_user_id,
            bsl_downloads_research_id,
            bsl_downloads_timestamp)
            VALUES
            ($user_id,$research_id,now());";
    echo $sql;
    $res = $db->query($sql);
    return $res;
}

function getDownloads()
{
    $db = DB::getInstance();
    // Número de Downloads e Identidade dos Autores
    $downloadsQuery = "SELECT COUNT(*) as total_downloads, users.username 
                   FROM bsl_downloads 
                   JOIN users ON bsl_downloads.bsl_downloads_user_id = users.id 
                   GROUP BY users.username";
    $downloadsResult = $db->query($downloadsQuery);
   return $downloadsResult->results();
}

function getUsers() {
    $db = DB::getInstance();
    // Lista de Usuários
    $usersQuery = "SELECT * FROM users";
    $query = $db->query($usersQuery);

    return $query->results();
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
// 
// SQL para criar a tabela de downloads
// CREATE TABLE `bslonc02_bslonc`.`bsl_downloads` (
// `bsl_downloads_id` INT NOT NULL AUTO_INCREMENT,
//   `bsl_downloads_user_id` INT NOT NULL,
//   `bsl_downloads_research_id` INT NOT NULL,
//   `bsl_downloads_timestamp` DATETIME NOT NULL,
//   PRIMARY KEY (`bsl_downloads_id`),
//   UNIQUE INDEX `bsl_downloads_id_UNIQUE` (`bsl_downloads_id` ASC) VISIBLE);



?>