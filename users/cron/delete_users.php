<?php
require_once '../init.php';
$filename = currentPage();
$db = DB::getInstance();
$ip = ipCheck();
logger("","CronRequest","Cron request from $ip.");
$settings = $db->query("SELECT * FROM settings")->first();
if($settings->cron_ip != ''){
if($ip != $settings->cron_ip && $ip != '127.0.0.1'){
	logger("","CronRequest","Cron request DENIED from $ip.");
	die;
	}
}
$errors = $successes = [];

//your code goes here...
// Apagar usuários que não se autenticaram
$users = $db->query("DELETE FROM users WHERE email_verified = 0");
//your code ends here.

$from = Input::get('from');
if($from != NULL && $currentPage == $filename) {
	$query = $db->query("SELECT id,name FROM crons WHERE file = ?",array($filename));
	$results = $query->first();
		$cronfields = array(
		'cron_id' => $results->id,
		'datetime' => date("Y-m-d H:i:s"),
		'user_id' => $user_id);
		$db->insert('crons_logs',$cronfields);
	Redirect::to('/'. $from);
}
?>
