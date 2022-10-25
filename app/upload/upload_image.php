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

$post = file_get_contents('php://input');
//$myfile = fopen("testfile.txt", "w");
//fwrite($myfile, $sample_name);
//fclose($myfile);

$all_data = explode("&", $post);

$sample_file_name = $all_data[0];
$sample_data_id = $all_data[1];
// Recuperando imagem em base64
// Exemplo: data:image/png;base64,AAAFBfj42Pj4
$sample_image_timestamp = $all_data[2];
$sample_image_width = $all_data[3];
$sample_image_height = $all_data[4];
$sample_image = $all_data[5];

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

    // ###############################################################
    // Gerando nome sequencial para a imagem
    // Usaremos o microtime para garantir milisegundos de precisão
    $milliseconds = floor(microtime(true) * 1000);
    $filename = "img/temp-{$milliseconds}-image.bmp"; //md5(uniqid(time()));

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
        $res = insertSampleImage($sample_file_name, $sample_data_id, $sample_image_width, $sample_image_height,
            $sample_image_timestamp, $data);

        //####################################
        // Apaga arquivo depois de inserido
        if (!unlink($filename)) {
            // there was a problem deleting the file
        }
    } else {
        $res = lang("FILE_ERROR");
    }
} else {
    $res = lang("IMAGE_FORMAT_ERROR");
}
//$myfile = fopen("refile.txt", "w");
//$milliseconds = floor(microtime(true) * 1000);
//fwrite($myfile, $milliseconds);
//fclose($myfile);

echo $res;