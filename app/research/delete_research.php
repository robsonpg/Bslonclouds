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

$research_id = file_get_contents('php://input');
//$myfile = fopen("postfile.txt", "w");
//fwrite($myfile, $post);
//fclose($myfile);

try {
    //#############################
    // insere no banco de dados
    $res = deleteResearch($research_id);
} catch (Exception $e) {
    $res = $e->getMessage();
}

//$myfile = fopen("refile.txt", "w");
//$milliseconds = floor(microtime(true) * 1000);
//fwrite($myfile, $milliseconds);
//fclose($myfile);

echo $res->errorString();