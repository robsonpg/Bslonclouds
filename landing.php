<?php

require_once 'users/init.php';
require_once 'app/database_layer.php';

if ($user->isLoggedIn()) {
    die;
} else {
    $projects = getNumberPublicResearch();
    $researches = getNumberOfResearches();
    $public_researches = clone(getPublicResearches());

    $public_images = getNumberofPublicImages();
    // Caso queiramos usar o font awesome do site
    // <script src="https://kit.fontawesome.com/b41bdf02f7.js" crossorigin="anonymous"></script>


    // Use JSON encoded string and converts
    // it into a PHP variable
    $ip = $_SERVER['REMOTE_ADDR'];
    $visitor_data = @json_decode(file_get_contents(
        "http://www.geoplugin.net/json.gp?ip=" . $ip));

    insertDatabaseVisitorInfo($visitor_data);

    $visitors_statistics = clone(getAllDatabaseVisitorInfo());

//    echo 'Country Name: ' . $ipdat->geoplugin_countryName . "\n";
//    echo 'City Name: ' . $ipdat->geoplugin_city . "\n";
//    echo 'Continent Name: ' . $ipdat->geoplugin_continentName . "\n";
//    echo 'Latitude: ' . $ipdat->geoplugin_latitude . "\n";
//    echo 'Longitude: ' . $ipdat->geoplugin_longitude . "\n";
//    echo 'Currency Symbol: ' . $ipdat->geoplugin_currencySymbol . "\n";
//    echo 'Currency Code: ' . $ipdat->geoplugin_currencyCode . "\n";
//    echo 'Timezone: ' . $ipdat->geoplugin_timezone;


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
        <ul id="tabsJustified" class="nav nav-tabs">
            <li class="nav-item">
                <a href="" id="tab_home" data-target="#home_bsl" data-toggle="tab" class="nav-link text-uppercase active show">
                    <?=lang("TAB_HOME");?>
                </a>
            </li>
            <li class="nav-item"><a href="" id="tab_researches" data-target="#researches" data-toggle="tab" class="nav-link text-uppercase">
                    <?=lang("TAB_RESEARCHES");?>
                </a>
            </li>
            <li class="nav-item"><a href="" id="tab_tutorials" data-target="#tutorials" data-toggle="tab" class="nav-link text-uppercase">
                    <?=lang("TAB_TUTORIALS");?>
                </a>
            </li>
            <li class="nav-item"><a href="" id="tab_services" data-target="#services" data-toggle="tab" class="nav-link text-uppercase">
                    <?=lang("TAB_SERVICES");?>
                </a>
            </li>
        </ul>
        <br>
        <div id="tabsJustifiedContent" class="tab-content">
            <div id="home_bsl" class="tab-pane fade active show">
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
                </div><!-- end row -->
                <div class="row">
                    <div class="col-md-12">
                        <div role="alert" class="alert alert-success">
                            <span class="text-success font-weight-bold"><?=lang("NUMBER_OF_PUBLIC_IMAGES");?></span>
                            <span class="font-weight-bold stat-timer badge badge-success float-right" ><?=$public_images;?></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <div role="alert" class="alert alert-success">
                            <div  class="text-success font-weight-bold">
                                <a style="color: #02a7e9; font-family: 'Aeros',serif">B</a>
                                <a style="color: #68b849; font-family: 'Aeros',serif">S</a>
                                <a style="color: #f1893a; font-family: 'Aeros',serif">L</a>&nbsp;<?=lang("AROUND_WORLD");?></div>
                        </div>
                        <table class="table table-hover table-sm alert-primary">
                            <thead>
                            <tr>
                                <th><?=lang("GEN_COUNTRY");?></th>
                                <th><?=lang("GEN_CITY");?></th>
                                <th><?=lang("GEN_CONTINENT");?></th>
                                <th class="text-right"><?=lang("GEN_VISITORS");?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($visitors_statistics->count() > 0) {
                                foreach ($visitors_statistics->results() as $visitor) {
                            ?>
                                <tr>
                                    <td><?=$visitor->bsl_visitors_data_country;?></td>
                                    <td><?=$visitor->bsl_visitors_data_city;?></td>
                                    <td><?=$visitor->bsl_visitors_data_continent;?></td>
                                    <td class="text-right font-weight-bold"><?=$visitor->bsl_visitors_data_city_count;?></td>
                                </tr>
                            <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- end row -->
                <div class="row">
                    <div class="col">
                        <ul id="tabsJustified" class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="" data-target="#researches" data-toggle="tab" onclick="changeTabtoResearch()"
                                   class="badge badge-info text-uppercase"><?=lang("CLICK_TO_RESEARCH");?>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul id="tabsJustified1" class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="" data-target="#tutorials" data-toggle="tab" onclick="changeTabtoTutorial()"
                                   class="badge badge-info text-uppercase"><?=lang("CLICK_TO_TUTORIALS");?>
                                </a>
                            </li>
                        </ul>
                    </div><!-- end col -->
                    <div class="col">
                        <ul id="tabsJustified2" class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="" data-target="#services" data-toggle="tab" onclick="changeTabtoServices()"
                                   class="badge badge-info text-uppercase"><?=lang("CLICK_TO_SERVICES");?>
                                </a>
                            </li>
                        </ul>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div>
            <div id="researches" class="tab-pane fade">
                <div class="row">
                    <div class="col-md-12">
                        <div role="alert" class="alert alert-success">
                            <h4 class="alert-heading" style="font-family: 'Aeros',serif"><a style="color: #02a7e9">
                                    B</a>IO<a style="color: #68b849">S</a>PECKLE <a style="color: #f1893a">L<a>ASER On CLOUDS</h4>
                            <h4><?=lang("RESEARCHES_TEXT"); ?></h4>
                        </div>
                    </div>
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
                ?>
            </div> <!-- tab pane -->
            <div id="tutorials" class="tab-pane fade">
                <div class="row">
                    <div class="col-md-12">
                        <div role="alert" class="alert alert-success">
                            <h4 class="alert-heading" style="font-family: 'Aeros',serif"><a style="color: #02a7e9">
                                    B</a>IO<a style="color: #68b849">S</a>PECKLE <a style="color: #f1893a">L<a>ASER On CLOUDS</h4>
                            <h4><?=lang("TUTORIALS_TEXT"); ?></h4>
                        </div>
                    </div>
                </div>
            </div> <!-- tab pane -->
            <div id="services" class="tab-pane fade">
                <div class="row">
                    <div class="col-md-12">
                        <div role="alert" class="alert alert-success">
                            <h4 class="alert-heading" style="font-family: 'Aeros',serif"><a style="color: #02a7e9">
                                    B</a>IO<a style="color: #68b849">S</a>PECKLE <a style="color: #f1893a">L<a>ASER On CLOUDS</h4>
                            <h4><?=lang("SERVICES_TEXT"); ?></h4>
                        </div>
                    </div>
                </div>
            </div> <!-- tab pane -->
        </div> <!-- tab content -->
    </div> <!-- col class -->
</div> <!-- row -->


</body>
<script>
    function changeTabtoResearch() {
        let tab_elem = document.getElementById("tab_researches");
        tab_elem.className = "nav-link text-uppercase active show";
        let tab_elem1 = document.getElementById("tab_home");
        tab_elem1.className = "nav-link text-uppercase";
        let tab_elem2 = document.getElementById("home_bsl");
        tab_elem2.className = "tab-pane fade";
        let tab_elem3 = document.getElementById("researches");
        tab_elem3.className = "tab-pane fade active show";
    }
    function changeTabtoTutorial() {
        let tab_elem = document.getElementById("tab_tutorials");
        tab_elem.className = "nav-link text-uppercase active show";
        let tab_elem1 = document.getElementById("tab_home");
        tab_elem1.className = "nav-link text-uppercase";
        let tab_elem2 = document.getElementById("home_bsl");
        tab_elem2.className = "tab-pane fade";
        let tab_elem3 = document.getElementById("tutorials");
        tab_elem3.className = "tab-pane fade active show";
    }
    function changeTabtoServices() {
        let tab_elem = document.getElementById("tab_services");
        tab_elem.className = "nav-link text-uppercase active show";
        let tab_elem1 = document.getElementById("tab_home");
        tab_elem1.className = "nav-link text-uppercase";
        let tab_elem2 = document.getElementById("home_bsl");
        tab_elem2.className = "tab-pane fade";
        let tab_elem3 = document.getElementById("services");
        tab_elem3.className = "tab-pane fade active show";
    }
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