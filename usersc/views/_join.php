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
<style>
.gray_out_icon{
  -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
  filter: grayscale(100%);
}
.gray_out_text{
  opacity: .5;
}
</style>

<div class="row">
  <div class="col-sm-12">
    <?php
    if (!$form_valid && Input::exists()){?>
      <?php if(!$validation->errors()=='') { display_errors($validation->errors()); } ?>
    <?php }
    includeHook($hooks,'body');
    ?>

    <form class="form-signup" action="" method="<?=$form_method;?>" id="payment-form">

      <h2 class="form-signin-heading"> <?=lang("SIGNUP_TEXT","");?></h2>

      <div class="form-group">
        <label id="username-label"><?=lang("GEN_UNAME");?>*</label>
        <span id="usernameCheck" class="small"></span>

        <input type="text" class="form-control" id="username" name="username" placeholder="<?=lang("GEN_UNAME");?>"
        value="<?php if (!$form_valid && !empty($_POST)){ echo $username;} ?>"
        required autofocus autocomplete="username">
      </div>

      <div class="form-group">
        <label for="fname" id="fname-label"><?=lang("GEN_FNAME");?>*</label>

        <input type="text" class="form-control" id="fname" name="fname" placeholder="<?=lang("GEN_FNAME");?>" value="<?php if (!$form_valid && !empty($_POST)){ echo $fname;} ?>"
        required autofocus autocomplete="first-name">
      </div>

      <div class="form-group">
        <label for="lname" id="lname-label"><?=lang("GEN_LNAME");?>*</label>

        <input type="text" class="form-control" id="lname" name="lname" placeholder="<?=lang("GEN_LNAME");?>"
               value="<?php if (!$form_valid && !empty($_POST)){ echo $lname;} ?>"
        required autocomplete="family-name">
      </div>

      <div class="form-group">
        <label for="email" id="email-label"><?=lang("GEN_EMAIL");?>*</label>

        <input  class="form-control" type="text" name="email" id="email" placeholder="<?=lang("GEN_EMAIL");?>"
                value="<?php if (!$form_valid && !empty($_POST)){ echo $email;} ?>"
        required autocomplete="email">
      </div>

        <div class="form-group">
            <label for="country" id="country-label"><?=lang("GEN_COUNTRY");?>*</label>

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
        <label for="institution" id="institution-label"><?=lang("GEN_INSTITUTION");?></label>

        <input  class="form-control" type="text" name="institution" id="institution"
                placeholder="<?=lang("GEN_INSTITUTION");?>" value="<?php if (!$form_valid && !empty($_POST)){ echo $institution;} ?>"
                autocomplete="institution">
    </div>

        <div class="form-group">
            <label for="skills" id="skills-label"><?=lang("GEN_SKILLS");?></label>

            <input  class="form-control" type="text" name="skills" id="skills"
                    placeholder="<?=lang("GEN_SKILLS");?>" value="<?php if (!$form_valid && !empty($_POST)){ echo $skills;} ?>"
                    autocomplete="skills">
        </div>

        <div class="form-group">
            <label for="newsletter" id="newsletter-label"><?=lang("GEN_NEWSLETTER");?></label>
            <input type="checkbox" name="newsletter" id="newsletter">
        </div>

        <div class="form-group">
            <label for="agreement" id="agreement-label"><b><?=lang("GEN_AGREEMENT");?>*</b></label>
            <input type="checkbox" name="agreement" id="agreement">
        </div>

      <div class="form-group">
        <?php
        $character_range = lang("GEN_MIN")." ".$settings->min_pw . " ". lang("GEN_AND") ." ". $settings->max_pw . " " .lang("GEN_MAX")." ".lang("GEN_CHAR");
        $character_statement = '<span id="character_range" class="gray_out_text">' . $character_range . ' </span>';

        if ($settings->req_cap == 1){
          $num_caps = '1'; //Password must have at least 1 capital
          if($num_caps != 1){
            $num_caps_s = 's';
          }
          $num_caps_statement = '<span id="caps" class="gray_out_text">'.lang("JOIN_HAVE") . $num_caps . lang("JOIN_CAP") .'</span>';
        }

        if ($settings->req_num == 1){
          $num_numbers = '1'; //Password must have at least 1 number
          if($num_numbers != 1){
            $num_numbers_s = 's';
          }

          $num_numbers_statement = '<span id="number" class="gray_out_text">'.lang("JOIN_HAVE") . $num_numbers . " " . lang("GEN_NUMBER") .'</span>';
        }
        $password_match_statement = '<span id="password_match" class="gray_out_text">'.lang("JOIN_TWICE").'</span>';
        ?>

        <div style="display: inline-block">
          <label for="password" id="password-label"><?=lang("GEN_PASS");?>* (<?=lang("GEN_MIN");?> <?=$settings->min_pw?> <?=lang("GEN_AND");?> <?=lang("GEN_MAX");?> <?=$settings->max_pw?> <?=lang("GEN_CHAR");?>)</label>

          <input  class="form-control" type="password" name="password" id="password" placeholder="<?=lang("GEN_PASS");?>"
          required autocomplete="new-password" aria-describedby="passwordhelp">

          <label for="confirm" id="confirm-label"><?=lang("PW_CONF");?>*</label>

          <input  type="password" id="confirm" name="confirm" class="form-control" placeholder="<?=lang("PW_CONF");?>"
          required autocomplete="new-password" >
        </div>

        <div style="display: inline-block; padding-left: 20px">
          <strong><?=lang("PW_SHOULD");?></strong><br>
          <span id="character_range_icon" class="fa fa-thumbs-o-up gray_out_icon" style="color: green"></span>&nbsp;&nbsp;<?php echo $character_statement;?>

          <br>

          <?php
          if ($settings->req_cap == 1){ ?>
            <span id="num_caps_icon" class="fa fa-thumbs-o-up gray_out_icon" style="color: green"></span>&nbsp;&nbsp;<?php echo $num_caps_statement;?>
            <br>
          <?php }

          if ($settings->req_num == 1){ ?>
            <span id="num_numbers_icon" class="fa fa-thumbs-o-up gray_out_icon" style="color: green"></span>&nbsp;&nbsp;<?php echo $num_numbers_statement;?>
            <br>
          <?php } ?>

          <span id="password_match_icon" class="fa fa-thumbs-o-up gray_out_icon" style="color: green"></span>&nbsp;&nbsp;<?php echo $password_match_statement;?>

          <br><br>

          <a class="nounderline" id="password_view_control"><span class="fa fa-eye"></span> <?=lang("PW_SHOWS");?></a>
        </div>
      </div>

      <?php
      includeHook($hooks,'form');
      include($abs_us_root.$us_url_root.'usersc/scripts/additional_join_form_fields.php');
      ?>

      <input type="hidden" value="<?=Token::generate();?>" name="csrf">

      <div class="form-group">
        <button class="submit btn btn-primary " type="submit" id="next_button"><i class="fa fa-plus-square"></i> <?=lang("SIGNUP_TEXT");?></button>
      </div>

    </form>
    <br>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="termsModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"><?=lang("TERMS_MODAL_HEADER");?></h4>
                <button type="button" class="close" data-bs-dismiss="modal">X</button>
            </div>
            <div class="modal-body">
                <p><?=lang("TERMS_AND_CONTIDIONS_TEXT"); ?></p>
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
    if ( pswd.length >= <?=$settings->min_pw?> && pswd.length <= <?=$settings->max_pw?> ) {
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
