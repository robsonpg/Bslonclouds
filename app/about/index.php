<?php

/**
 * Created by PhpStorm.
 * User: Robson
 * Date: 15/02/2018
 * Time: 19:52
 */

require_once '../../users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';

if (!$user->isLoggedIn()) {
    echo "<br><br><label style=\"color:floralwhite; font: bold 16px arial, serif\">Você não está logado no site!</label>";
    exit;
}

$user_id = $user->data()->id;
require_once "about_modal.php";

?>

<script>
    //##############################################################################
    // Scripts para depois que o form for carregado
    //##############################################################################
    $(document).ready(function() {
        // Exibe o modal
        $('#about-modal').modal('show');
    })
</script>



<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; ?>

