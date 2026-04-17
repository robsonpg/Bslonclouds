<?php

require_once '../../users/init.php';
require_once '../database_layer.php';
require_once '../constants.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

if (!$user->isLoggedIn()) {
    header('Location: /index.php');
    exit;
}

$visitors_statistics = clone(getAllDatabaseVisitorInfo());

require_once "sizeerror_modal.php";
require_once "colorerror_modal.php";
require_once "graphavd_modal.php";
require_once "clickpoint_modal.php";
require_once "imagesloaded_modal.php";
require_once "cacheerror_modal.php";
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
</style>

<script>
    let cities = <?php echo json_encode($visitors_statistics->results()); ?>;
    let msg_loading = "<?=lang("MSG_LOADING_IMAGES");?>";
    let image_date = "<?=lang("IMAGE_DATE"); ?>";
    let filename_msg = "<?=lang("IMAGE_NAME_MSG"); ?>";
    let msg_select_images = "<?=lang("SELECT_IMAGES_BTN");?>";
    let msg_error_loding_images = "<?=lang("ERROR_LOADING_IMAGES");?>";
    let msg_avd_images = "<?=lang("AVD_TEXT_MSG_1")?>";
    let msg_analysing = "<?=lang("BTN_ANALYSING");?>";
    let msg_done = "<?=lang("MSG_DONE");?>";
</script>

<!-- Hero -->
<div class="row mb-3 pt-3">
    <div class="col-md-12">
        <div class="bsl-hero">
            <div class="bsl-hero-title">
                <span class="c-blue">B</span><span class="c-white">IO</span><span class="c-green">S</span><span class="c-white">PECKLE </span><span class="c-orange">L</span><span class="c-white">ASER On CLOUDS</span>
            </div>
            <p class="bsl-hero-subtitle"><?=lang("MENU_ANALYSIS");?></p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-8">
        <div role="alert" class="alert alert-info">
            <?=lang("ANALYSIS_MSG");?>
        </div>
        <div role="alert" class="alert alert-warning">
            <?=lang("ANALYSIS_WARNING");?>
        </div>
        <div role="alert" class="alert alert-danger">
            <?=lang("ANALYSIS_DANGER");?>
        </div>
    </div>
    <div class="col">
        <input type="file" id="getfiles" style="display: none;"
               onchange="readURL(this,'mini_foto_new');" multiple accept=".bmp"/>
        <input type="button" id="btn_get_files" value="<?=lang("SELECT_IMAGES_BTN");?>"
               onclick="document.getElementById('getfiles').click();" class="btn btn-primary"/>
        <a id="btn_start_avd" class="btn btn-primary disabled" onclick="CalcShowGraphAVD()">
            <?=lang("BTN_START_ANALISYS")?></a>
    </div>
</div>
<br>
<div id="error_messages_place"></div>
<div class="row">
    <div class="container bg-light" id="tumbnails">
    </div>
</div>
<br>

<script type="text/javascript" src="../js/utils.js"></script>
<script type="text/javascript" src="js/transactions.js"></script>

<?php
require_once $abs_us_root . $us_url_root . 'users/includes/html_footer.php';
?>

