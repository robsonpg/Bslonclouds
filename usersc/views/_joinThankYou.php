<?php
/*
 * BSL – Registration thank-you view (no email verification required)
 * Override for users/views/_joinThankYou.php
 *
 * Variables available: $settings (->site_name), $us_url_root, $abs_us_root
 */
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
@font-face { font-family: 'Aeros'; src: url('app/css/Aeros.ttf') format('truetype'); }

.bsl-ty-bg {
    min-height: 55vh;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding: 28px 16px 56px;
    font-family: 'Inter', sans-serif;
}
.bsl-ty-card {
    width: 100%;
    max-width: 480px;
    border: none;
    border-radius: 14px;
    box-shadow: 0 6px 40px rgba(0,0,0,0.13);
    overflow: hidden;
}

/* ── Header ──────────────────────────────────────────── */
.bsl-ty-header {
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0c2340 100%);
    padding: 28px 32px 22px;
    position: relative;
    overflow: hidden;
}
.bsl-ty-header::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 200px; height: 200px;
    background: radial-gradient(circle, rgba(104,184,73,0.22) 0%, transparent 70%);
    pointer-events: none;
}
.bsl-ty-brand {
    font-family: 'Aeros', serif;
    font-size: 1.65rem;
    font-weight: 700;
    letter-spacing: 2px;
    word-break: break-word;
    line-height: 1.25;
    margin-bottom: 6px;
}
.bsl-ty-brand .c-blue  { color: #02a7e9; }
.bsl-ty-brand .c-green { color: #68b849; }
.bsl-ty-brand .c-orange{ color: #f1893a; }
.bsl-ty-brand .c-white { color: #e2e8f0; }
.bsl-ty-subtitle { color: #94a3b8; font-size: 0.88rem; margin-bottom: 0; }

/* ── Body ────────────────────────────────────────────── */
.bsl-ty-body {
    background: #fff;
    padding: 32px 32px 28px;
    text-align: center;
    font-family: 'Inter', sans-serif;
}
.bsl-ty-icon-wrap {
    width: 72px;
    height: 72px;
    background: linear-gradient(135deg, #68b849, #4a9e34);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    box-shadow: 0 6px 20px rgba(104,184,73,0.35);
}
.bsl-ty-icon-wrap .fa { font-size: 1.8rem; color: #fff; }
.bsl-ty-body h4 {
    font-weight: 700;
    color: #1e3a5f;
    font-size: 1.15rem;
    margin-bottom: 8px;
}
.bsl-ty-body p {
    font-size: 0.9rem;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 0;
}
.btn-bsl-ty {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #02a7e9 0%, #0284c7 100%);
    border: none;
    border-radius: 9px;
    padding: 11px 32px;
    font-size: 0.95rem;
    font-weight: 600;
    color: #fff;
    text-decoration: none;
    margin-top: 24px;
    transition: opacity .15s, transform .1s;
}
.btn-bsl-ty:hover { opacity: .9; transform: translateY(-1px); color: #fff; text-decoration: none; }
.btn-bsl-ty:active { transform: translateY(0); }
</style>

<div class="bsl-ty-bg pt-3">
    <div class="bsl-ty-card">

        <!-- Header -->
        <div class="bsl-ty-header">
            <div class="bsl-ty-brand">
                <span class="c-blue">B</span><span class="c-white">IO</span><span class="c-green">S</span><span class="c-white">PECKLE </span><span class="c-orange">L</span><span class="c-white">ASER On CLOUDS</span>
            </div>
            <p class="bsl-ty-subtitle">
                <i class="fa fa-check-circle"></i> <?= lang("JOIN_SUC") ?><?= htmlspecialchars($settings->site_name, ENT_QUOTES, 'UTF-8') ?>
            </p>
        </div>

        <!-- Body -->
        <div class="bsl-ty-body">
            <div class="bsl-ty-icon-wrap">
                <i class="fa fa-check"></i>
            </div>

            <h4><?= lang("JOIN_SUC") ?><?= htmlspecialchars($settings->site_name, ENT_QUOTES, 'UTF-8') ?></h4>
            <p><?= lang("JOIN_THANKS") ?></p>

            <a href="<?= $us_url_root ?>users/login.php" class="btn-bsl-ty">
                <i class="fa fa-sign-in"></i> <?= lang("SIGNIN_TEXT") ?>
            </a>
        </div>

    </div>
</div>
