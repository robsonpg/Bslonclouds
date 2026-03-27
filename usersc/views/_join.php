<?php
/*
This is a user-facing page
UserSpice 5
An Open Source PHP User Management System
by the UserSpice Team at http://UserSpice.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

Special thanks to John Bovey for the password strenth feature.
*/
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
@font-face { font-family: 'Aeros'; src: url('app/css/Aeros.ttf') format('truetype'); }

body { font-family: 'Inter', sans-serif; }

/* ── Preserved classes ───────────────────────────── */
.gray_out_icon {
    -webkit-filter: grayscale(100%);
    filter: grayscale(100%);
}
.gray_out_text { opacity: .5; }
.req-star { color: #e74c3c; font-weight: bold; margin-left: 2px; }

/* ── Join card wrapper ───────────────────────────── */
.bsl-join-card {
    border: none;
    border-radius: 14px;
    box-shadow: 0 4px 32px rgba(0,0,0,0.12);
    overflow: hidden;
    margin-bottom: 40px;
}

/* ── Card header (mini hero) ─────────────────────── */
.bsl-join-header {
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0c2340 100%);
    padding: 28px 32px 22px;
    position: relative;
    overflow: hidden;
}
.bsl-join-header::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 220px; height: 220px;
    background: radial-gradient(circle, rgba(2,167,233,0.18) 0%, transparent 70%);
    pointer-events: none;
}
.bsl-hero-title {
    font-family: 'Aeros', serif;
    font-size: 1.8rem;
    font-weight: 700;
    letter-spacing: 2px;
    line-height: 1.3;
    margin-bottom: 6px;
    word-break: break-word;
}
.bsl-hero-title .c-blue  { color: #02a7e9; }
.bsl-hero-title .c-green { color: #68b849; }
.bsl-hero-title .c-orange{ color: #f1893a; }
.bsl-hero-title .c-white { color: #e2e8f0; }
.bsl-join-subtitle {
    color: #94a3b8;
    font-size: 0.9rem;
    margin-bottom: 0;
}

/* ── Card body ───────────────────────────────────── */
.bsl-join-body {
    background: #fff;
    padding: 28px 32px 24px;
}

/* ── Form fields ─────────────────────────────────── */
.bsl-join-body .form-group { margin-bottom: 18px; }
.bsl-join-body label {
    font-size: 0.82rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 5px;
    display: block;
}
.bsl-join-body .form-control,
.bsl-join-body select.form-control {
    border-radius: 8px;
    border: 1px solid #d1d5db;
    font-size: 0.9rem;
    padding: 8px 12px;
    transition: border-color .15s, box-shadow .15s;
}
.bsl-join-body .form-control:focus {
    border-color: #02a7e9;
    box-shadow: 0 0 0 3px rgba(2,167,233,0.12);
    outline: none;
}

/* ── Password strength panel ─────────────────────── */
.pw-strength-panel {
    background: #f8fafc;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 0.82rem;
    color: #374151;
}
.pw-strength-panel strong {
    display: block;
    margin-bottom: 8px;
    font-size: 0.8rem;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: .4px;
}
.pw-strength-row {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 5px;
}
.pw-show-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: 8px;
    font-size: 0.82rem;
    color: #02a7e9;
    text-decoration: none;
    cursor: pointer;
}
.pw-show-link:hover { color: #0284c7; text-decoration: none; }

/* ── Checkboxes ──────────────────────────────────── */
.bsl-check-row {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 14px;
    border-radius: 8px;
    background: #f8fafc;
    margin-bottom: 10px;
}
.bsl-check-row input[type=checkbox] {
    width: 1.15em; height: 1.15em;
    accent-color: #02a7e9;
    flex-shrink: 0;
}
.bsl-check-row label {
    font-size: 0.86rem;
    margin-bottom: 0;
    font-weight: 500;
    color: #374151;
}

/* ── Submit button ───────────────────────────────── */
.bsl-join-body .btn-submit-bsl {
    background: linear-gradient(135deg, #02a7e9 0%, #0284c7 100%);
    border: none;
    border-radius: 8px;
    padding: 12px;
    font-size: 0.95rem;
    font-weight: 600;
    letter-spacing: .3px;
    transition: opacity .15s, transform .1s;
}
.bsl-join-body .btn-submit-bsl:hover { opacity: .9; transform: translateY(-1px); }
.bsl-join-body .btn-submit-bsl:active { transform: translateY(0); }

/* ── Error display ───────────────────────────────── */
.bsl-join-body .alert { border-radius: 8px; font-size: 0.88rem; }
</style>

<div class="row justify-content-center pt-3">
  <div class="col-lg-7 col-md-9 col-sm-12">
    <div class="bsl-join-card">

      <!-- BSL Header -->
      <div class="bsl-join-header">
        <div class="bsl-hero-title">
          <span class="c-blue">B</span><span class="c-white">IO</span><span class="c-green">S</span><span class="c-white">PECKLE </span><span class="c-orange">L</span><span class="c-white">ASER On CLOUDS</span>
        </div>
        <p class="bsl-join-subtitle"><?php echo lang('SIGNUP_TEXT', ''); ?></p>
      </div>

      <div class="bsl-join-body">
        <?php
        if (!$form_valid && Input::exists()) {?>
          <?php if (!$validation->errors() == '') {
              display_errors($validation->errors());
          } ?>
        <?php }
        includeHook($hooks, 'body');
?>

        <form class="form-signup" action="" method="<?php echo $form_method; ?>" id="payment-form">

          <div class="form-group">
        <label id="username-label"><?php echo lang('GEN_UNAME'); ?><span class="req-star">*</span></label>
        <span id="usernameCheck" class="small"></span>

        <input type="text" class="form-control" id="username" name="username" placeholder="<?php echo lang('GEN_UNAME'); ?>"
        value="<?php if (!$form_valid && !empty($_POST)) {
            echo $username;
        } ?>"
        required autofocus autocomplete="username">
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="fname" id="fname-label"><?php echo lang('GEN_FNAME'); ?><span class="req-star">*</span></label>
            <input type="text" class="form-control" id="fname" name="fname" placeholder="<?php echo lang('GEN_FNAME'); ?>" value="<?php if (!$form_valid && !empty($_POST)) {
                echo $fname;
            } ?>"
            required autofocus autocomplete="first-name">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="lname" id="lname-label"><?php echo lang('GEN_LNAME'); ?><span class="req-star">*</span></label>
            <input type="text" class="form-control" id="lname" name="lname" placeholder="<?php echo lang('GEN_LNAME'); ?>"
                   value="<?php if (!$form_valid && !empty($_POST)) {
                       echo $lname;
                   } ?>"
            required autocomplete="family-name">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="email" id="email-label"><?php echo lang('GEN_EMAIL'); ?><span class="req-star">*</span></label>

        <input  class="form-control" type="text" name="email" id="email" placeholder="<?php echo lang('GEN_EMAIL'); ?>"
                value="<?php if (!$form_valid && !empty($_POST)) {
                    echo $email;
                } ?>"
        required autocomplete="email">
      </div>

        <div class="form-group">
            <label for="country" id="country-label"><?php echo lang('GEN_COUNTRY'); ?><span class="req-star">*</span></label>

            <select name="country" class="form-control" id="country" required>
                <option value="" label="Select a country ... ">Select a country ... </option>
                <optgroup id="country-optgroup-Africa" label="Africa">
                    <option value="Algeria">Algeria</option>
                    <option value="Angola">Angola</option>
                    <option value="Benin">Benin</option>
                    <option value="Botswana">Botswana</option>
                    <option value="Burkina Faso">Burkina Faso</option>
                    <option value="Burundi">Burundi</option>
                    <option value="Cameroon">Cameroon</option>
                    <option value="Cape Verde">Cape Verde</option>
                    <option value="Central African Republic">Central African Republic</option>
                    <option value="Chad">Chad</option>
                    <option value="Comoros">Comoros</option>
                    <option value="Congo - Brazzaville">Congo - Brazzaville</option>
                    <option value="Congo - Kinshasa">Congo - Kinshasa</option>
                    <option value="Côte d’Ivoire">Côte d’Ivoire</option>
                    <option value="Djibouti">Djibouti</option>
                    <option value="Egypt">Egypt</option>
                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                    <option value="Eritrea">Eritrea</option>
                    <option value="Ethiopia">Ethiopia</option>
                    <option value="Gabon">Gabon</option>
                    <option value="Gambia">Gambia</option>
                    <option value="Ghana">Ghana</option>
                    <option value="Guinea">Guinea</option>
                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                    <option value="Kenya">Kenya</option>
                    <option value="Lesotho">Lesotho</option>
                    <option value="Liberia">Liberia</option>
                    <option value="Libya">Libya</option>
                    <option value="Madagascar">Madagascar</option>
                    <option value="Malawi">Malawi</option>
                    <option value="Mali">Mali</option>
                    <option value="Mauritania">Mauritania</option>
                    <option value="Mauritius">Mauritius</option>
                    <option value="Mayotte">Mayotte</option>
                    <option value="Morocco">Morocco</option>
                    <option value="Mozambique">Mozambique</option>
                    <option value="Namibia">Namibia</option>
                    <option value="Niger">Niger</option>
                    <option value="Nigeria">Nigeria</option>
                    <option value="Rwanda">Rwanda</option>
                    <option value="Réunion">Réunion</option>
                    <option value="Saint Helena">Saint Helena</option>
                    <option value="Senegal">Senegal</option>
                    <option value="Seychelles">Seychelles</option>
                    <option value="Sierra Leone">Sierra Leone</option>
                    <option value="Somalia">Somalia</option>
                    <option value="South Africa">South Africa</option>
                    <option value="Sudan">Sudan</option>
                    <option value="Swaziland">Swaziland</option>
                    <option value="São Tomé and Príncipe">São Tomé and Príncipe</option>
                    <option value="Tanzania">Tanzania</option>
                    <option value="Togo">Togo</option>
                    <option value="Tunisia">Tunisia</option>
                    <option value="Uganda">Uganda</option>
                    <option value="Western Sahara">Western Sahara</option>
                    <option value="Zambia">Zambia</option>
                    <option value="Zimbabwe">Zimbabwe</option>
                </optgroup>
                <optgroup id="country-optgroup-Americas" label="Americas">
                    <option value="Anguilla">Anguilla</option>
                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Aruba">Aruba</option>
                    <option value="Bahamas">Bahamas</option>
                    <option value="Barbados">Barbados</option>
                    <option value="Belize">Belize</option>
                    <option value="Bermuda">Bermuda</option>
                    <option value="Bolivia">Bolivia</option>
                    <option value="Brazil">Brazil</option>
                    <option value="British Virgin Islands">British Virgin Islands</option>
                    <option value="Canada">Canada</option>
                    <option value="Cayman Islands">Cayman Islands</option>
                    <option value="Chile">Chile</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Costa Rica">Costa Rica</option>
                    <option value="Cuba">Cuba</option>
                    <option value="Dominica">Dominica</option>
                    <option value="Dominican Republic">Dominican Republic</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Falkland Islands">Falkland Islands</option>
                    <option value="French Guiana">French Guiana</option>
                    <option value="Greenland">Greenland</option>
                    <option value="Grenada">Grenada</option>
                    <option value="Guadeloupe">Guadeloupe</option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Guyana">Guyana</option>
                    <option value="Haiti">Haiti</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Jamaica">Jamaica</option>
                    <option value="Martinique">Martinique</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Montserrat">Montserrat</option>
                    <option value="Netherlands Antilles">Netherlands Antilles</option>
                    <option value="Nicaragua">Nicaragua</option>
                    <option value="Panama">Panama</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Peru">Peru</option>
                    <option value="Puerto Rico">Puerto Rico</option>
                    <option value="Saint Barthélemy">Saint Barthélemy</option>
                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                    <option value="Saint Lucia">Saint Lucia</option>
                    <option value="Saint Martin">Saint Martin</option>
                    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                    <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                    <option value="Suriname">Suriname</option>
                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                    <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                    <option value="U.S. Virgin Islands">U.S. Virgin Islands</option>
                    <option value="United States">United States</option>
                    <option value="Uruguay">Uruguay</option>
                    <option value="Venezuela">Venezuela</option>
                </optgroup>
                <optgroup id="country-optgroup-Asia" label="Asia">
                    <option value="Afghanistan">Afghanistan</option>
                    <option value="Armenia">Armenia</option>
                    <option value="Azerbaijan">Azerbaijan</option>
                    <option value="Bahrain">Bahrain</option>
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="Bhutan">Bhutan</option>
                    <option value="Brunei">Brunei</option>
                    <option value="Cambodia">Cambodia</option>
                    <option value="China">China</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Hong Kong SAR China">Hong Kong SAR China</option>
                    <option value="India">India</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="Iran">Iran</option>
                    <option value="Iraq">Iraq</option>
                    <option value="Israel">Israel</option>
                    <option value="Japan">Japan</option>
                    <option value="Jordan">Jordan</option>
                    <option value="Kazakhstan">Kazakhstan</option>
                    <option value="Kuwait">Kuwait</option>
                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                    <option value="Laos">Laos</option>
                    <option value="Lebanon">Lebanon</option>
                    <option value="Macau SAR China">Macau SAR China</option>
                    <option value="Malaysia">Malaysia</option>
                    <option value="Maldives">Maldives</option>
                    <option value="Mongolia">Mongolia</option>
                    <option value="Myanmar [Burma]">Myanmar [Burma]</option>
                    <option value="Nepal">Nepal</option>
                    <option value="Neutral Zone">Neutral Zone</option>
                    <option value="North Korea">North Korea</option>
                    <option value="Oman">Oman</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="Palestinian Territories">Palestinian Territories</option>
                    <option value="People's Democratic Republic of Yemen">People's Democratic Republic of Yemen</option>
                    <option value="Philippines">Philippines</option>
                    <option value="Qatar">Qatar</option>
                    <option value="Saudi Arabia">Saudi Arabia</option>
                    <option value="Singapore">Singapore</option>
                    <option value="South Korea">South Korea</option>
                    <option value="Sri Lanka">Sri Lanka</option>
                    <option value="Syria">Syria</option>
                    <option value="Taiwan">Taiwan</option>
                    <option value="Tajikistan">Tajikistan</option>
                    <option value="Thailand">Thailand</option>
                    <option value="Timor-Leste">Timor-Leste</option>
                    <option value="Turkey">Turkey</option>
                    <option value="Turkmenistan">Turkmenistan</option>
                    <option value="United Arab Emirates">United Arab Emirates</option>
                    <option value="Uzbekistan">Uzbekistan</option>
                    <option value="Vietnam">Vietnam</option>
                    <option value="Yemen">Yemen</option>
                </optgroup>
                <optgroup id="country-optgroup-Europe" label="Europe">
                    <option value="Albania">Albania</option>
                    <option value="Andorra">Andorra</option>
                    <option value="Austria">Austria</option>
                    <option value="Belarus">Belarus</option>
                    <option value="Belgium">Belgium</option>
                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                    <option value="Bulgaria">Bulgaria</option>
                    <option value="Croatia">Croatia</option>
                    <option value="Cyprus">Cyprus</option>
                    <option value="Czech Republic">Czech Republic</option>
                    <option value="Denmark">Denmark</option>
                    <option value="East Germany">East Germany</option>
                    <option value="Estonia">Estonia</option>
                    <option value="Faroe Islands">Faroe Islands</option>
                    <option value="Finland">Finland</option>
                    <option value="France">France</option>
                    <option value="Germany">Germany</option>
                    <option value="Gibraltar">Gibraltar</option>
                    <option value="Greece">Greece</option>
                    <option value="Guernsey">Guernsey</option>
                    <option value="Hungary">Hungary</option>
                    <option value="Iceland">Iceland</option>
                    <option value="Ireland">Ireland</option>
                    <option value="Isle of Man">Isle of Man</option>
                    <option value="Italy">Italy</option>
                    <option value="Jersey">Jersey</option>
                    <option value="Latvia">Latvia</option>
                    <option value="Liechtenstein">Liechtenstein</option>
                    <option value="Lithuania">Lithuania</option>
                    <option value="Luxembourg">Luxembourg</option>
                    <option value="Macedonia">Macedonia</option>
                    <option value="Malta">Malta</option>
                    <option value="Metropolitan France">Metropolitan France</option>
                    <option value="Moldova">Moldova</option>
                    <option value="Monaco">Monaco</option>
                    <option value="Montenegro">Montenegro</option>
                    <option value="Netherlands">Netherlands</option>
                    <option value="Norway">Norway</option>
                    <option value="Poland">Poland</option>
                    <option value="Portugal">Portugal</option>
                    <option value="Romania">Romania</option>
                    <option value="Russia">Russia</option>
                    <option value="San Marino">San Marino</option>
                    <option value="Serbia">Serbia</option>
                    <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                    <option value="Slovakia">Slovakia</option>
                    <option value="Slovenia">Slovenia</option>
                    <option value="Spain">Spain</option>
                    <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                    <option value="Sweden">Sweden</option>
                    <option value="Switzerland">Switzerland</option>
                    <option value="Ukraine">Ukraine</option>
                    <option value="Union of Soviet Socialist Republics">Union of Soviet Socialist Republics</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="Vatican City">Vatican City</option>
                    <option value="Åland Islands">Åland Islands</option>
                </optgroup>
                <optgroup id="country-optgroup-Oceania" label="Oceania">
                    <option value="American Samoa">American Samoa</option>
                    <option value="Antarctica">Antarctica</option>
                    <option value="Australia">Australia</option>
                    <option value="Bouvet Island">Bouvet Island</option>
                    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                    <option value="Christmas Island">Christmas Island</option>
                    <option value="Cocos [Keeling] Islands">Cocos [Keeling] Islands</option>
                    <option value="Cook Islands">Cook Islands</option>
                    <option value="Fiji">Fiji</option>
                    <option value="French Polynesia">French Polynesia</option>
                    <option value="French Southern Territories">French Southern Territories</option>
                    <option value="Guam">Guam</option>
                    <option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                    <option value="Kiribati">Kiribati</option>
                    <option value="Marshall Islands">Marshall Islands</option>
                    <option value="Micronesia">Micronesia</option>
                    <option value="Nauru">Nauru</option>
                    <option value="New Caledonia">New Caledonia</option>
                    <option value="New Zealand">New Zealand</option>
                    <option value="Niue">Niue</option>
                    <option value="Norfolk Island">Norfolk Island</option>
                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                    <option value="Palau">Palau</option>
                    <option value="Papua New Guinea">Papua New Guinea</option>
                    <option value="Pitcairn Islands">Pitcairn Islands</option>
                    <option value="Samoa">Samoa</option>
                    <option value="Solomon Islands">Solomon Islands</option>
                    <option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                    <option value="Tokelau">Tokelau</option>
                    <option value="Tonga">Tonga</option>
                    <option value="Tuvalu">Tuvalu</option>
                    <option value="U.S. Minor Outlying Islands">U.S. Minor Outlying Islands</option>
                    <option value="Vanuatu">Vanuatu</option>
                    <option value="Wallis and Futuna">Wallis and Futuna</option>
                </optgroup>
            </select>
        </div>

    <div class="form-group">
        <label for="institution" id="institution-label"><?php echo lang('GEN_INSTITUTION'); ?></label>

        <input  class="form-control" type="text" name="institution" id="institution"
                placeholder="<?php echo lang('GEN_INSTITUTION'); ?>" value="<?php if (!$form_valid && !empty($_POST)) {
                    echo $institution;
                } ?>"
                autocomplete="institution">
    </div>

        <div class="bsl-check-row">
            <input type="checkbox" name="agreement" id="agreement">
            <label for="agreement" id="agreement-label"><b><?php echo lang('GEN_AGREEMENT'); ?><span class="req-star">*</span></b></label>
        </div>

        <div class="bsl-check-row">
            <input type="checkbox" name="newsletter" id="newsletter">
            <label for="newsletter" id="newsletter-label"><?php echo lang('GEN_NEWSLETTER'); ?></label>
        </div>

      <div class="form-group">
        <?php
        $character_range = lang('GEN_MIN').' '.$settings->min_pw.' '.lang('GEN_AND').' '.$settings->max_pw.' '.lang('GEN_MAX').' '.lang('GEN_CHAR');
