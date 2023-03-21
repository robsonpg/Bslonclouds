<?php

require_once 'users/init.php';
require_once 'app/database_layer.php';
require_once 'app/constants.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

    $visitors_statistics = clone(getAllDatabaseVisitorInfo());

?>

<style>
    @font-face {
    font-family: 'Aeros';
    src: url('app/css/Aeros.ttf') format('truetype');
    }
    .vector-map {
        width: 100%;
        height: 300px;
    }

    .noselect {
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-tap-highlight-color: transparent;
    }

    button {

        cursor: pointer;
        border: none;

        color: rgb(45, 73, 56);
        font-size: 20px;
        border-radius: 4px;
        box-shadow: inset 0px 3px 5px rgba(60, 112, 182, 0.5), 0px 0px 10px rgba(0,0,0,0.15);
        background: rgb(2,0,36);
        background: linear-gradient(45deg, rgba(2,0,36,0) 5%, rgba(255,255,255,.5) 6%, rgba(255,255,255,0) 9%, rgba(255,255,255,.5) 10%, rgba(255,255,255,0) 17%, rgba(255,255,255,.5) 19%, rgba(255,255,255,0) 21%);
        background-size: 150%;
        background-position: right;
        transition: 1s;
    }

    button:hover {
        background-position: left;
        color: #96af9e;
        box-shadow: inset 0px 3px 5px rgba(255,255,255,1), 0px 0px 10px rgba(0,0,0,0.25);
    }

    button:focus {
        outline: none;
    }

    .float{
        position:fixed;
        width:15mm;
        height: 15mm;
        bottom:40px;
        right:40px;
        background-color:#0C9;
        color:#FFF;
        border-radius:50px;
        text-align:center;
        box-shadow: 2px 2px 3px #999;
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
<div class="row">
    <div class="col-md-12">
        <br>
        <div id="tabsJustifiedContent" class="tab-content">
            <div id="tutorials">
                <div class="row">
                    <div class="col-md-12">
                        <div role="alert" class="alert alert-success">
                            <h4 class="alert-heading" style="font-family: 'Aeros',serif"><a style="color: #02a7e9">
                                    B</a>IO<a style="color: #68b849">S</a>PECKLE <a style="color: #f1893a">L<a>ASER On CLOUDS</h4>
                            <h6><?=lang("BLOGS_TEXT"); ?></h6>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div role="alert" class="alert alert-warning">
                            <h6><?=lang("TUTORIALS_MSG"); ?></h6>
                        </div>
                    </div>
                </div>
            </div> <!-- tab pane -->
        </div> <!-- tab content -->
    </div> <!-- col class -->
</div> <!-- row -->

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


