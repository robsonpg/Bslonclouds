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

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/styles.css">

<style>
    @font-face { font-family: 'Aeros'; src: url('../css/Aeros.ttf') format('truetype'); }
    body { font-family: 'Inter', sans-serif; }

    /* Hero */
    .bsl-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0c2340 100%);
        border-radius: 12px;
        padding: 32px 36px 26px;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }
    .bsl-hero::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 280px; height: 280px;
        background: radial-gradient(circle, rgba(2,167,233,0.15) 0%, transparent 70%);
        pointer-events: none;
    }
    .bsl-hero-title {
        font-family: 'Aeros', serif;
        font-size: 2rem;
        font-weight: 700;
        letter-spacing: 2px;
        white-space: nowrap;
        margin-bottom: 6px;
        line-height: 1.2;
    }
    .bsl-hero-title .c-blue  { color: #02a7e9; }
    .bsl-hero-title .c-green { color: #68b849; }
    .bsl-hero-title .c-orange{ color: #f1893a; }
    .bsl-hero-title .c-white { color: #e2e8f0; }
    .bsl-hero-subtitle {
        color: #94a3b8;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    /* Step hint panels next to buttons */
    .bsl-step-hint {
        background: #f0f9ff;
        border-left: 4px solid #02a7e9;
        border-radius: 0 8px 8px 0;
        padding: 10px 16px;
        font-size: 0.88rem;
        color: #1e3a5f;
        line-height: 1.5;
    }
    .bsl-step-hint .bsl-step-title {
        display: block;
        font-weight: 600;
        margin-bottom: 2px;
        color: #0f172a;
    }

    /* Image properties dynamic card */
    #images_properties {
        background: linear-gradient(135deg, #1e3a5f 0%, #0f2744 100%) !important;
        border: none !important;
        border-radius: 12px !important;
        color: #e2e8f0 !important;
        padding: 16px 20px !important;
        width: 100%;
    }

    /* Thumbnails area */
    #tumbnails {
        min-height: 80px;
        border-radius: 10px;
    }

    /* Divider */
    hr { border-color: #e2e8f0; margin: 20px 0; }
</style>
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


    <div id="error_messages_place"></div>

    <!-- Hero -->
    <div class="row mb-3 pt-3">
        <div class="col-md-12">
            <div class="bsl-hero">
                <div class="bsl-hero-title">
                    <span class="c-blue">B</span><span class="c-white">IO</span><span class="c-green">S</span><span class="c-white">PECKLE </span><span class="c-orange">L</span><span class="c-white">ASER On CLOUDS</span>
                </div>
                <p class="bsl-hero-subtitle"><?=lang("MENU_IMAGE_MANAGER");?> &mdash; <?=lang("MSG_IMAGE_MANAGER");?></p>
            </div>
        </div>
    </div>

        <div class="row mb-2 align-items-center">
            <div class="col-3 align-self-center">
                <input type="button" value="<?=lang("IMAGE_PROPERTIES");?>" data-bs-toggle='modal'
                       id="btn_prop_modal" data-bs-target='#properties-modal' data-backdrop="static"
                       class="btn btn-primary"/>
            </div>
            <div class="col align-self-center">
                <div class="bsl-step-hint">
                    <span class="bsl-step-title"><?=lang("IMAGES_PROPERTIES_TITLE");?></span>
                    <?=lang("IMAGES_PROPERTIES_TEXT"); ?>
                </div>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3 align-self-center">
                <input type="file" id="getfiles" style="display: none;" capture="camera"
                       onchange="readURL(this,'mini_foto_new');" multiple accept=".bmp"/>
                <input type="button" id="btn_get_files" value="<?=lang("SELECT_IMAGES_BTN");?>"
                       onclick="document.getElementById('getfiles').click();" class="btn btn-primary" disabled/>
            </div>
            <div class="col align-self-center">
                <div class="bsl-step-hint">
                    <span class="bsl-step-title"><?=lang("SELECT_IMAGES_TITLE");?></span>
                    <?=lang("SELECT_IMAGES_TEXT"); ?>
                </div>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3 align-self-center">
                <input type="button" value="<?=lang("SEND_IMAGES");?>" data-bs-toggle='modal'
                       id="btn_send_modal" data-bs-target='#send-images-modal' data-bs-backdrop="static"
                       class="btn btn-primary" onclick="sendImagesToServer()" disabled/>
            </div>
            <div class="col align-self-center">
                <div class="bsl-step-hint">
                    <span class="bsl-step-title"><?=lang("SEND_IMAGES_TITLE");?></span>
                    <?=lang("SEND_IMAGES_TEXT"); ?>
                </div>
            </div>
        </div>
        <div class="row mb-2 align-items-center">
            <div class="col-3 align-self-center">
                <input type="button" value="<?=lang("CLEAR_ALL");?>" data-bs-toggle='modal'
                       id="btn_clear"  class="btn btn-warning" onclick="clearAllData()" />
            </div>
            <div class="col align-self-center">
                <div class="bsl-step-hint">
                    <span class="bsl-step-title"><?=lang("CLEAR_ALL_TITLE");?></span>
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
            <div id="images_properties" style="display: none">
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

