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
?>

<link rel="stylesheet" type="text/css" href="../css/styles.css">

<head>
    <meta charset="utf-8">
    <title><?=lang("PROCESS_IMAGES"); ?>></title>

    <script type="text/javascript">
        let filename_msg = "<?=$image_name_msg; ?>";
    </script>

    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</head>

<body>
<br><br>
<div class="container">
    <h2><?=lang("SELECT_IMAGES");?></h2>

        <!--div class="progress" style="color: red; height: 30px; font-size: large">
            <div id="progresso" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0"
                 aria-valuemin="0" aria-valuemax="100" style="padding: 8px; width: 0%; font-size: large;"></div>
        </div-->

        <div class="form-group row">

            <div class="col">
                <input type="file" id="getfiles" style="display: none;" capture="camera"
                       onchange="readURL(this,'mini_foto_new');" multiple/>
                <input type="button" value="<?=lang("SELECT_IMAGES_BTN");?>" onclick="document.getElementById('getfiles').click();"
                       class="btn btn-default"/>
                <input type="button" id="zipimages" style="display: none;" onclick="getContract();" value="Salvar Imagem" />
                <input type="button" value="<?=lang("ZIP_IMAGES");?>" onclick="zipFiles()"
                       class="btn btn-default"/>
                <hr>
            </div>
            <div class="container bg-light" id="tumbnails">
                <!-- Exibir a imagem que irá para o upload -->
                <!--img id="mini_foto_new" width=90% class="mini_foto" src="img/default.png" /-->
                <!--div class="row justify-content-between align-items-center border">
                    <div class="col">Image file name:</div>
                    <div class="col">1.bmp</div>
                    <div class="col-auto"><img class="img-fluid" id="mini_foto_new" src="img/default.png" style="width: 100px"/></div>
                </div-->
            </div>

            <div id="container">
                <h1>
                    <a href="../">zip.js</a> <span class="small"></span>
                </h1>
                <div class="description">
                    A JavaScript library to zip and unzip files
                    <hr>
                </div>
                <h2>Create a zip file (demo)</h2>
                <ol id="demo-container">
                    <li>
                        <label>
                            <span class="form-label">set a password (optional)</span>
                            <input type="password" id="password-input" value="">
                        </label>
                    </li>
                    <li>
                        <label>
                            <span class="form-label">add files into the zip</span>
                            <button id="file-input-button">Add files...</button>
                            <!--input type="file" multiple id="file-input" hidden-->
                        </label>
                    </li>
                    <li>
                        <label>
                            <span class="form-label">view zip content</span>
                            <ul id="file-list" class="empty">
                            </ul>
                        </label>
                    </li>
                    <li>
                        <label>
                            <span class="form-label">set zip file name</span>
                            <input type="text" id="filename-input" value="Download.zip">
                        </label>
                    </li>
                    <li>
                        <label>
                            <span class="form-label">download the zip file</span>
                            <button id="download-button" disabled>Download</button>
                        </label>
                    </li>
                </ol>
            </div>
        </div>
        <script type="text/javascript" src="js/zip/zip.js"></script>
        <script src="js/transactions.js"></script>
</div>

</body>

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; ?>

