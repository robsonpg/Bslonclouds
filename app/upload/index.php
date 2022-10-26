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
    echo "<br><br><label style=\"color:floralwhite; font: bold 16px arial, serif\">Você não está logado no site!</label>";
    exit;
}

$image_name_msg = lang("IMAGE_NAME_MSG");
$no_image_information = lang("NO_IMAGE_INFORMATION");
$image_date = lang("IMAGE_DATE");
$image_size = lang("IMAGE_SIZE");
$btn_remove_text = lang("BTN_REMOVE_IMAGE");
$btn_edit_text = lang("BTN_EDIT_PROP");

$user_id = $user->data()->id;

$msg_exist = lang("EXIST_UNIQUE_ID");
$msg_min = lang("MIN_UNIQUE_ID_CHARS");
$msg_ok = lang("UNIQUE_ID_OK");

require_once "properties_modal.php";
require_once "send_images_modal.php";
require_once "../database_layer.php";

//#############################################################
// Carrega todas as pesquisas
$all_researches = getAllResearchesID();
?>

<link rel="stylesheet" type="text/css" href="../css/styles.css">
<script type="text/javascript">
    let filename_msg = "<?=$image_name_msg; ?>";
    let no_image_info = "<?=$no_image_information; ?>";
    let image_date = "<?=$image_date; ?>";
    let image_size = "<?=$image_size; ?>";
    let btn_remove_text = "<?=$btn_remove_text; ?>";
    let btn_edit_text = "<?=$btn_edit_text; ?>";
    let msg_exist = "<?=$msg_exist; ?>";
    let msg_min = "<?=$msg_min; ?>";
    let msg_ok = "<?=$msg_ok; ?>";

    let msg_uid = "<?=lang("SAMPLE_IDENTIFICATION");?>";
    let msg_illumi = "<?=lang("ILLUMINATED_SAMPLE");?>";
    let msg_fr = "<?=lang("TIME_RATE");?>";
    let msg_config = "<?=lang("SAMPLE_CONFIG");?>";
    let msg_lt = "<?=lang("LASER_TYPE");?>";
    let msg_lw = "<?=lang("LASER_WAVELENGTH");?>";
    let msg_per = "<?=lang("IMAGES_PERMISSION");?>";

    let researchers = <?php
    if (sizeof($all_researches) == 0) {
        echo json_encode("none");
    } else {
        echo json_encode($all_researches);
    } ?>;
    let user_id = <?php echo $user_id; ?>;
</script>

<br><br>
<div class="container">
    <h2><?=lang("MENU_IMAGE_MANAGER");?></h2>
        <div class="row">
            <div class="col-2 align-self-center">
                <input type="button" value="<?=lang("IMAGE_PROPERTIES");?>" data-toggle='modal'
                       id="btn_prop_modal" data-target='#properties-modal' data-backdrop="static"
                       class="btn btn-primary"/>
            </div>
            <div class="col align-self-center">
                <div role="alert" class="mt-1 alert alert-info alert-dismissible fade show">
                    <span class="font-weight-bold"><?=lang("IMAGES_PROPERTIES_TITLE");?></span><br>
                    <?=lang("IMAGES_PROPERTIES_TEXT"); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2 align-self-center">
                <input type="file" id="getfiles" style="display: none;" capture="camera"
                       onchange="readURL(this,'mini_foto_new');" multiple accept=".bmp"/>
                <input type="button" value="<?=lang("SELECT_IMAGES_BTN");?>"
                       onclick="document.getElementById('getfiles').click();" class="btn btn-primary"/>
            </div>
            <div class="col align-self-center">
                <div role="alert" class="mt-1 alert alert-info alert-dismissible fade show">
                    <span class="font-weight-bold"><?=lang("SELECT_IMAGES_TITLE");?></span><br>
                    <?=lang("SELECT_IMAGES_TEXT"); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2 align-self-center">
                <input type="button" value="<?=lang("SEND_IMAGES");?>" data-toggle='modal'
                       id="btn_send_modal" data-target='#send-images-modal' data-backdrop="static"
                       class="btn btn-primary" onclick="sendImagesToServer()" disabled/>
            </div>
            <div class="col align-self-center">
                <div role="alert" class="mt-1 alert alert-info alert-dismissible fade show">
                    <span class="font-weight-bold"><?=lang("SEND_IMAGES_TITLE");?></span><br>
                    <?=lang("SEND_IMAGES_TEXT"); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2 align-self-center">
                <input type="button" value="<?=lang("CLEAR_ALL");?>" data-toggle='modal'
                       id="btn_clear"  class="btn btn-warning" onclick="clearAllData()" />
            </div>
            <div class="col align-self-center">
                <div role="alert" class="mt-1 alert alert-info alert-dismissible fade show">
                    <span class="font-weight-bold"><?=lang("CLEAR_ALL_TITLE");?></span><br>
                    <?=lang("CLEAR_ALL_TEXT"); ?>
                </div>
            </div>
            <!--input type="file" id="getfilesrename" style="display: none;"
                   onchange="renameFiles(this,'mini_foto_new');" multiple accept=".bmp"/>
            <input type="button" value="Rename" id="btn_rename" class="btn btn-default"
                   onclick="document.getElementById('getfilesrename').click();"/>
            <hr-->
            </div>
        </div>
        <div class="row">
            <div class="mt-1 alert alert-primary bg-primary text-white alert-dismissible fade show"
                 id="images_properties" style="display: none">
            <!-- Aqui vão as propriedades das imagens -->
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="container bg-light" id="tumbnails">
                <!-- Exibir a imagem que irá para o upload -->
                <!--img id="mini_foto_new" width=90% class="mini_foto" src="img/default.png" /-->
                <!--div class="row justify-content-between align-items-center border">
                    <div class="col">Image file name:</div>
                    <div class="col">1.bmp</div>
                    <div class="col-auto"><img class="img-fluid" id="mini_foto_new" src="img/default.png" style="width: 100px"/></div>
                </div-->
            </div>
        </div>
</div>

<script type="text/javascript" src="js/transactions.js"></script>
<script type="text/javascript" src="../js/utils.js"></script>



<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; ?>

