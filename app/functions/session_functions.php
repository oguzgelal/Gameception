<?php
function login($username, $password, $rememberme){
	$pdo = newPDO();
	$username = sanitize_string($username);
	$password = sha1(sanitize_string($password));
	$query = $pdo->prepare("SELECT id FROM ".TABLE_PROFILE." WHERE nick=:nick AND pass=:pass LIMIT 1");
	$query->execute(array(':nick'=>$username, ':pass'=>$password));
	$result = $query->fetch(PDO::FETCH_ASSOC);
	if (count($result['id']) == 1){ 
		startSession($result['id']);
		if ($rememberme == "true"){ sendCookie($result['id']); }
		loginExecution();
		return "S1";
	}
	else{ return "E1"; }
}
function logout(){
	$userid_logout = $_SESSION['userid'];
	$_SESSION['logged_in'] = 0;
	$_SESSION['userid'] = 0;
	unset($_SESSION['logged_in']);
	unset($_SESSION['userid']);
	session_destroy();
	deleteCookie($userid_logout);
	if (!isLoggedIn()){ return "S3"; }
	else { return "E3";	}
}
function sendCookie($userid_sc){
	setcookie("rememberme", $userid_sc, time()+COOKIE_EXPIRE);
}
function deleteCookie($userid_dc){
	unset($_COOKIE['rememberme']);
	setcookie("rememberme", $userid_dc, time()-COOKIE_EXPIRE);
}
function cookieLogin(){
	if (!isLoggedIn()){
		if (isset($_COOKIE['rememberme'])){
			$userid_cl = $_COOKIE['rememberme'];
			startSession($userid_cl);
			loginExecution();
		}
	}
}
function startSession($id){
	$_SESSION['logged_in'] = 1;
	$_SESSION['userid'] = $id;
}
function isLoggedIn(){ 
	return isset($_SESSION['logged_in']) && isset($_SESSION['userid']) && $_SESSION['userid']!="" && $_SESSION['logged_in']==1;
}
function isAdminLoggedIn(){ 
	if (isLoggedIn()){
		$loggedid = $_SESSION['userid'];
		$pdo = newPDO();
		$query = $pdo->prepare("SELECT type FROM ".TABLE_PROFILE." WHERE id=:id LIMIT 1");
		$query->execute(array(':id'=>$loggedid));
		$result = $query->fetch(PDO::FETCH_ASSOC);
		return ($result['type'] == ADMIN);
	}
	else{ return false;	}
}

?>