<?php

require_once 'users/init.php';
require_once 'app/database_layer.php';
require_once 'app/constants.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

    $projects = getNumberPublicResearch();
    $researches = getNumberOfResearches();
    $public_researches = clone(getPublicResearches());

    $public_images = getNumberofPublicImages();
    // Caso queiramos usar o font awesome do site
    // <script src="https://kit.fontawesome.com/b41bdf02f7.js" crossorigin="anonymous"></script>

    $ip = $_SERVER['REMOTE_ADDR'];
    logger("","Visitor","Visit from $ip.");

    $visitor_data = @json_decode(@file_get_contents(
        "http://www.geoplugin.net/json.gp?ip=" . $ip));

    insertDatabaseVisitorInfo($visitor_data);

    $visitors_statistics = clone(getAllDatabaseVisitorInfo());
    $countries_statistics = clone(getCountryTotals());

    $user_img_name_public_researches = clone(getImagesAndNamesPublicResearches());

//    echo 'Country Name: ' . $ipdat->geoplugin_countryName . "\n";
//    echo 'City Name: ' . $ipdat->geoplugin_city . "\n";
//    echo 'Continent Name: ' . $ipdat->geoplugin_continentName . "\n";
//    echo 'Latitude: ' . $ipdat->geoplugin_latitude . "\n";
//    echo 'Longitude: ' . $ipdat->geoplugin_longitude . "\n";
//    echo 'Currency Symbol: ' . $ipdat->geoplugin_currencySymbol . "\n";
//    echo 'Currency Code: ' . $ipdat->geoplugin_currencyCode . "\n";
//    echo 'Timezone: ' . $ipdat->geoplugin_timezone;
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    @font-face {
        font-family: 'Aeros';
        src: url('app/css/Aeros.ttf') format('truetype');
    }

    /* ── Base ─────────────────────────────────────────────── */
    body { font-family: 'Inter', sans-serif; }

    /* ── Hero Banner ──────────────────────────────────────── */
    .bsl-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0c2340 100%);
        border-radius: 12px;
        padding: 40px 36px 32px;
        margin-bottom: 28px;
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
    .bsl-hero::after {
        content: '';
        position: absolute;
        bottom: -40px; left: 25%;
        width: 200px; height: 200px;
        background: radial-gradient(circle, rgba(104,184,73,0.1) 0%, transparent 70%);
        pointer-events: none;
    }
    .bsl-hero-title {
        font-family: 'Aeros', serif;
        font-size: 2.2rem;
        font-weight: 700;
        letter-spacing: 2px;
        margin-bottom: 10px;
        line-height: 1.2;
    }
    .bsl-hero-title .c-blue  { color: #02a7e9; }
    .bsl-hero-title .c-green { color: #68b849; }
    .bsl-hero-title .c-orange{ color: #f1893a; }
    .bsl-hero-title .c-white { color: #e2e8f0; }
    .bsl-hero-subtitle {
        color: #94a3b8;
        font-size: 0.95rem;
        max-width: 680px;
        line-height: 1.6;
        margin-bottom: 0;
    }

    /* ── Stat Cards ───────────────────────────────────────── */
    .bsl-stat-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .bsl-stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.13);
    }
    .bsl-stat-card .card-body {
        padding: 22px 24px;
    }
    .bsl-stat-card .stat-accent {
        display: block;
        height: 4px;
        border-radius: 4px 4px 0 0;
    }
    .accent-blue   { background: linear-gradient(90deg, #02a7e9, #0284c7); }
    .accent-green  { background: linear-gradient(90deg, #68b849, #4ade80); }
    .accent-orange { background: linear-gradient(90deg, #f1893a, #fb923c); }

    .bsl-stat-card .stat-icon {
        width: 46px; height: 46px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
    }
    .icon-blue   { background: rgba(2,167,233,0.12); color: #02a7e9; }
    .icon-green  { background: rgba(104,184,73,0.12); color: #68b849; }
    .icon-orange { background: rgba(241,137,58,0.12); color: #f1893a; }

    .bsl-stat-card .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1;
        margin-bottom: 2px;
    }
    .bsl-stat-card .stat-label {
        color: #64748b;
        font-size: 0.82rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: .5px;
        margin: 0;
    }
    .bsl-stat-card .stat-delta {
        font-size: 0.78rem;
        font-weight: 600;
        padding: 2px 7px;
        border-radius: 20px;
        margin-left: 8px;
    }
    .delta-up { background: rgba(74,222,128,0.15); color: #16a34a; }

    /* ── Content Cards ────────────────────────────────────── */
    .bsl-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 16px rgba(0,0,0,0.07);
    }
    .bsl-card .card-header {
        background: transparent;
        border-bottom: 1px solid #f1f5f9;
        padding: 16px 20px 12px;
        font-weight: 600;
        font-size: 0.88rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: .6px;
    }
    .bsl-card .card-body {
        padding: 18px 20px;
    }

    /* ── Article Link ─────────────────────────────────────── */
    .article-link {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 14px;
        border-radius: 8px;
        background: #f8fafc;
        text-decoration: none;
        transition: background .15s;
        color: #1e293b;
    }
    .article-link:hover {
        background: #e0f2fe;
        color: #0284c7;
        text-decoration: none;
    }
    .article-link .article-icon {
        width: 38px; height: 38px;
        background: rgba(2,167,233,0.1);
        color: #02a7e9;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    .article-link .article-text {
        font-size: 0.88rem;
        font-weight: 500;
        line-height: 1.4;
    }

    /* ── Auto-scrolling image strip (replaces <marquee>) ──── */
    .scroll-strip-wrapper {
        overflow: hidden;
        width: 100%;
        position: relative;
    }
    .scroll-strip-wrapper::before,
    .scroll-strip-wrapper::after {
        content: '';
        position: absolute;
        top: 0; bottom: 0;
        width: 40px;
        z-index: 2;
        pointer-events: none;
    }
    .scroll-strip-wrapper::before { left: 0;  background: linear-gradient(to right, #fff, transparent); }
    .scroll-strip-wrapper::after  { right: 0; background: linear-gradient(to left,  #fff, transparent); }
    .scroll-strip {
        display: flex;
        align-items: center;
        gap: 16px;
        width: max-content;
        animation: scroll-strip 22s linear infinite;
    }
    .scroll-strip:hover { animation-play-state: paused; }
    @keyframes scroll-strip {
        0%   { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .scroll-strip .strip-item {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #f8fafc;
        border-radius: 8px;
        padding: 6px 10px;
        white-space: nowrap;
        font-size: 0.82rem;
        color: #475569;
        font-weight: 500;
    }
    .scroll-strip .strip-item img {
        height: 40px;
        width: 40px;
        object-fit: cover;
        border-radius: 6px;
    }

    /* ── CTA Section ──────────────────────────────────────── */
    .bsl-cta-card {
        border: none;
        border-radius: 12px;
        padding: 28px 28px;
        position: relative;
        overflow: hidden;
    }
    .bsl-cta-card.cta-join {
        background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 100%);
        color: #fff;
    }
    .bsl-cta-card.cta-analysis {
        background: linear-gradient(135deg, #064e3b 0%, #065f46 100%);
        color: #fff;
    }
    .bsl-cta-card::after {
        content: '';
        position: absolute;
        bottom: -30px; right: -30px;
        width: 120px; height: 120px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
        pointer-events: none;
    }
    .bsl-cta-card h5 {
        font-weight: 600;
        font-size: 1.05rem;
        margin-bottom: 6px;
    }
    .bsl-cta-card p {
        font-size: 0.85rem;
        opacity: .75;
        margin-bottom: 16px;
    }
    .bsl-cta-btn {
        display: inline-block;
        padding: 9px 22px;
        border-radius: 8px;
        font-size: 0.88rem;
        font-weight: 600;
        text-decoration: none;
        transition: opacity .15s, transform .15s;
    }
    .bsl-cta-btn:hover { opacity: .9; transform: translateY(-1px); text-decoration: none; }
    .btn-cyan  { background: #02a7e9; color: #fff; }
    .btn-green { background: #68b849; color: #fff; }

    /* ── Stats Section ────────────────────────────────────── */
    .bsl-section-title {
        font-size: 0.82rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .7px;
        color: #64748b;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .bsl-section-title::before {
        content: '';
        display: inline-block;
        width: 14px; height: 3px;
        border-radius: 2px;
        background: linear-gradient(90deg, #02a7e9, #68b849);
    }

    .bsl-table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        font-size: 0.86rem;
    }
    .bsl-table thead th {
        background: #f8fafc;
        color: #64748b;
        font-weight: 600;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: .5px;
        padding: 10px 14px;
        border: none;
    }
    .bsl-table thead th:first-child { border-radius: 8px 0 0 0; }
    .bsl-table thead th:last-child  { border-radius: 0 8px 0 0; }
    .bsl-table tbody tr { transition: background .12s; }
    .bsl-table tbody tr:hover { background: #f0f9ff; }
    .bsl-table td {
        padding: 9px 14px;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        vertical-align: middle;
    }
    .bsl-table td.visitors-count {
        text-align: right;
        font-weight: 700;
        color: #02a7e9;
    }

    /* ── Map ──────────────────────────────────────────────── */
    .vector-map {
        width: 100%;
        height: 320px;
        border-radius: 10px;
        overflow: hidden;
    }

    /* ── Divider ──────────────────────────────────────────── */
    .bsl-divider {
        border: none;
        border-top: 1px solid #e2e8f0;
        margin: 24px 0;
    }
</style>

    <link rel="stylesheet" href="app/css/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="app/js/jvectormap/jquery-jvectormap-2.0.5.css" type="text/css" media="screen"/>
    <script src="app/js/jvectormap/jquery-jvectormap-2.0.5.min.js"></script>
    <script src="app/js/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script>
        let cities = <?php echo json_encode($visitors_statistics->results()); ?>;
    </script>

<body>
<div class="container-fluid px-0 pt-3" id="home_bsl">

    <!-- Hero Banner -->
    <div class="bsl-hero">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="bsl-hero-title">
                    <span class="c-blue">B</span><span class="c-white">IO</span><span class="c-green">S</span><span class="c-white">PECKLE </span><span class="c-orange">L</span><span class="c-white">ASER On CLOUDS</span>
                </div>
                <p class="bsl-hero-subtitle"><?=lang("WELCOME_MSG"); ?></p>
            </div>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="row mb-4">
        <div class="col-sm-4 mb-3 mb-sm-0">
            <div class="card bsl-stat-card h-100">
                <span class="stat-accent accent-blue"></span>
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="d-flex align-items-baseline">
                            <span class="stat-value stat-timer"><?=$projects;?></span>
                            <span class="stat-delta delta-up">+11%</span>
                        </div>
                        <p class="stat-label"><?=lang("LAND_PUBLISHED");?></p>
                    </div>
                    <div class="stat-icon icon-blue"><i class="fa fa-book"></i></div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mb-3 mb-sm-0">
            <div class="card bsl-stat-card h-100">
                <span class="stat-accent accent-green"></span>
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="d-flex align-items-baseline">
                            <span class="stat-value stat-timer"><?=$researches;?></span>
                            <span class="stat-delta delta-up">+11%</span>
                        </div>
                        <p class="stat-label"><?=lang("LAND_RESEARCHES");?></p>
                    </div>
                    <div class="stat-icon icon-green"><i class="fa fa-users"></i></div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card bsl-stat-card h-100">
                <span class="stat-accent accent-orange"></span>
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="d-flex align-items-baseline">
                            <span class="stat-value stat-timer"><?=$public_images;?></span>
                            <span class="stat-delta delta-up">+12.4%</span>
                        </div>
                        <p class="stat-label"><?=lang("NUMBER_OF_PUBLIC_IMAGES");?></p>
                    </div>
                    <div class="stat-icon icon-orange"><i class="fa fa-file-image-o"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Articles + Research Strip -->
    <div class="row mb-4">
        <div class="col-md-5 mb-3 mb-md-0">
            <div class="card bsl-card h-100">
                <div class="card-header"><?=lang("PUBLISHED_ARTICLES");?></div>
                <div class="card-body">
                    <a class="article-link" target="_blank" href="https://riojournal.com/article/114736/">
                        <div class="article-icon"><i class="fa fa-newspaper-o"></i></div>
                        <span class="article-text"><?=lang("ARTICLE1");?></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card bsl-card h-100">
                <div class="card-header"><?=lang("LAND_PUBLISHED");?></div>
                <div class="card-body d-flex align-items-center" style="min-height:80px;">
                    <div class="scroll-strip-wrapper">
                        <div class="scroll-strip" id="research-strip">
                        <?php
                            if ($user_img_name_public_researches->count() > 0) {
                                $strip_items = '';
                                foreach ($user_img_name_public_researches->results() as $research_item) {
                                    $sn = htmlspecialchars($research_item->bsl_sample_data_name);
                                    $image_data = $research_item->bsl_sample_data_cover_image;
                                    if ($image_data === null) {
                                        $filename = '../images/default.bmp';
                                        $fp = fopen($filename, "r");
                                        $filesize = filesize($filename);
                                        if ($fp) {
                                            $content = fread($fp, $filesize);
                                            fclose($fp);
                                            $image_data = base64_encode($content);
                                        }
                                    }
                                    $strip_items .= '<div class="strip-item"><img src="data:image/jpeg;base64,' . $image_data . '" alt="' . $sn . '"/>' . $sn . '</div>';
                                }
                                echo $strip_items . $strip_items;
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Banners -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3 mb-md-0">
            <div class="bsl-cta-card cta-join">
                <h5>Join for free and explore cool datasets!</h5>
                <p>Access public biospeckle laser research data from around the world.</p>
                <a href="usersc/join.php" class="bsl-cta-btn btn-cyan">Sign up now!</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="bsl-cta-card cta-analysis">
                <h5>Get started with free online analysis</h5>
                <p>Run biospeckle analysis directly in your browser &mdash; no software required.</p>
                <a href="usersc/join.php" class="bsl-cta-btn btn-green">Sign up now!</a>
            </div>
        </div>
    </div>

    <!-- BSL Statistics + Map -->
    <hr class="bsl-divider">
    <div class="row mb-4">
        <div class="col-md-5 mb-3 mb-md-0">
            <div class="bsl-section-title">
                <span style="font-family:'Aeros',serif;color:#02a7e9">B</span><span style="font-family:'Aeros',serif;color:#68b849">S</span><span style="font-family:'Aeros',serif;color:#f1893a">L</span>&nbsp;<?=lang("AROUND_WORLD");?>
            </div>
            <div class="card bsl-card">
                <div class="card-body p-0">
                    <table class="bsl-table">
                        <thead>
                            <tr>
                                <th><?=lang("GEN_COUNTRY");?></th>
                                <th><?=lang("GEN_CONTINENT");?></th>
                                <th style="text-align:right"><?=lang("GEN_VISITORS");?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($countries_statistics->count() > 0) {
                            foreach ($countries_statistics->results() as $visitor) {
                                $key = array_search($visitor->bsl_visitors_data_country, CI_COUNTRIES_ARRAY);
                                $icon_name = strtolower($key);
                        ?>
                            <tr>
                                <td><i class="flag-icon flag-icon-<?=$icon_name?>"></i>&nbsp;&nbsp;<?=$visitor->bsl_visitors_data_country;?></td>
                                <td><?=$visitor->bsl_visitors_data_continent;?></td>
                                <td class="visitors-count" datatype="<?=$visitor->bsl_visitors_data_city;?>"><?=$visitor->count;?></td>
                            </tr>
                        <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="bsl-section-title">&nbsp;</div>
            <div class="card bsl-card">
                <div class="card-body p-2">
                    <div id="audience-map" class="vector-map"></div>
                </div>
            </div>
        </div>
    </div>

</div>

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
            }, 10);
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


