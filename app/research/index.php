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

    /* Column headers */
    .bsl-col-header {
        background: #f1f5f9;
        border-radius: 8px;
        padding: 8px 16px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: 0;
    }

    /* Research card (logged-in) */
    .bsl-research-card {
        border: none;
        border-radius: 12px;
        background: linear-gradient(135deg, #1e3a5f 0%, #0f2744 100%);
        color: #e2e8f0;
        padding: 16px 20px;
        margin-top: 8px;
    }
    .bsl-research-card img.tumbnail {
        border-radius: 8px;
        margin-bottom: 12px;
    }
    .bsl-research-card .rc-label {
        color: #94a3b8;
        font-size: 0.78rem;
    }
    .bsl-research-card .rc-value {
        color: #f1f5f9;
        font-weight: 600;
    }
    .bsl-research-card .rc-row {
        display: flex;
        gap: 6px;
        margin-bottom: 4px;
        font-size: 0.85rem;
        align-items: baseline;
    }
    .bsl-research-card .rc-license {
        margin-top: 10px;
        font-size: 0.78rem;
        color: #fcd38d;
    }
    .bsl-research-card .rc-pending {
        color: #f87171;
        font-weight: 700;
        font-size: 0.9rem;
        margin-top: 8px;
    }

    /* Action buttons column */
    .bsl-actions-col { padding: 8px 4px; }
    .bsl-actions-col .btn { margin-bottom: 6px; width: 100%; font-size: 0.82rem; border-radius: 7px; }

    /* Login prompt */
    .bsl-login-prompt {
        border-left: 4px solid #02a7e9;
        border-radius: 0 10px 10px 0;
        background: #f0f9ff;
        padding: 16px 20px;
        color: #1e3a5f;
        font-size: 0.94rem;
    }

    /* Public catalog card (guest) */
    .bsl-public-card {
        border: none;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        padding: 0;
        overflow: hidden;
        margin-bottom: 12px;
    }
    .bsl-public-card .bsl-pc-img {
        width: 100%;
        height: 80px;
        object-fit: cover;
        border-radius: 50%;
        display: block;
        margin: 0 auto;
    }
    .bsl-public-card .bsl-pc-id {
        font-size: 0.85rem;
        font-weight: 700;
        color: #1e3a5f;
    }
    .bsl-public-card .bsl-pc-researcher {
        font-size: 0.8rem;
        color: #64748b;
    }
    .bsl-public-card .bsl-pc-country {
        display: inline-block;
        background: #68b849;
        color: #fff;
        border-radius: 99px;
        padding: 2px 10px;
        font-size: 0.72rem;
        font-weight: 600;
        margin-top: 4px;
    }
    .bsl-public-card .bsl-pc-doi {
        display: inline-block;
        background: #02a7e9;
        color: #fff;
        border-radius: 6px;
        padding: 3px 10px;
        font-size: 0.75rem;
        font-weight: 600;
        text-decoration: none;
        float: right;
        margin-top: 6px;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .bsl-public-card .bsl-pc-doi:hover { background: #0284c7; color: #fff; text-decoration: none; }

    /* Empty state */
    .bsl-empty {
        text-align: center;
        padding: 40px;
        color: #94a3b8;
        font-size: 0.95rem;
    }
</style>

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


    <!-- Hero -->
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="bsl-hero">
                <div class="bsl-hero-title">
                    <span class="c-blue">B</span><span class="c-white">IO</span><span class="c-green">S</span><span class="c-white">PECKLE </span><span class="c-orange">L</span><span class="c-white">ASER On CLOUDS</span>
                </div>
                <p class="bsl-hero-subtitle"><?=lang("MENU_RESEARCH_CATALOG");?></p>
            </div>
        </div>
    </div>
    <?php if ($user->isLoggedIn()) { ?>
        <div class="row mb-2">
            <div class="col align-self-center">
                <div class="bsl-col-header">Research Description</div>
            </div>
            <div class="col-5 align-self-center">
                <div class="bsl-col-header">Actions</div>
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
                            <div class="bsl-research-card">
                                <img class="tumbnail" src="<?="data:image/bmp;base64," . $image_data;?>" style="height: 20mm;">
                                <div class="rc-row"><span class="rc-label"><?=lang("RESEARCH_OWNER_NAME");?>:</span><span class="rc-value"><?=htmlspecialchars($owner_name); ?></span></div>
                                <div class="rc-row"><span class="rc-label"><?=lang("SAMPLE_IDENTIFICATION_MSG");?>:</span><span class="rc-value"><?=htmlspecialchars($uid); ?></span></div>
                                <div class="rc-row"><span class="rc-label"><?=lang("ILLUMINATED_SAMPLE");?>:</span><span class="rc-value"><?=htmlspecialchars($sn);?></span></div>
                                <div class="rc-row"><span class="rc-label"><?=lang("TIME_RATE");?>:</span><span class="rc-value"><?=htmlspecialchars($sfr);?></span></div>
                                <div class="rc-row"><span class="rc-label"><?=lang("SAMPLE_CONFIG");?>:</span><span class="rc-value"><?=htmlspecialchars($sc_text);?></span></div>
                                <div class="rc-row"><span class="rc-label"><?=lang("LASER_TYPE");?>:</span><span class="rc-value"><?=htmlspecialchars($slt_text);?></span></div>
                                <div class="rc-row"><span class="rc-label"><?=lang("LASER_WAVELENGTH");?>:</span><span class="rc-value"><?=htmlspecialchars($sw);?></span></div>
                                <div class="rc-row"><span class="rc-label"><?=lang("IMAGES_PERMISSION");?>:</span><span class="rc-value"><?=htmlspecialchars($sp_text);?></span></div>
                                <div class="rc-row"><span class="rc-label"><?=lang("NUMBER_OF_IMAGES");?>:</span><span class="rc-value"><?=htmlspecialchars($sai); ?></span></div>
                                <div class="rc-row"><span class="rc-label"><?=lang("RESEARCH_PUBLIC_ID");?>:</span><span class="rc-value"><?=htmlspecialchars($spub); ?></span></div>
                                <div class="rc-row"><span class="rc-label"><?=lang("OBSERVATIONS_MSG");?>:</span><span class="rc-value"><?=htmlspecialchars($obs); ?></span></div>
                                <div class="rc-license"><b><?=lang("CC_BY_4");?></b></div>
                                <?php
                                    // Tratamento para aceite de pesquisa
                                    if (($sstatus == RESEARCH_STATUS_WAINTING_REVISION) && ($user_moderator)) {
                                ?>
                                    <div class="rc-pending"><?=lang("RESEARCH_WAINTING_APPROVAL"); ?></div>
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
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="bsl-login-prompt">
                        <?=lang("TEXT_MUST_LOGIN"); ?>
                    </div>
                </div>
            </div>
            <?php
        }
        if (!$user->isLoggedIn()) {
            if ($user_public_researches->count() > 0) {
                foreach ($user_public_researches->results() as $research) {
                    ?>
                    <div class="row mb-2">
                        <div class="col-12">
                            <div class="bsl-public-card p-3">
                                <div class="row align-items-center">
                                    <div class="col-2 text-center">
                                        <?php if ($research->bsl_sample_data_cover_image == null) { ?>
                                            <img src="app/images/default.bmp" class="bsl-pc-img" style="height:20mm;width:auto;border-radius:8px">
                                        <?php } else { ?>
                                            <img src="<?='data:image/bmp;base64,' . $research->bsl_sample_data_cover_image;?>" class="bsl-pc-img" style="height:20mm;width:auto;border-radius:8px">
                                        <?php } ?>
                                    </div>
                                    <div class="col-4">
                                        <div class="bsl-pc-id"><?=htmlspecialchars($research->bsl_sample_data_unique_id);?></div>
                                        <div class="bsl-pc-researcher"><?=htmlspecialchars($research->lname . ', ' . $research->fname); ?></div>
                                        <span class="bsl-pc-country"><?=htmlspecialchars($research->locale); ?></span>
                                    </div>
                                    <div class="col-6">
                                        <label style="font-size:.78rem;color:#64748b;font-weight:600"><?=lang("OBSERVATIONS_MSG"); ?></label>
                                        <textarea class="form-control form-control-sm" style="font-size:.82rem;resize:none" rows="3" readonly><?=htmlspecialchars($research->bsl_sample_data_obs); ?></textarea>
                                        <?php if ($research->bsl_sample_data_published_DOI_URL) { ?>
                                        <a class="bsl-pc-doi" href="<?=htmlspecialchars($research->bsl_sample_data_published_DOI_URL); ?>" target="_blank">
                                            Published: <?=htmlspecialchars($research->bsl_sample_data_published_DOI_URL); ?>
                                        </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else { ?>
                <div class="row mb-2">
                    <div class="col-12">
                        <div class="bsl-empty">
                            <i class="fa fa-search fa-2x mb-2"></i><br>
                            <?=lang("NO_RESEARCH_FOUND"); ?>
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

