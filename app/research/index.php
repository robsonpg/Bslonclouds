<?php

/**
 * Created by PhpStorm.
 * User: Robson
 * Date: 15/02/2018
 * Time: 19:52
 */

require_once '../../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

if (!$user->isLoggedIn()) {
    header('Location: /index.php');
    exit;
}

$user_id = $user->data()->id;
require_once "delete_modal.php";
require_once "processing_images_modal.php";
require_once "../upload/properties_modal.php";
require_once "../database_layer.php";

//#############################################################
// Carrega todas as pesquisas
$user_public_researches = getUserAndPublicResearches($user_id);
?>

<link rel="stylesheet" type="text/css" href="../css/styles.css">
<script type="text/javascript">
    let public_researchers = <?php
    if ($user_public_researches->count() > 0) {
        echo json_encode($user_public_researches->results());
    } else {
        echo json_encode("none");
    } ?>;
    let user_id = <?php echo $user_id; ?>;
    let msg_exist = "<?=lang("EXIST_UNIQUE_ID"); ?>";
    let msg_min = "<?=lang("MIN_UNIQUE_ID_CHARS"); ?>";
    let msg_ok = "<?=lang("UNIQUE_ID_OK"); ?>";
    let msg_cannot_change = "<?=lang("CANNOT_CHANGE_ID"); ?>";
    let msg_deleting = "<?=lang("DELETING_MSG"); ?>";
</script>

<br><br>
<div class="container">
    <h2><?=lang("MENU_RESEARCH_CATALOG");?></h2>
    <div class="row">
        <div class="col align-self-center">
            <div role="alert" class="mt-1 alert alert-primary">
                <span class="font-weight-bold">Research Description</span>
            </div>
        </div>
        <div class="col-5 align-self-center">
            <div role="alert" class="mt-1 alert alert-primary">
                <span class="font-weight-bold">Actions</span>
            </div>
        </div>
    </div>
    <?php
        if ($user_public_researches->count() > 0) {
            foreach ($user_public_researches->results() as $research_item) {
                // Exibe cada pesquisa armazenada
                $uid = $research_item->bsl_sample_data_unique_id;
                $sn = $research_item->bsl_sample_data_name;
                $sfr = $research_item->bsl_sample_data_frame_rate;
                $sc = $research_item->bsl_sample_data_configuration_type;
                $slto = $research_item->bsl_sample_data_other_laser_type;
                if ($sc == CONFIG_BACKSCATTERING) {
                    $sc_text = lang("BACKSCATTERING");
                } else {
                    $sc_text = lang("FWD_SCATTERING");
                }
                $slt = $research_item->bsl_sample_data_laser_type;
                if ($slt == HENE_LASER_TYPE) {
                    $slt_text = lang("HENE");
                } else {
                    if ($slt == DIODE_LASER_TYPE) {
                        $slt_text = lang("DIODE");
                    } else {
                        $slt_text = lang("OTHER") . " : " . $slto ;
                    }
                }

                $sw = $research_item->bsl_sample_data_laser_wavelength;
                $sp = $research_item->bsl_sample_data_permission;
                $sai = $research_item->bsl_sample_data_amount_of_images;
                $so = $research_item->bsl_sample_data_owner_id;
                if ($sp == PERMISSION_PUBLIC) {
                    $sp_text = lang("PERMISSION_PUBLIC");
                } else {
                    $sp_text = lang("PERMISSION_PRIVATE_OWNER");
                }
                $spub = $research_item->bsl_sample_data_published_DOI_URL;
                // Busca o dono da pesquisa
                $owner_data = getResearchOwnerData($research_item->bsl_sample_data_owner_id);
                $owner_name = "...";
                if ($owner_data != null) {
                    $owner_name = $owner_data->lname . ", " . $owner_data->fname;
                }
                // Tratamento da imagem
                $image_data = $research_item->bsl_sample_data_cover_image;
                if ($image_data === null) {
                    // Para que a imagem seja carregada no formato correto
                    $filename = '../images/default.bmp';
                    $fp = fopen($filename, "r");
                    $filesize = filesize($filename);
                    // If successful, read from the file pointer using the size of the file (in bytes) as the length.
                    if ($fp) {
                        $content = fread($fp, $filesize);
                        fclose($fp);
                        $image_data = base64_encode($content);
                    }
                }
                ?>
                <div class="row">
                    <div class="col align-self-center">
                        <div role="alert" class="mt-1 alert alert-primary bg-primary text-white ">
                            <img class="tumbnail" src="<?="data:image/bmp;base64," . $image_data;?>" style="height: 20mm;">
                            <div><?=lang("RESEARCH_OWNER_NAME");?>: <b><?=$owner_name; ?></b></div>
                            <div><?=lang("SAMPLE_IDENTIFICATION_MSG");?>: <b><?=$uid; ?></b></div>
                            <div><?=lang("ILLUMINATED_SAMPLE");?>: <b><?=$sn;?></b></div>
                            <div><?=lang("TIME_RATE");?>: <b><?=$sfr;?></b></div>
                            <div><?=lang("SAMPLE_CONFIG");?>: <b><?=$sc_text;?></b></div>
                            <div><?=lang("LASER_TYPE");?>: <b><?=$slt_text;?></b></div>
                            <div><?=lang("LASER_WAVELENGTH");?>: <b><?=$sw;?></b></div>
                            <div><?=lang("IMAGES_PERMISSION");?>: <b><?=$sp_text;?></b></div>
                            <div><?=lang("NUMBER_OF_IMAGES");?>: <b><?=$sai; ?></b></div>
                            <div><?=lang("RESEARCH_PUBLIC_ID");?>: <b><?=$spub; ?></b></div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="row p-2">
                            <div class="col align-self-center">
                                <input type="button" value="<?=lang("DOWNLOAD_RESEARCH_BTN");?>"
                                       onclick="downloadResearch('<?=$uid;?>')" class="btn btn-primary"/>
                            </div>
                        </div>
                        <?php
                            if ($so == $user_id) { ?>
                        <div class="row p-2">
                            <div class="col">
                            <input type="button" value="<?=lang("DELETE_RESEARCH_BTN");?>"
                               onclick="deleteResearch('<?=$uid;?>')" class="btn btn-warning"/>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col">
                            <input type="button" value="<?=lang("EDIT_RESEARCH_BTN");?>"
                                   onclick="editResearch('<?=$uid;?>')" class="btn btn-info"/>
                            </div>
                        </div>
                        <?php
                            } ?>
                    </div>
                </div>
    <?php
            }
        }
    ?>

</div>

<script type="text/javascript" src="js/transactions.js"></script>
<script type="text/javascript" src="../js/utils.js"></script>
<script type="text/javascript" src="js/FileSaver.min.js"></script>



<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; ?>

