<?php

require_once 'users/init.php';
require_once 'app/database_layer.php';
require_once 'app/constants.php';

if ($user->isLoggedIn()) {
    die;
} else {
    $projects = getNumberPublicResearch();
    $researches = getNumberOfResearches();
    $public_researches = clone(getPublicResearches());

    $public_images = getNumberofPublicImages();
    // Caso queiramos usar o font awesome do site
    // <script src="https://kit.fontawesome.com/b41bdf02f7.js" crossorigin="anonymous"></script>

    $ip = $_SERVER['REMOTE_ADDR'];
    $ip = '177.66.50.134';
    $visitor_data = @json_decode(file_get_contents(
        "http://www.geoplugin.net/json.gp?ip=" . $ip));

    insertDatabaseVisitorInfo($visitor_data);

    $visitors_statistics = clone(getAllDatabaseVisitorInfo());
    $countries_statistics = clone(getCountryTotals());

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
    .vector-map {
        width: 100%;
        height: 300px; }
</style>

    <link rel="stylesheet" href="app/css/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="app/js/jvectormap/jquery-jvectormap-2.0.5.css" type="text/css" media="screen"/>
    <script src="app/js/jvectormap/jquery-jvectormap-2.0.5.min.js"></script>
    <script src="app/js/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script>
        let cities = <?php echo json_encode($visitors_statistics->results()); ?>;
    </script>

<body>
<div class="row">
    <div class="col-md-12">
        <ul id="tabsJustified" class="nav nav-tabs">
            <li class="nav-item">
                <a href="" id="tab_home" data-target="#home_bsl" data-toggle="tab" class="nav-link small text-uppercase active show">
                    <?=lang("TAB_HOME");?>
                </a>
            </li>
            <li class="nav-item"><a href="" id="tab_researches" data-target="#researches" data-toggle="tab" class="nav-link small text-uppercase">
                    <?=lang("TAB_RESEARCHES");?>
                </a>
            </li>
            <li class="nav-item"><a href="" id="tab_tutorials" data-target="#tutorials" data-toggle="tab" class="nav-link small text-uppercase">
                    <?=lang("TAB_TUTORIALS");?>
                </a>
            </li>
            <li class="nav-item"><a href="" id="tab_services" data-target="#services" data-toggle="tab" class="nav-link small text-uppercase">
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
                    <div class="col-sm-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="d-flex align-items-center align-self-start">
                                            <h3 class="mb-0 stat-timer"><?=$projects;?></h3>
                                            <p class="text-success ml-2 mb-0 font-weight-medium">+11%</p>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="icon icon-box-success ">
                                            <h3><i class="fa fa-book float-right"></i></h3>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="text-muted font-weight-bold"><?=lang("LAND_PUBLISHED");?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="d-flex align-items-center align-self-start">
                                            <h3 class="mb-0 stat-timer"><?=$researches;?></h3>
                                            <p class="text-success ml-2 mb-0 font-weight-medium">+11%</p>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="icon icon-box-success">
                                            <h3><i class="fa fa-users float-right"></i></h3>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="text-muted font-weight-normal"><?=lang("LAND_RESEARCHES");?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="d-flex align-items-center align-self-start">
                                            <h3 class="mb-0 stat-timer"><?=$public_images;?></h3>
                                            <p class="text-sucess ml-2 mb-0 font-weight-medium">+12.4%</p>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="icon icon-box-danger">
                                            <h3><i class="fa fa-file-image-o float-right"></i></h3>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="text-muted font-weight-normal"><?=lang("NUMBER_OF_PUBLIC_IMAGES");?></h6>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-5">
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
                                <th><?=lang("GEN_CONTINENT");?></th>
                                <th class="text-right"><?=lang("GEN_VISITORS");?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($countries_statistics->count() > 0) {
                                // Para totalizar as visitas por país
                                foreach ($countries_statistics->results() as $visitor) {
                                    // Busca o nome da bandeira
                                    $key = array_search($visitor->bsl_visitors_data_country, CI_COUNTRIES_ARRAY);
                                    $icon_name = strtolower($key);
                            ?>
                                <tr>
                                    <td id="country_name">
                                        <i class="flag-icon flag-icon-<?=$icon_name?>"></i>&nbsp&nbsp<?=$visitor->bsl_visitors_data_country;?>
                                    </td>
                                    <td><?=$visitor->bsl_visitors_data_continent;?></td>
                                    <td id="country_visitors" datatype="<?=$visitor->bsl_visitors_data_city;?>" class="text-right font-weight-bold">
                                        <?=$visitor->count;?>
                                    </td>
                                </tr>
                            <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-7"><!-- mapa -->
                        <div id="audience-map" class="vector-map"></div>
                    </div>
                </div><!-- end row -->
                <br>
                <div class="row">
                    <div class="col">
                        <div role="alert" class="alert alert-success">
                            <div class="row">
                                <div class="col-4">
                                    <button class="btn btn-success mr-1">
                                        <a href="" data-target="#researches" data-toggle="tab" onclick="changeTabtoResearch()"
                                           class="text-uppercase" style="color: whitesmoke"><?=lang("CLICK_TO_RESEARCH");?>
                                        </a>
                                    </button>
                                </div>
                                <div class="col">
                                    <button class="btn btn-success mr-1">
                                        <a href="" data-target="#tutorials" data-toggle="tab" onclick="changeTabtoTutorial()"
                                           class="text-uppercase" style="color: whitesmoke"><?=lang("CLICK_TO_TUTORIALS");?>
                                        </a>
                                    </button>
                                </div><!-- end col -->
                                <div class="col">
                                    <button class="btn btn-success mr-1">
                                        <a href="" data-target="#services" data-toggle="tab" onclick="changeTabtoServices()"
                                           class="text-uppercase" style="color: whitesmoke"><?=lang("CLICK_TO_SERVICES");?>
                                        </a>
                                    </button>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div>
                    </div>
                </div>
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
        tab_elem.className = "nav-link small text-uppercase active show";
        let tab_elem1 = document.getElementById("tab_home");
        tab_elem1.className = "nav-link small text-uppercase";
        let tab_elem2 = document.getElementById("home_bsl");
        tab_elem2.className = "tab-pane fade";
        let tab_elem3 = document.getElementById("researches");
        tab_elem3.className = "tab-pane fade active show";
    }
    function changeTabtoTutorial() {
        let tab_elem = document.getElementById("tab_tutorials");
        tab_elem.className = "nav-link small text-uppercase active show";
        let tab_elem1 = document.getElementById("tab_home");
        tab_elem1.className = "nav-link small text-uppercase";
        let tab_elem2 = document.getElementById("home_bsl");
        tab_elem2.className = "tab-pane fade";
        let tab_elem3 = document.getElementById("tutorials");
        tab_elem3.className = "tab-pane fade active show";
    }
    function changeTabtoServices() {
        let tab_elem = document.getElementById("tab_services");
        tab_elem.className = "nav-link small text-uppercase active show";
        let tab_elem1 = document.getElementById("tab_home");
        tab_elem1.className = "nav-link small text-uppercase";
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


<?php } ?>