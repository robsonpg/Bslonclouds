<?php
/*
 * BSL – Custom forgot-password "email sent" confirmation view
 * Override for users/views/_forgot_password_sent.php
 *
 * Variables available (set by users/forgot_password.php):
 *   $settings (->reset_vericode_expiry), $us_url_root, $abs_us_root
 */
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
@font-face { font-family: 'Aeros'; src: url('app/css/Aeros.ttf') format('truetype'); }

.bsl-fps-bg {
    min-height: 55vh;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding: 28px 16px 48px;
    font-family: 'Inter', sans-serif;
}

.bsl-fps-card {
    width: 100%;
    max-width: 460px;
    border: none;
    border-radius: 14px;
    box-shadow: 0 6px 40px rgba(0,0,0,0.13);
    overflow: hidden;
}

/* ── Header ──────────────────────────────────────────── */
.bsl-fps-header {
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0c2340 100%);
    padding: 26px 32px 20px;
    position: relative;
    overflow: hidden;
}
.bsl-fps-header::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 180px; height: 180px;
    background: radial-gradient(circle, rgba(104,184,73,0.18) 0%, transparent 70%);
    pointer-events: none;
}
.bsl-brand-title-fps {
    font-family: 'Aeros', serif;
    font-size: 1.65rem;
    font-weight: 700;
    letter-spacing: 2px;
    word-break: break-word;
    line-height: 1.25;
    margin-bottom: 6px;
}
.bsl-brand-title-fps .c-blue  { color: #02a7e9; }
.bsl-brand-title-fps .c-green { color: #68b849; }
.bsl-brand-title-fps .c-orange{ color: #f1893a; }
.bsl-brand-title-fps .c-white { color: #e2e8f0; }
.bsl-fps-subtitle { color: #94a3b8; font-size: 0.88rem; margin-bottom: 0; }

/* ── Body ────────────────────────────────────────────── */
.bsl-fps-body {
    background: #fff;
    padding: 30px 32px 28px;
    text-align: center;
    font-family: 'Inter', sans-serif;
}
.bsl-fps-icon {
    width: 64px;
    height: 64px;
    background: linear-gradient(135deg, #68b849, #4a9e34);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 18px;
    box-shadow: 0 4px 16px rgba(104,184,73,0.3);
}
.bsl-fps-icon .fa { font-size: 1.6rem; color: #fff; }
.bsl-fps-body h5 {
    font-weight: 700;
    color: #1e3a5f;
    font-size: 1.05rem;
    margin-bottom: 10px;
}
.bsl-fps-body p {
    font-size: 0.88rem;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 0;
}
.bsl-fps-body .bsl-expiry-note {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #fff7ed;
    border: 1px solid #fed7aa;
    border-radius: 8px;
    padding: 8px 14px;
    font-size: 0.82rem;
    color: #92400e;
    margin-top: 16px;
}
.bsl-fps-body .bsl-expiry-note .fa { color: #f1893a; }
.bsl-fps-back {
    display: flex;
    justify-content: center;
    margin-top: 22px;
    padding-top: 16px;
    border-top: 1px solid #f1f5f9;
}
.bsl-fps-back a {
    font-size: 0.82rem;
    color: #64748b;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 5px;
}
.bsl-fps-back a:hover { color: #02a7e9; }
</style>

<div class="bsl-fps-bg pt-3">
    <div class="bsl-fps-card">

        <!-- Header -->
        <div class="bsl-fps-header">
            <div class="bsl-brand-title-fps">
                <span class="c-blue">B</span><span class="c-white">IO</span><span class="c-green">S</span><span class="c-white">PECKLE </span><span class="c-orange">L</span><span class="c-white">ASER On CLOUDS</span>
            </div>
            <p class="bsl-fps-subtitle">
                <i class="fa fa-check-circle"></i> <?= lang("PW_RESET") ?>
            </p>
        </div>

        <!-- Body -->
        <div class="bsl-fps-body">

            <div class="bsl-fps-icon">
                <i class="fa fa-envelope"></i>
            </div>

            <h5><?= lang("VER_SENT_TITLE") ?? "Check your inbox" ?></h5>
            <p><?= lang("VER_SENT") ?><?= $settings->reset_vericode_expiry ?> <?= lang("T_MINUTES") ?>.</p>

            <div class="bsl-expiry-note">
                <i class="fa fa-clock-o"></i>
                <?= lang("T_MINUTES_NOTE") ?? "Link expires in" ?> <strong><?= $settings->reset_vericode_expiry ?></strong> <?= lang("T_MINUTES") ?>
            </div>

            <div class="bsl-fps-back">
                <a href="<?= $us_url_root ?>users/login.php">
                    <i class="fa fa-arrow-left"></i> <?= lang("SIGNIN_TITLE") ?>
                </a>
            </div>

        </div><!-- bsl-fps-body -->
    </div><!-- bsl-fps-card -->
</div><!-- bsl-fps-bg -->
