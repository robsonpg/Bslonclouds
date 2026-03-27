<?php
/*
 * BSL – Custom login view for Biospeckle Laser on Clouds
 * Overrides users/views/_login.php via usersc/views/_login.php
 *
 * All PHP variables are already set by users/login.php before this view is included:
 *   $awaitingTOTP, $totpEnabled, $allowPasswords, $showForgot, $showBottom,
 *   $bottomClass, $forgotClass, $regClass, $dest, $settings, $us_url_root,
 *   $abs_us_root, $hooks, $userspice_nonce
 */
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
@font-face { font-family: 'Aeros'; src: url('app/css/Aeros.ttf') format('truetype'); }
body { font-family: 'Inter', sans-serif; }

/* ── Page background ─────────────────────────────────── */
.bsl-login-bg {
    min-height: 60vh;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding: 24px 16px 40px;
}

/* ── Login card ──────────────────────────────────────── */
.bsl-login-card {
    width: 100%;
    max-width: 480px;
    border: none;
    border-radius: 14px;
    box-shadow: 0 6px 40px rgba(0,0,0,0.13);
    overflow: hidden;
}

/* ── Card header (mini BSL hero) ────────────────────── */
.bsl-login-header {
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0c2340 100%);
    padding: 28px 32px 22px;
    position: relative;
    overflow: hidden;
}
.bsl-login-header::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 200px; height: 200px;
    background: radial-gradient(circle, rgba(2,167,233,0.18) 0%, transparent 70%);
    pointer-events: none;
}
.bsl-brand-title {
    font-family: 'Aeros', serif;
    font-size: 1.75rem;
    font-weight: 700;
    letter-spacing: 2px;
    line-height: 1.25;
    word-break: break-word;
    margin-bottom: 6px;
}
.bsl-brand-title .c-blue  { color: #02a7e9; }
.bsl-brand-title .c-green { color: #68b849; }
.bsl-brand-title .c-orange{ color: #f1893a; }
.bsl-brand-title .c-white { color: #e2e8f0; }
.bsl-login-subtitle {
    color: #94a3b8;
    font-size: 0.88rem;
    margin-bottom: 0;
}

/* ── Card body ───────────────────────────────────────── */
.bsl-login-body {
    background: #fff;
    padding: 26px 32px 24px;
}
.bsl-login-body .form-group,
.bsl-login-body .form-outline { margin-bottom: 16px; }
.bsl-login-body label,
.bsl-login-body .form-label {
    font-size: 0.82rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 5px;
    display: block;
}
.bsl-login-body .form-control {
    border-radius: 8px;
    border: 1px solid #d1d5db;
    font-size: 0.9rem;
    padding: 9px 12px;
    transition: border-color .15s, box-shadow .15s;
    height: auto;
}
.bsl-login-body .form-control:focus {
    border-color: #02a7e9;
    box-shadow: 0 0 0 3px rgba(2,167,233,0.12);
    outline: none;
}
.bsl-login-body .input-group .form-control { border-radius: 8px 0 0 8px; }
.bsl-login-body .input-group-text.see-pw {
    border-radius: 0 8px 8px 0;
    border: 1px solid #d1d5db;
    border-left: none;
    background: #f9fafb;
    cursor: pointer;
    padding: 0 12px;
}
.bsl-login-body .input-group-text.see-pw:hover { background: #f1f5f9; }

/* ── Submit button ───────────────────────────────────── */
.btn-bsl-login {
    background: linear-gradient(135deg, #02a7e9 0%, #0284c7 100%);
    border: none;
    border-radius: 8px;
    padding: 11px;
    font-size: 0.95rem;
    font-weight: 600;
    letter-spacing: .3px;
    color: #fff;
    width: 100%;
    transition: opacity .15s, transform .1s;
}
.btn-bsl-login:hover { opacity: .9; transform: translateY(-1px); color: #fff; }
.btn-bsl-login:active { transform: translateY(0); }

/* ── TOTP / 2FA section ─────────────────────────────── */
.bsl-totp-header {
    text-align: center;
    margin-bottom: 18px;
}
.bsl-totp-header .fa { font-size: 2rem; color: #02a7e9; }
.bsl-totp-header h5 { margin-top: 8px; font-weight: 700; color: #1e3a5f; }
.bsl-totp-header p  { font-size: 0.85rem; color: #64748b; }
.bsl-totp-sep {
    border-top: 1px solid #e2e8f0;
    padding-top: 16px;
    margin-top: 16px;
}

/* ── Passkey button ─────────────────────────────────── */
.btn-bsl-passkey {
    background: #f0f9ff;
    border: 1px solid #02a7e9;
    border-radius: 8px;
    padding: 10px;
    font-size: 0.88rem;
    font-weight: 600;
    color: #02a7e9;
    width: 100%;
    transition: background .15s;
}
.btn-bsl-passkey:hover { background: #e0f2fe; color: #0284c7; }
#passkeyStatus {
    font-size: 0.82rem;
    border-radius: 8px;
    margin-top: 8px;
}

/* ── Bottom links ───────────────────────────────────── */
.bsl-login-links {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 18px;
    padding-top: 14px;
    border-top: 1px solid #f1f5f9;
}
.bsl-login-links a {
    font-size: 0.82rem;
    color: #64748b;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 5px;
    padding: 4px 0;
}
.bsl-login-links a:hover { color: #02a7e9; }
.bsl-login-links .spacer { flex: 1; }

/* ── Alerts ─────────────────────────────────────────── */
.bsl-login-body .alert { border-radius: 8px; font-size: 0.87rem; }

/* ── Logout link ────────────────────────────────────── */
.bsl-logout-link {
    display: block;
    text-align: center;
    margin-top: 14px;
    font-size: 0.8rem;
    color: #f87171;
    text-decoration: none;
}
.bsl-logout-link:hover { color: #dc2626; }

/* ── TOTP inline section ────────────────────────────── */
.totp-section {
    border-top: 1px solid #e2e8f0;
    padding-top: 14px;
    margin-top: 4px;
}
.backup-code-section {
    border-top: 1px solid #e2e8f0;
    padding-top: 14px;
    margin-top: 4px;
}
</style>

<div class="bsl-login-bg pt-3">
    <div class="bsl-login-card">

        <!-- BSL Header -->
        <div class="bsl-login-header">
            <div class="bsl-brand-title">
                <span class="c-blue">B</span><span class="c-white">IO</span><span class="c-green">S</span><span class="c-white">PECKLE </span><span class="c-orange">L</span><span class="c-white">ASER On CLOUDS</span>
            </div>
            <p class="bsl-login-subtitle">
                <?= $awaitingTOTP ? lang("2FA_VERIFY_TITLE") : lang("SIGNIN_TITLE") ?>
            </p>
        </div>

        <!-- Card body -->
        <div class="bsl-login-body">

            <?php
            // Inline messages
            $loginInlineMessages = function_exists('parseSessionMessages') ? parseSessionMessages() : [];
            $loginHasMessages = !empty($_GET['err']) || !empty($_GET['msg']) ||
                                !empty($loginInlineMessages['valErr']) || !empty($loginInlineMessages['valSuc']) ||
                                !empty($loginInlineMessages['genMsg']);

            if ($loginHasMessages):
            ?>
            <div class="mb-3">
                <?php
                if (!empty($_GET['err'])) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                    echo htmlspecialchars($_GET['err'], ENT_QUOTES, 'UTF-8');
                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
                if (!empty($_GET['msg'])) {
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo htmlspecialchars($_GET['msg'], ENT_QUOTES, 'UTF-8');
                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
                $loginAlertTypes = ['valErr' => 'danger', 'valSuc' => 'success', 'genMsg' => 'secondary'];
                foreach ($loginAlertTypes as $msgKey => $alertClass) {
                    if (!empty($loginInlineMessages[$msgKey])) {
                        echo '<div class="alert alert-' . $alertClass . ' alert-dismissible fade show" role="alert">';
                        echo $loginInlineMessages[$msgKey];
                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    }
                }
                ?>
            </div>
            <?php endif; ?>

            <?php includeHook($hooks, 'body'); ?>

            <?php if (!$awaitingTOTP && isset($settings->social_login_location) && $settings->social_login_location == 0): ?>
                <?php
                if (file_exists($abs_us_root . $us_url_root . "usersc/views/_social_logins.php")) {
                    require_once $abs_us_root . $us_url_root . "usersc/views/_social_logins.php";
                } else {
                    require_once $abs_us_root . $us_url_root . "users/views/_social_logins.php";
                }
                ?>
            <?php endif; ?>

            <?php if ($awaitingTOTP): ?>
                <!-- 2FA verification -->
                <div class="bsl-totp-header">
                    <i class="fa fa-shield fa-2x" style="color:#02a7e9"></i>
                    <h5><?= lang("2FA_VERIFY_TITLE") ?></h5>
                    <p><?= lang("2FA_VERIFY_INFO") ?></p>
                </div>

                <form name="totp-verify" method="post" id="totp-form" action="">
                    <?= tokenHere(); ?>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="totp_code"><?= lang("2FA_CODE_LABEL") ?></label>
                        <input type="text" id="totp_code" name="totp_code" class="form-control text-center"
                            required autocomplete="off" pattern="\d{6}" maxlength="6" placeholder="000000" autofocus
                            style="font-size:1.4rem;letter-spacing:6px;font-weight:600">
                        <small class="text-muted"><?= lang("2FA_VERIFY_INFO") ?></small>
                    </div>
                    <button class="btn-bsl-login" type="submit">
                        <i class="fa fa-check"></i> <?= lang("2FA_VERIFY_BTN") ?>
                    </button>
                </form>

                <div class="bsl-totp-sep">
                    <form name="backup-verify" method="post">
                        <?= tokenHere(); ?>
                        <div class="form-outline mb-3">
                            <label class="form-label" for="backup_code"><?= lang("2FA_BACKUP_CODE_LABEL") ?></label>
                            <input type="text" id="backup_code" name="totp_code" class="form-control"
                                autocomplete="off" placeholder="XXXXX-XXXXX" maxlength="11" style="text-transform:uppercase;">
                            <input type="hidden" name="use_backup_code" value="1">
                            <small class="text-muted">Enter your backup code (letters and numbers)</small>
                        </div>
                        <button class="btn btn-outline-secondary w-100" type="submit" style="border-radius:8px">
                            <i class="fa fa-key"></i> Use Backup Code
                        </button>
                    </form>
                </div>

                <a href="<?= $us_url_root ?>users/logout.php" class="bsl-logout-link">
                    <i class="fa fa-sign-out"></i> <?= lang("MENU_LOGOUT") ?>
                </a>

            <?php elseif ($allowPasswords): ?>
                <!-- Standard login form -->
                <form name="login" id="login-form" class="form-signin" method="post" action="">
                    <?= tokenHere(); ?>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="username"><?= lang("SIGNIN_UORE") ?></label>
                        <input type="text" id="username" name="username" class="form-control"
                            value="<?= isset($_POST['username']) ? safeReturn(Input::get('username')) : '' ?>"
                            required autocomplete="username" autofocus>
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label" for="password"><?= lang("SIGNIN_PASS") ?></label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control"
                                value="" autocomplete="current-password">
                            <span class="input-group-addon input-group-text see-pw" id="togglePassword">
                                <i class="fa fa-eye" id="togglePasswordIcon"></i>
                            </span>
                        </div>
                    </div>

                    <?php if ($totpEnabled): ?>
                        <div class="totp-section mb-3">
                            <div class="form-outline">
                                <label class="form-label" for="totp_code_inline">
                                    <i class="fa fa-shield" style="color:#02a7e9"></i> Authentication Code <small class="text-muted">(if enabled)</small>
                                </label>
                                <input type="text" id="totp_code_inline" name="totp_code" class="form-control"
                                    autocomplete="off" pattern="\d{6}" maxlength="6" placeholder="000000 (optional)">
                                <small class="text-muted">If you have two-factor authentication enabled, enter your 6-digit code here. Otherwise, leave blank.</small>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php includeHook($hooks, 'form'); ?>

                    <button class="btn-bsl-login submit mt-2" id="next_button" type="submit">
                        <i class="fa fa-sign-in"></i> <?= lang("SIGNIN_BUTTONTEXT") ?>
                    </button>
                </form>

                <?php if ($settings->passkeys == 1): ?>
                    <div class="mt-3">
                        <div class="d-flex align-items-center my-2">
                            <hr style="flex:1;border-color:#e2e8f0">
                            <span style="padding:0 10px;font-size:.75rem;color:#94a3b8;white-space:nowrap">OR</span>
                            <hr style="flex:1;border-color:#e2e8f0">
                        </div>
                        <button class="btn-bsl-passkey" onclick="authenticatePasskeyLogin()">
                            <i class="fa fa-key"></i> Sign in with Passkey
                        </button>
                        <div id="passkeyStatus" class="alert" style="display:none"></div>
                    </div>
                <?php endif; ?>

            <?php endif; ?>

            <?php if (!$awaitingTOTP && (!isset($settings->social_login_location) || $settings->social_login_location != 0)): ?>
                <?php
                if (file_exists($abs_us_root . $us_url_root . "usersc/views/_social_logins.php")) {
                    require_once $abs_us_root . $us_url_root . "usersc/views/_social_logins.php";
                } else {
                    require_once $abs_us_root . $us_url_root . "users/views/_social_logins.php";
                }
                includeHook($hooks, 'bottom');
                ?>
            <?php endif; ?>

            <?php if (!$awaitingTOTP && $showBottom): ?>
                <div class="bsl-login-links">
                    <?php if ($showForgot): ?>
                        <a href="<?= $us_url_root ?>users/forgot_password.php">
                            <i class="fa fa-wrench"></i> <?= lang("SIGNIN_FORGOTPASS") ?>
                        </a>
                    <?php endif; ?>
                    <span class="spacer"></span>
                    <?php if ($settings->registration == 1): ?>
                        <a href="<?= $us_url_root ?>users/join.php">
                            <i class="fa fa-plus-square"></i> <?= lang("SIGNUP_TEXT") ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </div><!-- bsl-login-body -->
    </div><!-- bsl-login-card -->
</div><!-- bsl-login-bg -->

<script nonce="<?= htmlspecialchars($userspice_nonce ?? '') ?>">
    $(document).ready(function() {
        <?php if ($awaitingTOTP): ?>
            setTimeout(function() { $('#totp_code').focus(); }, 300);
        <?php else: ?>
            setTimeout(function() { $('#username').focus(); }, 300);
        <?php endif; ?>

        <?php if ($allowPasswords): ?>
            const togglePassword     = document.querySelector('#togglePassword');
            const togglePasswordIcon = document.querySelector('#togglePasswordIcon');
            const password           = document.querySelector('#password');

            if (togglePassword && password) {
                togglePassword.addEventListener('click', function() {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    if (type === 'password') {
                        togglePasswordIcon.classList.add('fa-eye');
                        togglePasswordIcon.classList.remove('fa-eye-slash');
                    } else {
                        togglePasswordIcon.classList.add('fa-eye-slash');
                        togglePasswordIcon.classList.remove('fa-eye');
                    }
                });
            }
        <?php endif; ?>

        // Auto-format TOTP code inputs (digits only)
        const totpInputs = document.querySelectorAll('input[name="totp_code"]:not(#backup_code)');
        totpInputs.forEach(function(input) {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');
                if (this.value.length > 6) this.value = this.value.slice(0, 6);
            });
        });

        // Format backup code input
        const backupInput = document.getElementById('backup_code');
        if (backupInput) {
            backupInput.addEventListener('input', function() {
                let value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
                if (value.length > 5) value = value.slice(0, 5) + '-' + value.slice(5, 10);
                this.value = value;
            });
        }

        // Auto-submit TOTP form when 6 digits entered
        const mainTotpInput = document.getElementById('totp_code');
        if (mainTotpInput) {
            mainTotpInput.addEventListener('input', function() {
                if (this.value.length === 6) {
                    setTimeout(() => { document.getElementById('totp-form').submit(); }, 500);
                }
            });
        }
    });

    function toggleBackupForm() {
        // kept for compatibility
    }
</script>

<?php if ($settings->passkeys == 1 && !$awaitingTOTP): ?>
<script nonce="<?= htmlspecialchars($userspice_nonce ?? '') ?>">
    function showPasskeyStatus(message, type = 'info') {
        const status = document.getElementById('passkeyStatus');
        if (!status) return;
        status.textContent = message;
        status.style.display = 'block';
        status.classList.remove('alert-info', 'alert-success', 'alert-danger', 'alert-warning');
        switch (type) {
            case 'success': status.classList.add('alert-success'); break;
            case 'error':   status.classList.add('alert-danger');  break;
            case 'warning': status.classList.add('alert-warning'); break;
            default:        status.classList.add('alert-info');
        }
    }

    function arrayBufferToBase64(buffer) {
        const bytes = new Uint8Array(buffer);
        let binary = '';
        for (let i = 0; i < bytes.byteLength; i++) binary += String.fromCharCode(bytes[i]);
        return btoa(binary);
    }

    function base64ToArrayBuffer(base64) {
        try {
            const paddedBase64 = base64.padEnd(base64.length + (4 - base64.length % 4) % 4, '=');
            const binary = atob(paddedBase64);
            const bytes = new Uint8Array(binary.length);
            for (let i = 0; i < binary.length; i++) bytes[i] = binary.charCodeAt(i);
            return bytes.buffer;
        } catch (e) {
            console.error('Base64 decoding failed:', base64, e);
            throw new Error('Base64 decoding failed: ' + e.message);
        }
    }

    async function authenticatePasskeyLogin() {
        showPasskeyStatus('Requesting authentication challenge...');
        try {
            const dest = <?= json_encode($dest, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
            const challengeData = {
                action: 'auth',
                csrf: '<?= Token::generate(); ?>'
            };
            const response = await fetch('auth/parsers/passkey_parser.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(challengeData)
            });
            if (response.status !== 200) {
                const errorData = await response.json().catch(() => ({}));
                throw new Error(errorData.error || 'Failed to get auth challenge');
            }
            const publicKey = await response.json();
            if (!publicKey.success) throw new Error(publicKey.error || 'Failed to get auth challenge');

            const challengeOptions = {
                challenge: base64ToArrayBuffer(publicKey.challenge),
                rpId: publicKey.rpId,
                userVerification: publicKey.userVerification,
                timeout: publicKey.timeout
            };
            if (publicKey.allowCredentials && publicKey.allowCredentials.length > 0) {
                challengeOptions.allowCredentials = publicKey.allowCredentials.map(cred => ({
                    ...cred,
                    id: base64ToArrayBuffer(cred.id)
                }));
            }
            showPasskeyStatus('Waiting for your passkey...', 'info');
            const credential = await navigator.credentials.get({ publicKey: challengeOptions });

            const authData = {
                action: 'verify',
                csrf: '<?= Token::generate(); ?>',
                credentialId: arrayBufferToBase64(credential.rawId),
                authenticatorData: arrayBufferToBase64(credential.response.authenticatorData),
                signature: arrayBufferToBase64(credential.response.signature),
                clientDataJSON: new TextDecoder().decode(credential.response.clientDataJSON),
                dest: dest
            };
            const verifyResponse = await fetch('auth/parsers/passkey_parser.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(authData)
            });
            const result = await verifyResponse.json();
            if (result.success) {
                showPasskeyStatus('Login successful! Redirecting...', 'success');
                if (result.redirect) {
                    window.location.href = result.redirect;
                } else {
                    window.location.href = '<?= $us_url_root . $settings->redirect_uri_after_login ?>';
                }
            } else {
                showPasskeyStatus('Login failed: ' + (result.error || 'No matching passkey found or verification failed.'), 'error');
            }
        } catch (error) {
            console.error('Passkey Auth Error:', error);
            let errorMessage = 'Error: ' + error.message;
            if (error.name === 'NotAllowedError') {
                errorMessage = 'Passkey operation was cancelled or not allowed.';
            } else if (!navigator.credentials || !navigator.credentials.get) {
                errorMessage = 'Passkey authentication is not supported by your browser or platform.';
            }
            showPasskeyStatus(errorMessage, 'error');
        }
    }
</script>
<?php endif; ?>

<?php require_once $abs_us_root . $us_url_root . 'users/includes/html_footer.php'; ?>
