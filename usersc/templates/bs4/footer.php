<?php
require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/container_close.php'; //custom template container

require_once $abs_us_root . $us_url_root . 'users/includes/page_footer.php';

?>

<script type="text/javascript">
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
<script>
  var $hamburger = $(".hamburger");
  $hamburger.on("click", function(e) {
    $hamburger.toggleClass("is-active");
    // Do something else, like open/close menu
  });
</script>
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
// (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
// function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
// e=o.createElement(i);r=o.getElementsByTagName(i)[0];
// e.src='//www.google-analytics.com/analytics.js';
// r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
// ga('create','G-6X7KGD0GZZ','auto');ga('send','pageview');
</script>

<div class="container">
        <div class="row">
            <div class="col-2 text-center">
            </div>
            <div class="col-2 text-center">
            </div>
            <div class="col-4 text-center">
                <h6><?=lang("FOOTER_PROJECT_MSG"); ?></h6>
                <img src="/usersc/templates/bs4/assets/images/CNPq_v2017_rgb.png" height="30mm" />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <img src="/usersc/templates/bs4/assets/images/RPG_logo1.png" height="30mm" />
            </div>
            <div class="col-2 text-center">
            </div>
            <div class="col-2 text-center">
                <span class="badge badge-pill badge-primary">
                <?=lang("FOOTER_VISITORS");?> <?=getTotalVisitors(); ?>
                </span>
            </div>
        </div>
        <div class="row">
                <div class="col-12 text-center">
                        <footer><br>&copy;
                          <?php echo date("Y"); ?>
                           <?=$settings->copyright; ?></footer>
                        <br>
                </div>
        </div>
</div>
<?php require_once($abs_us_root.$us_url_root.'users/includes/html_footer.php');?>
