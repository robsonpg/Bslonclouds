<?php
if(file_exists("install/index.php")){
	//perform redirect if installer files exist
	//this if{} block may be deleted once installed
	header("Location: install/index.php");
}

require_once 'users/init.php';
require_once 'app/business_layer.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if(isset($user) && $user->isLoggedIn()){
}

// ######################################################
// Salva o país de origem da visita no log do sistema
saveVisitorInfo();
if($user->isLoggedIn()){
    require_once 'landing_home.php';
} else {
    require_once 'landing_home.php';
}?>

<footer>
<div>
    <hr>
<?php  languageSwitcher();?>
</div>
</footer>

<!-- Place any per-page javascript here -->
<?php require_once $abs_us_root . $us_url_root . 'users/includes/html_footer.php'; ?>
