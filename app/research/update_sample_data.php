<?php
/**
 * Created by PhpStorm.
 * User: Robson
 * Date: 11/10/2022
 */

require_once '../../users/init.php';

if (!$user->isLoggedIn()) {
    echo "<br><br><label style=\"color:floralwhite; font: bold 16px arial, serif\">Você não está logado no site!</label>";
    exit;
}

require_once "../database_layer.php";
//let header = "sn=" + sample_name + "&sfr=" + sample_frame_rate + "&sc=" + sample_config + "&slt=" +
//    sample_laser_type + "&olt=" + other_laser_type + "&sw=" + sample_wavelength + "&sp=" + sample_permission;
//$data = $_POST["data"];

$post = file_get_contents('php://input');
//$myfile = fopen("testfile.txt", "w");
//fwrite($myfile, $sample_name);
//fclose($myfile);

$all_data = explode("&", $post);

$sample_uid = $all_data[0];
$sample_name = $all_data[1];
$sample_frame_rate = $all_data[2];
$sample_config = $all_data[3];
$sample_laser_type = $all_data[4];
$sample_other_lt = $all_data[5];
$sample_wavelength = $all_data[6];
$sample_permission = $all_data[7];
$sample_pub = $all_data[8];
// Recuperando imagem em base64
// Exemplo: data:image/png;base64,AAAFBfj42Pj4
$sample_cover_image = $all_data[9];
$sample_obs = $all_data[10];
// Recuperando imagem em base64
// Exemplo: data:image/png;base64,AAAFBfj42Pj4
//#######################################################
// Tratamento para a imagem de capa
list($type, $data) = explode(';', $sample_cover_image);

// Isolando apenas o tipo da imagem
// $tipo: image/png
list(, $type) = explode(':', $type);

// Isolando apenas os dados da imagem
// $dados: AAAFBfj42Pj4
list(, $sample_cover_image_data) = explode(',', $data);


$error = '';
$res = '';
try {
    //#############################
    // insere no banco de dados
    $res = updateSampleData($sample_uid, $sample_name, $sample_frame_rate, $sample_config,
        $sample_laser_type, $sample_other_lt, $sample_wavelength, $sample_permission, $sample_pub,
        $sample_cover_image_data, $sample_obs);

} catch (Exception $e) {
    $error = $e->getMessage();
}

//$myfile = fopen("refile.txt", "w");
//$milliseconds = floor(microtime(true) * 1000);
//fwrite($myfile, $milliseconds);
//fclose($myfile);

echo $res->errorString() . ':' . $error;