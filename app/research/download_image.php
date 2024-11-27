<?php
/**
 * Created by PhpStorm.
 * User: Robson
 * Date: 11/10/2022
 *
 * Comentários de arquitetura:
 * Em primeira concepção as imagens ppoderiam sem baixadas uma a uma
 * Na segunda concepção, vamos aglomerar todas imagens da pesquisa, compactar e salvar
 */

require_once '../../users/init.php';

if (!$user->isLoggedIn()) {
    echo "<br><br><label style=\"color:floralwhite; font: bold 16px arial, serif\">Você não está logado no site!</label>";
    exit;
}

require_once "../database_layer.php";

// Recebe o identificador da imagem
//$research_image_id = file_get_contents('php://input');
$research_uid = file_get_contents('php://input');
//$myfile = fopen("postfile.txt", "w");
//fwrite($myfile, $post);
//fclose($myfile);

try {
    // Apaga o arquivo de pesquisa
    $scan_dir = scandir("./");
    foreach ($scan_dir as $file) {
        if (!is_dir("./$file")) {
            if (strpos($file, ".zip")) {
                unlink($file);
            }
        }
    }

    // Buscar dados da pesquisa no banco de dados
    $research_data = getResearchData($research_uid);
    $res_data = $research_data->results()[0];

    // Verifica se achou a pesquisa
    if (!($research_data->count() > 0)){
        echo "Error: Fail find research";
        exit;
    }

    $research_id = $research_data->results()[0]->bsl_sample_data_id;
    //###########################################
    // Buscamos os IDs das imagens para converter
    // uma a uma para não sobrecarregar o serviidor
    $res = getResearchImagesIDs($research_id);

    if ($res->count() > 0) {
        // Faz o loop de imagens
        $IDs = $res->results();
        foreach ($IDs as $ID) {
            // Busca a imagem para savar em arquivo
            $res_image = getResearchImage($ID->bsl_sample_images_id);
            // Converte o base64 em binário
            if ($res_image->count() > 0) {
                // Pega o base64
                $imageb64 = $res_image->results()[0]->bsl_sample_images_base64;
                $image_file = fopen("images/" . $res_image->results()[0]->bsl_sample_images_name, 'wb' );
                fwrite($image_file, base64_decode($imageb64));
                fclose($image_file);
            }
        }
        // Faz a compactação da pesquisa
        // Se o arquivo existir
        if (file_exists($research_uid . ".zip")) {
            // Apaga o arquivo
            unlink($research_uid . ".zip");
        }
        // Cria o nov arquivo
        $zip = new ZipArchive();
        $filename = "./" . $research_uid . ".zip";

        if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
            exit("cannot open <$filename>\n");
        }

        $uid = $res_data->bsl_sample_data_unique_id;
        $sn = $res_data->bsl_sample_data_name;
        $sfr = $res_data->bsl_sample_data_frame_rate;
        $sc = $res_data->bsl_sample_data_configuration_type;
        $slto = $res_data->bsl_sample_data_other_laser_type;
        if ($sc == CONFIG_BACKSCATTERING) {
            $sc_text = lang("BACKSCATTERING");
        } else {
            $sc_text = lang("FWD_SCATTERING");
        }
        $slt = $res_data->bsl_sample_data_laser_type;
        if ($slt == HENE_LASER_TYPE) {
            $slt_text = lang("HENE");
        } else {
            if ($slt == DIODE_LASER_TYPE) {
                $slt_text = lang("DIODE");
            } else {
                $slt_text = lang("OTHER") . " : " . $slto ;
            }
        }

        $sw = $res_data->bsl_sample_data_laser_wavelength;
        $sp = $res_data->bsl_sample_data_permission;
        $sai = $res_data->bsl_sample_data_amount_of_images;
        $so = $res_data->bsl_sample_data_owner_id;
        if ($sp == PERMISSION_PUBLIC) {
            $sp_text = lang("PERMISSION_PUBLIC");
        } else {
            $sp_text = lang("PERMISSION_PRIVATE_OWNER");
        }
        $spub = $res_data->bsl_sample_data_published_DOI_URL;

        $str_info_research = lang("SAMPLE_IDENTIFICATION") . ": " . $uid . "\n" .
            lang("ILLUMINATED_SAMPLE") . ": " . $sn . "\n" .
            lang("TIME_RATE") . ": ". $sfr . "\n" .
            lang("SAMPLE_CONFIG") . ": " . $sc_text . "\n" .
            lang("LASER_TYPE"). ": " . $slt_text . "\n" .
            lang("LASER_WAVELENGTH") . ": " . $sw . "\n" .
            lang("IMAGES_PERMISSION") . ": " . $sp_text . "\n" .
            lang("NUMBER_OF_IMAGES") . ": " . $sai . "\n" .
            lang("RESEARCH_PUBLIC_ID") . ": " . $spub . "\n" .
            lang("CCBY");

            $zip->addFromString("research_info.txt", $str_info_research);
//        $zip->addFromString("testfilephp2.txt" . time(), "#2 This is a test string added as testfilephp2.txt.\n");
        // Adiciona as imagens no arquivo
        foreach ($IDs as $ID) {
            $zip->addFile("images/" . $ID->bsl_sample_images_name);
        }
//        echo "numfiles: " . $zip->numFiles . "\n";
//        echo "status:" . $zip->status . "\n";
        $res = $zip->status;
        $zip->close();
        // Apaga os arquivos das imagens
        foreach ($IDs as $ID) {
            if (file_exists("images/" . $ID->bsl_sample_images_name)) {
                unlink("images/" . $ID->bsl_sample_images_name);
            }
        }
    }
} catch (Exception $e) {
    $res = $e->getMessage();
}

//$myfile = fopen("refile.txt", "w");
//$milliseconds = floor(microtime(true) * 1000);
//fwrite($myfile, $milliseconds);
//fclose($myfile);

echo $zip->status;
//###############################################################
// Registra o download da pesquisa
registerDownload($research_id, $user->data()->id);

// #################################################################
// O código javascript abaixo é para download individual das imagens
// let b64Data = response.toString();
// const byteCharacters = atob(b64Data);
// const byteNumbers = new Array(byteCharacters.length);
// for (let i = 0; i < byteCharacters.length; i++) {
//     byteNumbers[i] = byteCharacters.charCodeAt(i);
// }
// const byteArray = new Uint8Array(byteNumbers);
// const blob = new Blob([byteArray], {type: "image/bmp"});
// alert("save");
// //let blob = new Blob([atob(response.toString())], {type: "image/bmp"});
// saveAs(blob, "text.bmp");
