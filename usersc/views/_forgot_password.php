<?php
/*
 * BSL – Custom forgot-password form view
 * Override for users/views/_forgot_password.php
 *
 * Variables available (set by users/forgot_password.php):
 *   $errors, $settings, $em, $us_url_root, $abs_us_root, $hooks, $userspice_nonce
 */
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
@font-face { font-family: 'Aeros'; src: url('app/css/Aeros.ttf') format('truetype'); }

.bsl-fp-bg {
    min-height: 55vh;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding: 28px 16px 48px;
    font-family: 'Inter', sans-serif;
}

.bsl-fp-card {
    width: 100%;
    max-width: 460px;
    border: none;
    border-radius: 14px;
    box-shadow: 0 6px 40px rgba(0,0,0,0.13);
    overflow: hidden;
}

/* ── Header ──────────────────────────────────────────── */
.bsl-fp-header {
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0c2340 100%);
    padding: 26px 32px 20px;
    position: relative;
    overflow: hidden;
}
.bsl-fp-header::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 180px; height: 180px;
    background: radial-gradient(circle, rgba(2,167,233,0.18) 0%, transparent 70%);
    pointer-events: none;
}
.bsl-brand-title {
    font-family: 'Aeros', serif;
    font-size: 1.65rem;
    font-weight: 700;
    letter-spacing: 2px;
    word-break: break-word;
    line-height: 1.25;
    margin-bottom: 6px;
}
.bsl-brand-title .c-blue  { color: #02a7e9; }
.bsl-brand-title .c-green { color: #68b849; }
.bsl-brand-title .c-orange{ color: #f1893a; }
.bsl-brand-title .c-white { color: #e2e8f0; }
.bsl-fp-subtitle { color: #94a3b8; font-size: 0.88rem; margin-bottom: 0; }

/* ── Body ────────────────────────────────────────────── */
.bsl-fp-body {
    background: #fff;
    padding: 26px 32px 24px;
}
.bsl-fp-body .bsl-info-row {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    background: #f0f9ff;
    border: 1px solid #bae6fd;
    border-radius: 10px;
    padding: 12px 14px;
    margin-bottom: 20px;
}
.bsl-fp-body .bsl-info-row .fa {
    color: #02a7e9;
    margin-top: 2px;
    flex-shrink: 0;
}
.bsl-fp-body .bsl-info-row p {
    font-size: 0.84rem;
    color: #334155;
    margin: 0;
    line-height: 1.5;
}
.bsl-fp-body label {
    font-size: 0.82rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 5px;
    display: block;
}
.bsl-fp-body .form-control {
    border-radius: 8px;
    border: 1px solid #d1d5db;
    font-size: 0.9rem;
    padding: 9px 12px;
    transition: border-color .15s, box-shadow .15s;
    font-family: 'Inter', sans-serif;
    height: auto;
}
.bsl-fp-body .form-control:focus {
    border-color: #02a7e9;
    box-shadow: 0 0 0 3px rgba(2,167,233,0.12);
    outline: none;
}

/* ── Submit button ───────────────────────────────────── */
.btn-bsl-fp {
    background: linear-gradient(135deg, #02a7e9 0%, #0284c7 100%);
    border: none;
    border-radius: 8px;
    padding: 11px;
    font-size: 0.95rem;
    font-weight: 600;
    letter-spacing: .3px;
    color: #fff;
    width: 100%;
    margin-top: 6px;
    transition: opacity .15s, transform .1s;
    font-family: 'Inter', sans-serif;
}
.btn-bsl-fp:hover { opacity: .9; transform: translateY(-1px); color: #fff; }
.btn-bsl-fp:active { transform: translateY(0); }

/* ── Bottom link ─────────────────────────────────────── */
.bsl-fp-back {
    display: flex;
    justify-content: center;
    margin-top: 18px;
    padding-top: 14px;
    border-top: 1px solid #f1f5f9;
}
.bsl-fp-back a {
    font-size: 0.82rem;
    color: #64748b;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 5px;
}
.bsl-fp-back a:hover { color: #02a7e9; }

/* ── Alerts ──────────────────────────────────────────── */
.bsl-fp-body .alert { border-radius: 8px; font-size: 0.87rem; }
</style>

<div class="bsl-fp-bg pt-3">
    <div class="bsl-fp-card">

        <!-- Header -->
        <div class="bsl-fp-header">
            <div class="bsl-brand-title">
                <span class="c-blue">B</span><span class="c-white">IO</span><span class="c-green">S</span><span class="c-white">PECKLE </span><span class="c-orange">L</span><span class="c-white">ASER On CLOUDS</span>
            </div>
            <p class="bsl-fp-subtitle">
                <i class="fa fa-lock"></i> <?= lang("PW_RESET") ?>
            </p>
        </div>

        <!-- Body -->
        <div class="bsl-fp-body">

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger mb-3">
                    <?php display_errors($errors); ?>
                </div>
            <?php endif; ?>

            <div class="bsl-info-row">
                <i class="fa fa-info-circle"></i>
                <p><?= lang("VER_INS") ?></p>
            </div>

            <form action="" method="post" id="pwReset">
                <input type="hidden" name="csrf" value="<?= Token::generate(); ?>">

                <div class="form-group mb-4">
                    <label for="email"><?= lang("GEN_EMAIL") ?></label>
                    <input type="email" name="email" id="email"
                        placeholder="<?= lang("GEN_EMAIL") ?>"
                        class="form-control"
                        value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : '' ?>"
                        autofocus autocomplete="email" required>
                </div>

                <button type="submit" name="forgotten_password" class="btn-bsl-fp">
                    <i class="fa fa-paper-plane"></i> <?= lang("GEN_RESET") ?>
                </button>
            </form>

            <div class="bsl-fp-back">
                <a href="<?= $us_url_root ?>users/login.php">
                    <i class="fa fa-arrow-left"></i> <?= lang("SIGNIN_TITLE") ?>
                </a>
            </div>

        </div><!-- bsl-fp-body -->
    </div><!-- bsl-fp-card -->
</div><!-- bsl-fp-bg -->
