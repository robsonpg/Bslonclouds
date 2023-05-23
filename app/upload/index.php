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
$user_name = $user->data()->fname;

require_once "properties_modal.php";
require_once "send_images_modal.php";
require_once "../database_layer.php";

//#############################################################
// Carrega todas as pesquisas
$all_researches = getAllResearchesID();
?>

<link rel="stylesheet" type="text/css" href="../css/styles.css">
<script type="text/javascript">
    let filename_msg = "<?=lang("IMAGE_NAME_MSG"); ?>";
    let no_image_info = "<?=lang("NO_IMAGE_INFORMATION"); ?>";
    let image_date = "<?=lang("IMAGE_DATE"); ?>";
    let image_size = "<?=lang("IMAGE_SIZE");?>";
    let btn_remove_text = "<?=lang("BTN_REMOVE_IMAGE") ?>";
    let btn_edit_text = "<?=lang("BTN_EDIT_PROP"); ?>";
    let msg_exist = "<?=lang("EXIST_UNIQUE_ID"); ?>";
    let msg_min = "<?=lang("MIN_UNIQUE_ID_CHARS"); ?>";
    let msg_ok = "<?=lang("UNIQUE_ID_OK"); ?>";
    let msg_send_images = "<?=lang("MODEL_START_SEND_IMAGES");?>";

    let msg_uid = "<?=lang("SAMPLE_IDENTIFICATION");?>";
    let msg_illumi = "<?=lang("ILLUMINATED_SAMPLE");?>";
    let msg_fr = "<?=lang("TIME_RATE");?>";
    let msg_config = "<?=lang("SAMPLE_CONFIG");?>";
    let msg_lt = "<?=lang("LASER_TYPE");?>";
    let msg_lw = "<?=lang("LASER_WAVELENGTH");?>";
    let msg_per = "<?=lang("IMAGES_PERMISSION");?>";
    let msg_pub = "<?=lang("RESEARCH_PUBLIC_ID");?>";
    let msg_user_name = "<?=lang("MSG_RESEARCH_NAME");?>";
    let msg_sending = "<?=lang("MSG_SENDING");?>";
    let msg_loading = "<?=lang("MSG_LOADING_IMAGES");?>";
    let msg_upload_images = "<?=lang("SEND_IMAGES");?>";
    let msg_cover = "<?=lang("COVER_IMAGE_MSG");?>";
    let msg_sending_done = "<?=lang("SEND_IMAGES_DONE_MSG");?>";
    let msg_select_images = "<?=lang("SELECT_IMAGES_BTN");?>";
    let msg_observations = "<?=lang("OBSERVATIONS_MSG");?>"
    let msg_upload_done = "<?=lang("MSG_UPLOAD_DONE");?>";

    let researchers = <?php
    if (sizeof($all_researches) == 0) {
        echo json_encode("none");
    } else {
        echo json_encode($all_researches);
    } ?>;
    let user_id = <?php echo $user_id; ?>;
    let login_user_name = "<?php echo $user_name; ?>";
</script>

<br>
    <div id="error_messages_place"></div>
    <div class="row">
        <div class="col-md-12">
            <div role="alert" class="alert alert-success">
                <h4 class="alert-heading" style="font-family: 'Aeros',serif"><a style="color: #02a7e9">
                        B</a>IO<a style="color: #68b849">S</a>PECKLE <a style="color: #f1893a">L<a>ASER On CLOUDS</h4>
                <h4><?=lang("MENU_IMAGE_MANAGER");?> - <?=lang("MSG_IMAGE_MANAGER");?></h4>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-3 align-self-center">
                <input type="button" value="<?=lang("IMAGE_PROPERTIES");?>" data-bs-toggle='modal'
                       id="btn_prop_modal" data-bs-target='#properties-modal' data-backdrop="static"
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
            <div class="col-3 align-self-center">
                <input type="file" id="getfiles" style="display: none;" capture="camera"
                       onchange="readURL(this,'mini_foto_new');" multiple accept=".bmp"/>
                <input type="button" id="btn_get_files" value="<?=lang("SELECT_IMAGES_BTN");?>"
                       onclick="document.getElementById('getfiles').click();" class="btn btn-primary" disabled/>
            </div>
            <div class="col align-self-center">
                <div role="alert" class="mt-1 alert alert-info alert-dismissible fade show">
                    <span class="font-weight-bold"><?=lang("SELECT_IMAGES_TITLE");?></span><br>
                    <?=lang("SELECT_IMAGES_TEXT"); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3 align-self-center">
                <input type="button" value="<?=lang("SEND_IMAGES");?>" data-bs-toggle='modal'
                       id="btn_send_modal" data-bs-target='#send-images-modal' data-bs-backdrop="static"
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
            <div class="col-3 align-self-center">
                <input type="button" value="<?=lang("CLEAR_ALL");?>" data-bs-toggle='modal'
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
            </div>
        </div>

<script type="text/javascript" src="../js/utils.js"></script>
<script type="text/javascript" src="js/transactions.js"></script>



<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; ?>

