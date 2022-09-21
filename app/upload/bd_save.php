<?php

require_once "../functions.php";
require_once "../../users/init.php";

//$image_name = "img/temp.image.jpg";
//unlink($image_name);


$contract_id = $_POST['cid'];

//$fp = fopen('lidn.txt', 'w');
//fwrite($fp, $contract_id);
//fclose($fp);

insert_image($contract_id, $user->data()->id);