<?php

// trim long texts
function trimchars($str, $int){
	if (strlen($str) > $int){ 
		$str = substr($str, 0, ($int-3))."..."; 
	}
	return $str;
}

// create and return PDO object
function newPDO(){
	try { $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8",DB_USER,DB_PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")); } 
	catch (PDOException $e) { echo getMessage("E0"); }
	return $pdo;
}

function generateRandomString($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}

// add notification to user
function addNotif($userid_addnotif, $notifbody){
	$pdo = newPDO();
	$query = $pdo->prepare("INSERT INTO ".DISMISSNOTIF." VALUES (:id, :profile_id, :body)");
	$query->execute(array(':id'=>'',':profile_id'=>sanitize_string($userid_addnotif),':body'=>sanitize_string($notifbody)));
}

/* !! ONLY FOR DEBUG !! */ 
function resetChecked(){

	$pdo = newPDO();

	$query = $pdo->prepare("UPDATE ".TABLE_KUPON." SET checked = '0'");
	$query->execute();

	$query = $pdo->prepare("UPDATE ".TABLE_KUPON_MATCHES." SET checked = '0'");
	$query->execute();

	$query = $pdo->prepare("UPDATE ".TABLE_KUPON_QUESTIONS." SET checked = '0'");
	$query->execute();

	$query = $pdo->prepare("UPDATE ".TABLE_PROFILE." SET matches_won = '0', matches_lost = '0', questions_won = '0', questions_lost = '0', kupon_won = '0', kupon_lost = '0', xp = '0', level = '1'");
	$query->execute();

}

?>