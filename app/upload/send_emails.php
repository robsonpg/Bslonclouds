<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once '../../users/init.php';

if (!$user->isLoggedIn()) {
    echo "<br><br><label style=\"color:floralwhite; font: bold 16px arial, serif\">Você não está logado no site!</label>";
    exit;
}

require_once "../database_layer.php";
require_once "../constants.php";

//sendModeratorsEmail("Maize_123", 4);
//echo "Emails enviados";
//exit;


function sendModeratorsEmail($research_uid, $owner_id)
{
    $str_to_send = "";

    try {
        $owner_data = getResearchOwnerData($owner_id);
        $moderators = getModeratorsUsers();

        $str_name = $owner_data->fname . " " . $owner_data->lname;
        $str_email = $owner_data->email;
        //$str_msg = nl2br($_GET['contact_message']);

        $str_msg = lang("RECEIVE_NAME") . ": " . $str_name . "<br>" .
            lang("GEN_EMAIL") . ": " . $str_email . "<br>";
        $str_msg = $str_msg . lang("RECEIVE_RESEARCH_TO_APPROVE") . "<br>" .
            lang("RESEARCH_ID") . ": " . $research_uid . "<br><br>" . lang("BSL_SIGNATURE");

        if (($owner_data != null) && ($moderators != null)) {
            foreach ($moderators as $moderator) {
                email($moderator->email, lang("RECEIVED_RESEARCH"), $str_msg);
            }
            // Email to user
            $str_msg = lang("TKS_MSG_1") . $str_name . lang("TKS_MSG_2") . " \"" . $research_uid . "\"" .
                lang("TKS_MSG_3");
            email($str_email, lang("SUBJECT_RECEIVE_RESEARCH"), $str_msg);
            //$str_to_save = "Nome: " . $str_name . "#Mail: " . $str_email . "\r\n";
        } else {
            echo "Faltou algo";
        }

    } catch (Exception $e) {
        // Aconteceu erro

    } finally {

    }
}

?>

