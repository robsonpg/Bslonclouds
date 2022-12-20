<?php

require_once 'users/init.php';
require_once 'app/database_layer.php';

if ($user->isLoggedIn()) {
    die;
} else {
    $projects = getNumberPublicResearch();
    $researches = getNumberOfResearches();
    $public_researches = getPublicResearches();
    // Caso queiramos usar o font awesome do site
    // <script src="https://kit.fontawesome.com/b41bdf02f7.js" crossorigin="anonymous"></script>

?>
<style>
    @font-face {
    font-family: 'Aeros';
    src: url('app/css/Aeros.ttf') format('truetype');
    }
</style>

<body>
    <div class="row">
        <div class="col-md-12">
            <div role="alert" class="alert alert-success">
                <h4 class="alert-heading" style="font-family: 'Aeros',serif"><a style="color: #02a7e9">
                        B</a>IO<a style="color: #68b849">S</a>PECKLE <a style="color: #f1893a">L<a>ASER On CLOUDS</h4>
                        <?=lang("WELCOME_MSG"); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h4 class="mt-2">
            <div role="alert" class="mt-1 alert alert-primary fade show">
                <div class="stat-count">
                    <span class="text-success font-weight-bold"><?=lang("LAND_PUBLISHED");?></span>
                    <span class="font-weight-bold stat-timer badge badge-success float-right" ><?=$projects;?></span>
                </div><!-- stat-count -->
            </div>
            </h4>
        </div>
        <div class="col">
            <h4 class="mt-2">
            <div role="alert" class="mt-1 alert alert-primary fade show">
                <div class="stat-count">
                    <span class="text-success font-weight-bold"><?=lang("LAND_RESEARCHES");?></span>
                    <span class="font-weight-bold stat-timer badge badge-success float-right" ><?=$researches;?></span>
                </div><!-- stat-count -->
            </div>
            </h4>
        </div><!-- end col -->
    </div>
    <?php
    if ($public_researches->count() > 0) {
        foreach ($public_researches->results() as $research) {
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
                                <div class="col text-center text-sm-left">
                                    <h5><span class="text-muted">Research: <?=$research->bsl_sample_data_unique_id;?></span></h5>
                                    <span class="text-muted">Researcher Name: <?=$research->lname . ', ' . $research->fname; ?></span>
                                    <br>
                                    <span class="badge badge-success">Country: <?=$research->locale; ?></span>
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
    } else {

    }
    ?>
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

    $(".stat-timer").each(function() {
        $(this).data('count', parseInt($(this).html(), 10));
        $(this).html('0');
        count($(this));
    });
</script>


<?php } ?>