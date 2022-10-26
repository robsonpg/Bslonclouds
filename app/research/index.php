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
require_once "delete_modal.php";
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
        <div class="col-3 align-self-center">
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
                ?>
                <div class="row">
                    <div class="col align-self-center">
                        <div role="alert" class="mt-1 alert alert-primary bg-primary text-white ">
                            <div class="col"><?=lang("SAMPLE_IDENTIFICATION");?>: <b><?=$uid; ?></b></div>
                            <div class="col"><?=lang("ILLUMINATED_SAMPLE");?>: <b><?=$sn;?></b></div>
                            <div class="col"><?=lang("TIME_RATE");?>: <b><?=$sfr;?></b></div>
                            <div class="col"><?=lang("SAMPLE_CONFIG");?>: <b><?=$sc_text;?></b></div>
                            <div class="col"><?=lang("LASER_TYPE");?>: <b><?=$slt_text;?></b></div>
                            <div class="col"><?=lang("LASER_WAVELENGTH");?>: <b><?=$sw;?></b></div>
                            <div class="col"><?=lang("IMAGES_PERMISSION");?>: <b><?=$sp_text;?></b></div>
                            <div class="col"><?=lang("NUMBER_OF_IMAGES");?>: <b><?=$sai; ?></b></div>
                        </div>
                    </div>
                    <div class="col-3 align-self-center">
                        <input type="button" value="<?=lang("DOWNLOAD_RESEARCH_BTN");?>"
                               onclick="downloadResearch('<?=$uid;?>')" class="btn btn-primary"/>
                        <?php
                            if ($so == $user_id) { ?>
                        <input type="button" value="<?=lang("DELETE_RESEARCH_BTN");?>"
                               onclick="deleteResearch('<?=$uid;?>')" class="btn btn-warning"/>
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

