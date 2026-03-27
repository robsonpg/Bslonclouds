<?php
require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/container_close.php';
require_once $abs_us_root . $us_url_root . 'users/includes/page_footer.php';
require_once $abs_us_root . $us_url_root . 'app/database_layer.php';
?>

<style>
    @font-face {
        font-family: 'Aeros';
        src: url('/app/css/Aeros.ttf') format('truetype');
    }

    #bsl-footer {
        background: linear-gradient(135deg, #0f172a 0%, #1a2e4a 60%, #0c2340 100%);
        color: #94a3b8;
        font-family: 'Inter', sans-serif;
        font-size: 0.88rem;
        margin-top: 48px;
        border-top: 3px solid transparent;
        border-image: linear-gradient(90deg, #02a7e9, #68b849, #f1893a) 1;
        position: relative;
        overflow: hidden;
    }
    #bsl-footer::before {
        content: '';
        position: absolute;
        top: -80px; right: -80px;
        width: 320px; height: 320px;
        background: radial-gradient(circle, rgba(2,167,233,0.07) 0%, transparent 70%);
        pointer-events: none;
    }
    #bsl-footer .footer-inner {
        padding: 40px 0 20px;
    }

    /* Column headings */
    #bsl-footer .footer-heading {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .8px;
        color: #e2e8f0;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 7px;
    }
    #bsl-footer .footer-heading::before {
        content: '';
        display: inline-block;
        width: 12px; height: 3px;
        border-radius: 2px;
        background: linear-gradient(90deg, #02a7e9, #68b849);
        flex-shrink: 0;
    }

    /* About block */
    #bsl-footer .about-title {
        font-family: 'Aeros', serif;
        font-size: 1.15rem;
        letter-spacing: 1.5px;
        margin-bottom: 10px;
        line-height: 1.3;
    }
    #bsl-footer .about-title .c-blue   { color: #02a7e9; }
    #bsl-footer .about-title .c-green  { color: #68b849; }
    #bsl-footer .about-title .c-orange { color: #f1893a; }
    #bsl-footer .about-title .c-light  { color: #e2e8f0; }

    #bsl-footer .about-body {
        color: #64748b;
        font-size: 0.83rem;
        line-height: 1.65;
    }

    /* Sponsor logos */
    #bsl-footer .sponsor-logos {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    #bsl-footer .sponsor-logos a {
        display: inline-flex;
        align-items: center;
        background: rgba(255,255,255,0.06);
        border-radius: 8px;
        padding: 8px 14px;
        transition: background .2s;
    }
    #bsl-footer .sponsor-logos a:hover {
        background: rgba(255,255,255,0.12);
    }
    #bsl-footer .sponsor-logos img {
        height: 28px;
        width: auto;
        filter: brightness(0) invert(1);
        opacity: .75;
        transition: opacity .2s;
    }
    #bsl-footer .sponsor-logos a:hover img {
        opacity: 1;
    }

    /* CC license */
    #bsl-footer .cc-block {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #475569;
        font-size: 0.80rem;
        line-height: 1.4;
    }
    #bsl-footer .cc-block img {
        opacity: .65;
        flex-shrink: 0;
    }
    #bsl-footer .cc-block a { color: #64748b; text-decoration: underline; }
    #bsl-footer .cc-block a:hover { color: #94a3b8; }

    /* Stats + badge column */
    #bsl-footer .visitors-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(2,167,233,0.10);
        border: 1px solid rgba(2,167,233,0.20);
        border-radius: 10px;
        padding: 12px 18px;
        margin-bottom: 16px;
        width: 100%;
    }
    #bsl-footer .visitors-badge .vb-icon {
        color: #02a7e9;
        font-size: 1.2rem;
    }
    #bsl-footer .visitors-badge .vb-count {
        font-size: 1.25rem;
        font-weight: 700;
        color: #e2e8f0;
        line-height: 1;
    }
    #bsl-footer .visitors-badge .vb-label {
        font-size: 0.75rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: .5px;
    }
    #bsl-footer .sitelock-wrap {
        display: flex;
        justify-content: flex-start;
    }
    #bsl-footer .sitelock-wrap img {
        border-radius: 6px;
        opacity: .85;
        transition: opacity .2s;
        max-width: 130px;
    }
    #bsl-footer .sitelock-wrap img:hover { opacity: 1; }

    /* Divider */
    #bsl-footer .footer-divider {
        border: none;
        border-top: 1px solid rgba(255,255,255,0.07);
        margin: 24px 0 16px;
    }

    /* Bottom bar */
    #bsl-footer .footer-bottom {
        font-size: 0.78rem;
        color: #334155;
        text-align: center;
        padding-bottom: 20px;
    }
</style>

<footer id="bsl-footer">
    <div class="container footer-inner">
        <div class="row">

            <!-- About -->
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="about-title">
                    <span class="c-blue">B</span><span class="c-light">IO</span><span class="c-green">S</span><span class="c-light">PECKLE </span><span class="c-orange">L</span><span class="c-light">ASER On CLOUDS</span>
                </div>
                <p class="about-body"><?=lang("MODAL_ABOUT_MSG")?></p>
            </div>

            <!-- Sponsors + License -->
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="footer-heading"><?=lang("FOOTER_PROJECT_MSG"); ?></div>
                <div class="sponsor-logos">
                    <a href="https://www.gov.br/cnpq/pt-br" target="_blank" rel="noopener">
                        <img src="/usersc/templates/bs4/assets/images/CNPq_v2017_rgb.png" alt="CNPq"/>
                    </a>
                    <a href="https://www.rpgsoftware.com.br" target="_blank" rel="noopener">
                        <img src="/usersc/templates/bs4/assets/images/RPG_logo1.png" alt="RPG Software"/>
                    </a>
                </div>
                <div class="cc-block">
                    <a rel="license" href="https://creativecommons.org/licenses/by/4.0/">
                        <img alt="Creative Commons Attribution 4.0 International License" src="https://i.creativecommons.org/l/by/4.0/88x31.png"/>
                    </a>
                    <span><?=lang("CC_TEXT1")?><a rel="license" href="https://creativecommons.org/licenses/by/4.0/"><?=lang("CC_TEXT2")?></a>.</span>
                </div>
            </div>

            <!-- Visitors + Security -->
            <div class="col-md-4">
                <div class="footer-heading"><?=lang("FOOTER_VISITORS"); ?></div>
                <div class="visitors-badge">
                    <span class="vb-icon"><i class="fa fa-users"></i></span>
                    <div>
                        <div class="vb-count"><?=getTotalVisitors(); ?></div>
                        <div class="vb-label"><?=lang("FOOTER_VISITORS"); ?></div>
                    </div>
                </div>
                <div class="sitelock-wrap">
                    <a href="https://www.sitelock.com/verify.php?site=bslonclouds.com" target="_blank" rel="noopener">
                        <img src="https://shield.sitelock.com/shield/bslonclouds.com" alt="SiteLock Verified"/>
                    </a>
                </div>
            </div>

        </div>

        <hr class="footer-divider">

        <div class="footer-bottom">
            &copy; <?php echo date("Y"); ?> <?=htmlspecialchars($settings->copyright); ?>
        </div>
    </div>
</footer>


<?php require_once($abs_us_root.$us_url_root.'users/includes/html_footer.php');?>
