<?php
/*
 * BSL – Registration thank-you view (email verification required)
 * Override for users/views/_joinThankYou_verify.php
 *
 * Variables available: $settings (->site_name, ->join_vericode_expiry), $us_url_root, $abs_us_root
 */
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
@font-face { font-family: 'Aeros'; src: url('app/css/Aeros.ttf') format('truetype'); }

.bsl-tyv-bg {
    min-height: 55vh;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding: 28px 16px 56px;
    font-family: 'Inter', sans-serif;
}
.bsl-tyv-card {
    width: 100%;
    max-width: 480px;
    border: none;
    border-radius: 14px;
    box-shadow: 0 6px 40px rgba(0,0,0,0.13);
    overflow: hidden;
}

/* ── Header ──────────────────────────────────────────── */
.bsl-tyv-header {
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0c2340 100%);
    padding: 28px 32px 22px;
    position: relative;
    overflow: hidden;
}
.bsl-tyv-header::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 200px; height: 200px;
    background: radial-gradient(circle, rgba(2,167,233,0.2) 0%, transparent 70%);
    pointer-events: none;
}
.bsl-tyv-brand {
    font-family: 'Aeros', serif;
    font-size: 1.65rem;
    font-weight: 700;
    letter-spacing: 2px;
    word-break: break-word;
    line-height: 1.25;
    margin-bottom: 6px;
}
.bsl-tyv-brand .c-blue  { color: #02a7e9; }
.bsl-tyv-brand .c-green { color: #68b849; }
.bsl-tyv-brand .c-orange{ color: #f1893a; }
.bsl-tyv-brand .c-white { color: #e2e8f0; }
.bsl-tyv-subtitle { color: #94a3b8; font-size: 0.88rem; margin-bottom: 0; }

/* ── Body ────────────────────────────────────────────── */
.bsl-tyv-body {
    background: #fff;
    padding: 32px 32px 28px;
    text-align: center;
    font-family: 'Inter', sans-serif;
}
.bsl-tyv-icon-wrap {
    width: 72px;
    height: 72px;
    background: linear-gradient(135deg, #02a7e9, #0284c7);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    box-shadow: 0 6px 20px rgba(2,167,233,0.35);
}
.bsl-tyv-icon-wrap .fa { font-size: 1.8rem; color: #fff; }
.bsl-tyv-body h4 {
    font-weight: 700;
    color: #1e3a5f;
    font-size: 1.15rem;
    margin-bottom: 8px;
}
.bsl-tyv-body p {
    font-size: 0.9rem;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 0;
}
.bsl-tyv-expiry {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #fff7ed;
    border: 1px solid #fed7aa;
    border-radius: 8px;
    padding: 8px 16px;
    font-size: 0.82rem;
    color: #92400e;
    margin-top: 18px;
}
.bsl-tyv-expiry .fa { color: #f1893a; }
.bsl-tyv-resend {
    margin-top: 20px;
    padding-top: 18px;
    border-top: 1px solid #f1f5f9;
}
.bsl-tyv-resend a {
    font-size: 0.82rem;
    color: #64748b;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}
.bsl-tyv-resend a:hover { color: #02a7e9; }
</style>

<div class="bsl-tyv-bg pt-3">
    <div class="bsl-tyv-card">

        <!-- Header -->
        <div class="bsl-tyv-header">
            <div class="bsl-tyv-brand">
                <span class="c-blue">B</span><span class="c-white">IO</span><span class="c-green">S</span><span class="c-white">PECKLE </span><span class="c-orange">L</span><span class="c-white">ASER On CLOUDS</span>
            </div>
            <p class="bsl-tyv-subtitle">
                <i class="fa fa-envelope"></i> <?= lang("JOIN_SUC") ?><?= htmlspecialchars($settings->site_name, ENT_QUOTES, 'UTF-8') ?>
            </p>
        </div>

        <!-- Body -->
        <div class="bsl-tyv-body">
            <div class="bsl-tyv-icon-wrap">
                <i class="fa fa-envelope"></i>
            </div>

            <h4><?= lang("JOIN_SUC") ?><?= htmlspecialchars($settings->site_name, ENT_QUOTES, 'UTF-8') ?></h4>
            <p><?= lang("VER_RES_SUC") ?><?= (int)$settings->join_vericode_expiry ?> <?= lang("T_HOURS") ?>.</p>

            <div class="bsl-tyv-expiry">
                <i class="fa fa-clock-o"></i>
                <?= lang("T_HOURS_NOTE") ?? "Link expires in" ?> <strong><?= (int)$settings->join_vericode_expiry ?></strong> <?= lang("T_HOURS") ?>
            </div>

            <div class="bsl-tyv-resend">
                <a href="<?= $us_url_root ?>users/verify_resend.php">
                    <i class="fa fa-refresh"></i> <?= lang("VER_RESEND") ?? "Resend verification email" ?>
                </a>
            </div>
        </div>

    </div>
</div>
