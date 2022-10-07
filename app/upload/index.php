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

require_once "properties_modal.php";
?>

<link rel="stylesheet" type="text/css" href="../css/styles.css">
<script type="text/javascript">
    let filename_msg = "<?=$image_name_msg; ?>";
    let no_image_info = "<?=$no_image_information; ?>";
    let image_date = "<?=$image_date; ?>";
    let image_size = "<?=$image_size; ?>";
    let btn_remove_text = "<?=$btn_remove_text; ?>";
    let btn_edit_text = "<?=$btn_edit_text; ?>";
</script>

<br><br>
<div class="container">
    <h2><?=lang("SELECT_IMAGES");?></h2>

        <!--div class="progress" style="color: red; height: 30px; font-size: large">
            <div id="progresso" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0"
                 aria-valuemin="0" aria-valuemax="100" style="padding: 8px; width: 0%; font-size: large;"></div>
        </div-->

        <div class="row">
            <div class="col">
                <input type="file" id="getfiles" style="display: none;" capture="camera"
                       onchange="readURL(this,'mini_foto_new');" multiple/>
                <input type="button" value="<?=lang("SELECT_IMAGES_BTN");?>"
                       onclick="document.getElementById('getfiles').click();" class="btn btn-default"/>
                <input type="button" value="<?=lang("IMAGE_PROPERTIES");?>" data-toggle='modal'
                       id="btn_prop_modal" data-target='#properties-modal' data-backdrop="static"
                       class="btn btn-default"/>
                <hr>
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

