<?php require_once($abs_us_root.$us_url_root.'users/includes/template/header1_must_include.php'); ?>

<!-- Bootstrap 3 Glyphicons for Compatibility Reasons -->
<?php require_once($abs_us_root.$us_url_root.'usersc/templates/'.$settings->template.'/assets/fonts/glyphicons.php'); ?>

<!-- Table Sorting and Such -->
<link href="<?=$us_url_root?>users/css/datatables.css" rel="stylesheet">

<!-- Custom Fonts/Animation/Styling-->
<link rel="stylesheet" href="<?=$us_url_root?>users/fonts/css/font-awesome.min.css">

<?php
require_once($abs_us_root.$us_url_root.'users/includes/template/header2_style.php');
require_once($abs_us_root.$us_url_root.'users/includes/template/header3_must_include.php');
}

if(isset($_GET['msg'])){
$msg=Input::get('msg');
    bold($msg);
}
 ?>