$character_statement = '<span id="character_range" class="gray_out_text">'.$character_range.' </span>';

if ($settings->req_cap == 1) {
    $num_caps = '1'; // Password must have at least 1 capital
    if ($num_caps != 1) {
        $num_caps_s = 's';
    }
    $num_caps_statement = '<span id="caps" class="gray_out_text">'.lang('JOIN_HAVE').$num_caps.lang('JOIN_CAP').'</span>';
}

if ($settings->req_num == 1) {
    $num_numbers = '1'; // Password must have at least 1 number
    if ($num_numbers != 1) {
        $num_numbers_s = 's';
    }

    $num_numbers_statement = '<span id="number" class="gray_out_text">'.lang('JOIN_HAVE').$num_numbers.' '.lang('GEN_NUMBER').'</span>';
}
$password_match_statement = '<span id="password_match" class="gray_out_text">'.lang('JOIN_TWICE').'</span>';
?>

        <div style="display: inline-block">
          <label for="password" id="password-label"><?php echo lang('GEN_PASS'); ?><span class="req-star">*</span></label>

          <input  class="form-control" type="password" name="password" id="password" placeholder="<?php echo lang('GEN_PASS'); ?>"
          required autocomplete="new-password" aria-describedby="passwordhelp">

          <label for="confirm" id="confirm-label"><?php echo lang('PW_CONF'); ?><span class="req-star">*</span></label>

          <input  type="password" id="confirm" name="confirm" class="form-control" placeholder="<?php echo lang('PW_CONF'); ?>"
          required autocomplete="new-password" >
        </div>

        <div style="display: inline-block; padding-left: 20px">
          <strong><?php echo lang('PW_SHOULD'); ?></strong><br>
          <span id="character_range_icon" class="fa fa-thumbs-o-up gray_out_icon" style="color: green"></span>&nbsp;&nbsp;<?php echo $character_statement; ?>

          <br>

          <?php
  if ($settings->req_cap == 1) { ?>
            <span id="num_caps_icon" class="fa fa-thumbs-o-up gray_out_icon" style="color: green"></span>&nbsp;&nbsp;<?php echo $num_caps_statement; ?>
            <br>
          <?php }

  if ($settings->req_num == 1) { ?>
            <span id="num_numbers_icon" class="fa fa-thumbs-o-up gray_out_icon" style="color: green"></span>&nbsp;&nbsp;<?php echo $num_numbers_statement; ?>
            <br>
          <?php } ?>

          <span id="password_match_icon" class="fa fa-thumbs-o-up gray_out_icon" style="color: green"></span>&nbsp;&nbsp;<?php echo $password_match_statement; ?>

          <br><br>

          <a class="nounderline" id="password_view_control"><span class="fa fa-eye"></span> <?php echo lang('PW_SHOWS'); ?></a>
        </div>
      </div>

      <?php
      includeHook($hooks, 'form');
