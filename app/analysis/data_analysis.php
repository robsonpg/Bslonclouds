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

<style>
    @font-face {
        font-family: 'Aeros';
        src: url('../css/Aeros.ttf') format('truetype');
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

<body>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div role="alert" class="alert alert-success">
                    <h4 class="alert-heading" style="font-family: 'Aeros',serif"><a style="color: #02a7e9">
                            B</a>IO<a style="color: #68b849">S</a>PECKLE <a style="color: #f1893a">L<a>ASER On CLOUDS</h4>
                    <h4><?=lang("SERVICES_TEXT"); ?></h4>
                </div>
            </div>
        </div>
    </div> <!-- col class title-->
</div> <!-- row Title -->
<div class="row">
    <div class="col-8">
        <div role="alert" class="alert alert-info">
            <?=lang("ANALYSIS_MSG");?>
        </div>
        <div role="alert" class="alert alert-danger">
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
</body>

<script type="text/javascript" src="../js/utils.js"></script>
<script type="text/javascript" src="js/transactions.js"></script>

<?php
require_once $abs_us_root . $us_url_root . 'users/includes/html_footer.php';
?>
<!--a href="#home_bsl" class="float" style="padding-top: 3mm">
    <i class="fa fa-home my-float fa-2x"></i>
</a-->
</body>
<script>
    // Fun Facts
    function count($this) {
        var current = parseInt($this.html(), 10);
        current = current + 1; /* Where 50 is increment */

        $this.html(++current);
        if (current > $this.data('count')) {
            $this.html($this.data('count'));
        } else {
            setTimeout(function() {
                count($this)
            }, 50);
        }
    }

    window.onpopstate = function() {
        switch(location.hash) {
            case '#home':
                //alert("home");
                break
            case '#login':
                //alert("login");
                break
            default:
                //alert("def");
                location.replace("http://bslonclouds.com/");
        }
    }

    if($('#audience-map').length) {
        let markers = [];
        for(var i = 0; i < cities.length; i++) {
            let obj = {};
            let lat = cities[i].bsl_visitors_data_latitude;
            let lon = cities[i].bsl_visitors_data_longitude;
            let ctname = cities[i].bsl_visitors_data_city;
            obj["latLng"] = [lat, lon];
            obj["name"] = ctname;
            markers.push(obj);
        }

        $('#audience-map').vectorMap({
            map: 'world_mill_en',
            panOnDrag: true,
            focusOn: {
                x: 0.5,
                y: 0.5,
                scale: 1,
                animate: true
            },
            markerStyle: {
                initial: {
                    fill: '#F8E23B',
                    stroke: '#383f47'
                }
            },
            markers: markers,
        });
    }


    $(".stat-timer").each(function() {
        $(this).data('count', parseInt($(this).html(), 10));
        $(this).html('0');
        count($(this));
    });

</script>

