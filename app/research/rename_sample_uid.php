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
$sample_new_name = $all_data[1];

$error = '';
$res = '';
try {
    //#############################
    // insere no banco de dados
    $res = renameSample($sample_uid, $sample_new_name);

} catch (Exception $e) {
    $error = $e->getMessage();
}

//$myfile = fopen("refile.txt", "w");
//$milliseconds = floor(microtime(true) * 1000);
//fwrite($myfile, $milliseconds);
//fclose($myfile);

echo $res->errorString() . ':' . $error;