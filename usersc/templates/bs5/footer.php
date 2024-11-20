<?php
require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/container_close.php';
require_once $abs_us_root . $us_url_root . 'users/includes/page_footer.php';
require_once $abs_us_root . $us_url_root . 'app/database_layer.php';
?>

<footer  id="footer" class="footer mt-auto border-top bg-light pt-3">
  <div class="container">
      <div class="container">
          <div class="row">
              <div class="col-4">
                  <div role="alert" class="mt-1 alert alert-secondary fade show">
                      <h6 class="font-weight-bold"><?=lang("MODAL_ABOUT_TITLE")?></h6><br><?=lang("MODAL_ABOUT_MSG")?>
                  </div>
              </div>
              <div class="col-4 text-center">
                  <h6><?=lang("FOOTER_PROJECT_MSG"); ?></h6>
                  <a href="https://www.gov.br/cnpq/pt-br" target="_blank">
                      <img src="/usersc/templates/bs4/assets/images/CNPq_v2017_rgb.png" height="30mm"/>
                  </a>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="https://www.rpgsoftware.com.br" target="_blank">
                    <img src="/usersc/templates/bs4/assets/images/RPG_logo1.png" height="30mm" />
                  </a>
                  <br><br><br>
                  <a rel="license" href="https://creativecommons.org/licenses/by/4.0/">
                      <img alt="Creative Commons Attribution 4.0 International License" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png"/>
                  </a><br/><?=lang("CC_TEXT1")?><a rel="license" href="https://creativecommons.org/licenses/by/4.0/"><?=lang("CC_TEXT2")?></a>.
              </div>
                <div class="col-4 text-center">
                    <div class="alert alert-info">
                    <h6><?=lang("FOOTER_VISITORS");?> <?=getTotalVisitors(); ?></h6>
                </div>
                <div class="col-4">
                    <div style="text-align:center;">
                        <a href="https://www.sitelock.com/verify.php?site=bslonclouds.com">
                            <img src="https://shield.sitelock.com/shield/bslonclouds.com" alt="SiteLock" width="150%"></a>
                    </div>
                </div>
              </div>
          </div>
          <div class="row">
              <div class="col-12 text-center">
                  <footer><br>&copy;
                      <?php echo date("Y"); ?>
                      <?=$settings->copyright; ?></footer>
              </div>
          </div>
      </div>
  </div>
</footer>


<?php require_once($abs_us_root.$us_url_root.'users/includes/html_footer.php');?>
