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

$user_id = $user->data()->id;

require_once "../database_layer.php";

//#############################################################
// Carrega todas as pesquisas
$user_public_researches = getUserAndPublicResearches($user_id);
?>

<link rel="stylesheet" type="text/css" href="../css/styles.css">
<script type="text/javascript">
    let researchers = <?php
    if ($user_public_researches->count() > 0) {
        echo json_encode($user_public_researches->results());
    } else {
        echo json_encode("none");
    } ?>;
    let user_id = <?php echo $user_id; ?>;
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
        <div class="col align-self-center">
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
                $slt = $research_item->bsl_sample_data_laser_type;
                $slto = $research_item->bsl_sample_data_other_laser_type;
                $sw = $research_item->bsl_sample_data_laser_wavelength;
                $sp = $research_item->bsl_sample_data_permission;
                $sai = $research_item->bsl_sample_data_amount_of_images;
                $so = $research_item->bsl_sample_data_owner_id;
                ?>
                <div class="row">
                    <div class="col align-self-center">
                </div>
                    <div class="col align-self-center">
                </div>
    <?php
            }
        }
    ?>
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

</div>

<script type="text/javascript" src="js/transactions.js"></script>
<script type="text/javascript" src="../js/utils.js"></script>



<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; ?>