include $abs_us_root.$us_url_root.'usersc/scripts/additional_join_form_fields.php';
?>

      <input type="hidden" value="<?php echo Token::generate(); ?>" name="csrf">

          <div class="form-group" style="margin-top: 20px;">
            <button class="submit btn btn-primary btn-lg w-100 btn-submit-bsl" type="submit" id="next_button">
              <i class="fa fa-plus-square"></i> <?php echo lang('SIGNUP_TEXT'); ?>
            </button>
          </div>

        </form>
      </div><!-- bsl-join-body -->
    </div><!-- bsl-join-card -->
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="termsModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"><?php echo lang('TERMS_MODAL_HEADER'); ?></h4>
                <button type="button" class="close" data-bs-dismiss="modal">X</button>
            </div>
            <div class="modal-body">
                <p><?php echo lang('TERMS_AND_CONTIDIONS_TEXT'); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>



<script type="text/javascript">
$(document).ready(function(){

  $( "#password" ).keyup(function() {
    var pswd = $("#password").val();

    //validate the length
    if ( pswd.length >= <?php echo $settings->min_pw; ?> && pswd.length <= <?php echo $settings->max_pw; ?> ) {
      $("#character_range_icon").removeClass("gray_out_icon");
      $("#character_range").removeClass("gray_out_text");
    } else {
      $("#character_range_icon").addClass("gray_out_icon");
      $("#character_range").addClass("gray_out_text");
    }

    //validate capital letter
    if ( pswd.match(/[A-Z]/) ) {
      $("#num_caps_icon").removeClass("gray_out_icon");
      $("#caps").removeClass("gray_out_text");
    } else {
      $("#num_caps_icon").addClass("gray_out_icon");
      $("#caps").addClass("gray_out_text");
    }

    //validate number
    if ( pswd.match(/\d/) ) {
      $("#num_numbers_icon").removeClass("gray_out_icon");
      $("#number").removeClass("gray_out_text");
    } else {
      $("#num_numbers_icon").addClass("gray_out_icon");
      $("#number").addClass("gray_out_text");
    }
  });

  $( "#confirm" ).keyup(function() {
    var pswd = $("#password").val();
    var confirm_pswd = $("#confirm").val();

    //validate password_match
    if (pswd == confirm_pswd) {
      $("#password_match_icon").removeClass("gray_out_icon");
      $("#password_match").removeClass("gray_out_text");
    } else {
      $("#password_match_icon").addClass("gray_out_icon");
      $("#password_match").addClass("gray_out_text");
    }

  });
});
</script>
