<?php
/**
 * Created by PhpStorm.
 * User: Robson
 * Date: 11/10/2022
 */

require_once '../../users/init.php';
require_once $abs_us_root . $us_url_root . 'users/includes/template/prep.php';

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

$sample_name = $all_data[0];
$sample_frame_rate = $all_data[1];
$sample_config = $all_data[2];
$sample_laser_type = $all_data[3];
$sample_other_lt = $all_data[4];
$sample_wavelength = $all_data[5];
$sample_permission = $all_data[6];
// Recuperando imagem em base64
// Exemplo: data:image/png;base64,AAAFBfj42Pj4
$sample_image_timestamp = $all_data[7];
$sample_image_width = $all_data[8];
$sample_image_height = $all_data[9];
$sample_image = $all_data[10];

//###########################################################################
// Nesse ponto vamos criar o identificador da pesquisa
// Precisamos validar se a pesquisa não é repetida ou uma inserção repetida
// Para isso vamos usar o nome da amostra como sendo identificador único


// Separando tipo dos dados da imagem
// $tipo: data:image/png
// $dados: base64,AAAFBfj42Pj4
list($type, $data) = explode(';', $sample_image);

// Isolando apenas o tipo da imagem
// $tipo: image/png
list(, $type) = explode(':', $type);

// Isolando apenas os dados da imagem
// $dados: AAAFBfj42Pj4
list(, $data) = explode(',', $data);

if (strpos($type, "bmp") == true) {
    // A imagem é transmitida em base64, vamos abte -la
    // Convertendo base64 para imagem
    $sample_image_data = base64_decode($data);

    //$myfile = fopen("imagefile.txt", "w");
    //fwrite($myfile, $sample_image);
    //fclose($myfile);

    // Gerando nome aleatório para a imagem
    $filename = "img/temp.image.bmp"; //md5(uniqid(time()));
    //$sample_image_data = addslashs($data);

    // Salvando imagem em disco
    file_put_contents($filename, $sample_image_data);

    //$image_name = "image_" . time() . ".jpg";
    $filesize = filesize($filename);
    $fp = fopen($filename, "r");
    // If successful, read from the file pointer using the size of the file (in bytes) as the length.
    if ($fp) {
        $content = fread($fp, $filesize);
        fclose($fp);
        // Add slashes to the content so that it will escape special characters.
        // As pointed out, mysql_real_escape_string can be used here as well. Your choice.
        $imgData = addslashes($content);

        //#############################
        // insere no banco de dados
//        $res = insertSampleDataImage($sample_name, $sample_frame_rate, $sample_config, $sample_laser_type, $sample_other_lt,
//            $sample_wavelength, $sample_permission, $imgData, $sample_image_width,
//            $sample_image_height, $sample_image_timestamp);
    } else {
        $res = lang("FILE_ERROR");
    }
} else {
    $res = lang("IMAGE_FORMAT_ERROR");
}
//$myfile = fopen("refile.txt", "w");
//fwrite($myfile, $res);
//fclose($myfile);

echo $res;