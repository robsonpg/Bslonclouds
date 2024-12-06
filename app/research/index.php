<?php

/**
 * Created by PhpStorm.
 * User: Robson
 * Date: 15/02/2018
 * Time: 19:52
 */

require_once '../../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

//if (!$user->isLoggedIn()) {
//    header('Location: /index.php');
//    exit;
//}
require_once "delete_modal.php";
require_once "processing_images_modal.php";
require_once "accept_modal.php";
require_once "rename_modal.php";
require_once "../upload/properties_modal.php";
require_once "../database_layer.php";
require_once "../constants.php";

if ($user->isLoggedIn()) {
    $user_id = $user->data()->id;
    $user_moderator = hasPerm([ATTR_MODERATOR], $user->data()->id);
    $user_public_researches = null;
} else {
    $user_moderator = false;
}
//###############################################################
// Se for moderador, tem acesso a todas as pesquisas
if ($user_moderator) {
    $user_public_researches = getAllResearches();
} else {
    //#############################################################
    // Carrega todas as pesquisas do usuário e públicas
    if ($user->isLoggedIn()) {
        $user_public_researches = getUserAndPublicResearches($user_id);
    } else {
        $user_public_researches = clone(getPublicResearches());
    }
}

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
    let msg_accepting = "<?=lang("ACCEPTING_MSG"); ?>";
</script>

<br>

    <div class="row">
        <div class="col-md-12">
            <div role="alert" class="alert alert-success">
                <h4 class="alert-heading" style="font-family: 'Aeros',serif"><a style="color: #02a7e9">
                        B</a>IO<a style="color: #68b849">S</a>PECKLE <a style="color: #f1893a">L<a>ASER On CLOUDS</h4>
                <h6><?=lang("MENU_RESEARCH_CATALOG");?></h6>
            </div>
        </div>
    </div>
    <?php if ($user->isLoggedIn()) { ?>
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
                    $obs = $research_item->bsl_sample_data_obs;
                    // Status da pesquisa - aceita ou rejeitada ou aguardando verificação
                    $sstatus = $research_item->bsl_sample_data_status;
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
                                <div><?=lang("OBSERVATIONS_MSG");?>: <b><?=$obs; ?></b></div>
                                <div style="color: bisque"><b><?=lang("CC_BY_4");?></b></div>
                                <?php
                                    // Tratamento para aceite de pesquisa
                                    if (($sstatus == RESEARCH_STATUS_WAINTING_REVISION) && ($user_moderator)) {
                                ?>
                                    <div>
                                        <br>
                                        <h4 style="color: #9a161a"><?=lang("RESEARCH_WAINTING_APPROVAL"); ?></h4>
                                    </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <?php if ($user->isLoggedIn()) { ?>
                            <div class="col-5">
                                <div class="row p-2">
                                    <div class="col align-self-center">
                                        <input type="button" value="<?=lang("DOWNLOAD_RESEARCH_BTN");?>"
                                               onclick="downloadResearch('<?=$uid;?>')" class="btn btn-primary"/>
                                    </div>
                                </div>
                                <?php
                                    if (($so == $user_id) || ($user_moderator)) { ?>
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
                                <?php
                                // Tratamento para aceite de pesquisa
                                if (($sstatus == RESEARCH_STATUS_WAINTING_REVISION) && ($user_moderator)) {
                                    ?>
                                    <div class="row p-2">
                                        <div class="col">
                                        <input type="button" value="<?=lang("APPROVAL_RESEARCH_BTN");?>"
                                               onclick="acceptResearch('<?=$uid;?>')" class="btn btn-danger"/>
                                        </div>
                                    </div>
                                <?php 
                                }
                                ?>
                                <?php
                                // Tratamento para renommar pesquisa
                                if (($user_moderator)) {
                                    ?>                                    
                                    <div class="row p-2">
                                        <div class="col">
                                        <input type="button" value="<?=lang("RENAME_RESEARCH_BTN");?>"
                                               onclick="renameResearch('<?=$uid;?>')" class="btn btn-danger"/>
                                        </div>
                                    </div>                                    
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    <?php
                }
            }
        } else {
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div role="alert" class="alert alert-info">
                        <a><?=lang("TEXT_MUST_LOGIN"); ?></a>
                    </div>
                </div>
            </div>
            <?php
        }
        if (!$user->isLoggedIn()) {
            if ($user_public_researches->count() > 0) {
                foreach ($user_public_researches->results() as $research) {
                    ?>
                    <div class="row">
                        <div class="col-12 my-2">
                            <div class="card card-body p-3 text-black bg-dark">
                                <div class="list-group-item d-block">
                                    <div class="row">
                                        <div class="col-3">
                                            <?php if ($research->bsl_sample_data_cover_image == null) { ?>
                                                <img src="app/images/default.bmp" class="img-fluid rounded-circle mx-auto d-block" style="height: 20mm">
                                                <?php
                                            } else { ?>
                                                <img src="<?='data:image/bmp;base64,' . $research->bsl_sample_data_cover_image;?>" class="img-fluid rounded-circle mx-auto d-block" style="height: 20mm">
                                                <?php
                                            } ?>
                                        </div>
                                        <div class="col-3 text-center text-sm-left">
                                            <h5><span class="text-muted">Research: <?=$research->bsl_sample_data_unique_id;?></span></h5>
                                            <span class="text-muted">Researcher Name: <?=$research->lname . ', ' . $research->fname; ?></span>
                                            <br>
                                            <span class="badge badge-success">Country: <?=$research->locale; ?></span>
                                        </div>
                                        <div class="col-6 text-center text-sm-left">
                                            <label for="observation_text_area"><?=lang("OBSERVATIONS_MSG"); ?></label>
                                            <textarea style="width: 100%" readonly><?=$research->bsl_sample_data_obs; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-primary">
                                        <a class="badge badge-primary float-right" href="<?=$research->bsl_sample_data_published_DOI_URL; ?>">
                                            Published: <?=$research->bsl_sample_data_published_DOI_URL; ?></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else { ?>
                <div class="row">
                    <div class="col-12 my-2">
                        <div class="card card-body p-3 text-black bg-dark">
                            <div class="list-group-item d-block">
                                <div class="row">
                                    --------------
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>


<script type="text/javascript" src="js/transactions.js"></script>
<script type="text/javascript" src="../js/utils.js"></script>
<script type="text/javascript" src="js/FileSaver.min.js"></script>



<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; ?>

