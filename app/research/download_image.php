<?php
/**
 * Created by PhpStorm.
 * User: Robson
 * Date: 11/10/2022
 *
 * Comentários de arquitetura:
 * Em primeira concepção as imagens ppoderiam sem baixadas uma a uma
 *
 */

require_once '../../users/init.php';

if (!$user->isLoggedIn()) {
    echo "<br><br><label style=\"color:floralwhite; font: bold 16px arial, serif\">Você não está logado no site!</label>";
    exit;
}

require_once "../database_layer.php";

// Recebe o identificador da imagem
//$research_image_id = file_get_contents('php://input');
$research_image_id = 317;
//$myfile = fopen("postfile.txt", "w");
//fwrite($myfile, $post);
//fclose($myfile);

try {
    //#############################
    // insere no banco de dados
    $res = getResearchImage($research_image_id);
} catch (Exception $e) {
    $res = $e->getMessage();
}

//$myfile = fopen("refile.txt", "w");
//$milliseconds = floor(microtime(true) * 1000);
//fwrite($myfile, $milliseconds);
//fclose($myfile);

echo $res->results()[0]->bsl_sample_images_base64;