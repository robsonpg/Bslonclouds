<?php

require_once 'users/init.php';
require_once 'app/database_layer.php';
require_once 'app/constants.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

    $visitors_statistics = clone(getAllDatabaseVisitorInfo());

?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    @font-face {
        font-family: 'Aeros';
        src: url('app/css/Aeros.ttf') format('truetype');
    }

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
        max-width: 780px;
        line-height: 1.6;
        margin-bottom: 0;
    }

    /* ── Content Card ─────────────────────────────────────── */
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
        padding: 24px 28px;
    }

    /* ── Info Message ─────────────────────────────────────── */
    .bsl-info-card {
        border-left: 4px solid #02a7e9;
        border-radius: 0 10px 10px 0;
        background: #f0f9ff;
        padding: 18px 22px;
        color: #1e3a5f;
        font-size: 0.94rem;
        line-height: 1.7;
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
</style>

<body>
<div class="container-fluid px-0 pt-3">

    <!-- Hero Banner -->
    <div class="bsl-hero">
        <div class="row align-items-center">
            <div class="col-md-10">
                <div class="bsl-hero-title">
                    <span class="c-blue">B</span><span class="c-white">IO</span><span class="c-green">S</span><span class="c-white">PECKLE </span><span class="c-orange">L</span><span class="c-white">ASER On CLOUDS</span>
                </div>
                <p class="bsl-hero-subtitle"><?=lang("BLOGS_TEXT"); ?></p>
            </div>
        </div>
    </div>

    <!-- Info -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card bsl-card">
                <div class="card-body">
                    <div class="bsl-info-card">
                        <?=lang("TUTORIALS_MSG"); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php
    require_once $abs_us_root . $us_url_root . 'users/includes/html_footer.php';
?>
</body>
<script>
    window.onpopstate = function() {
        switch(location.hash) {
            case '#home':
                break;
            case '#login':
                break;
            default:
                location.replace("http://bslonclouds.com/");
        }
    }
</script>
