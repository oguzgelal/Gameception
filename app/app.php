<?php
include_once dirname(__FILE__) . '/config.php';

$ping = "pong";

if ( isset( $_GET[ 'a' ] ) ) { $actionA = $_GET[ 'a' ]; } else { $actionA = "main"; }
if ( isset( $_GET[ 'b' ] ) ) { $actionB = $_GET[ 'b' ]; }
if ( isset( $_GET[ 'c' ] ) ) { $actionC = $_GET[ 'c' ]; }

// language
$_SESSION['lang']="tr";

if ( $actionA == "ajax" ) {

	$subActionsAjax = array(
		"public" => array(
			"login",
			"logout",
			"playbet",
			"getmoney",
			"generatecoupon",
			"savecouponsession",
			"unsetcouponsession",
			"getcouponsession",
			"getmatchdata",
			"getgamername",
			"getgameabbr",
			"getquestion",
			"getanswer",
			"getanswerrate",
			"getnotifdata",
			"getmatchidfromquestion",
			"profileimage",
			"changebio",
			"saveimage",
			"dismissnotifchecker",
			"register"
			),
		"admin" => array(
			"deletematch",
			"addmatch",
			"addanswer",
			"addbet",
			"deletespecial",
			"deleteanswer",
			"updateteam",
			"newRegCode",
			"sendRegCode",
			"unsendRegCode",
			"blockRegCode",
			"unblockRegCode",
			"changemainitem"
			)
		);

	if ( array_key_exists( $actionB, $subActionsAjax ) ) {
		if ($actionB == "admin" && !isAdminLoggedIn()){
			echo getMessage("E2");
			exit();
		}
		if ( isset( $actionC ) && in_array( $actionC, $subActionsAjax[ $actionB ] ) ) {
			$file = AJAX . "/{$actionB}/{$actionC}.php";
			if (is_file( $file )){
				include_once $file;
				exit();
			} else{ echo getMessage("E2"); exit(); }
		} else{ echo getMessage("E2"); exit(); }
	} else { echo getMessage("E2"); exit(); }

	exit();
}

// RUN COUPON CHECK
if ( !isset($_SESSION['lastcouponupdate']) ){
	error_log("refresh... ".time());
	// run only 1 time
	cookieLogin();
	// run at the beginning
	refreshExecution();
	monthlyExecution();
	dailyExecution();
	$_SESSION['lastcouponupdate'] = time();
}
else{
	if (time() - $_SESSION['lastcouponupdate'] > COUPON_INTERVAL){
		error_log("refresh... ".time());
		// run every 5 mins
		refreshExecution();
		monthlyExecution();
		dailyExecution();
		$_SESSION['lastcouponupdate'] = time();
	}
}

// RUN LONGTIME CHECKS
if ( !isset($_SESSION['lastlongtimeupdate']) ){
	error_log("longtime... ".time());
	monthlyExecution();
	dailyExecution();
	$_SESSION['lastlongtimeupdate'] = time();
}
else{
	if (time() - $_SESSION['lastlongtimeupdate'] > LONGTIME_INTERVAL){
		error_log("longtime... ".time());
		monthlyExecution();
		dailyExecution();
		$_SESSION['lastlongtimeupdate'] = time();
	}
}




// Admin Panel
if ( $actionA == "administration" ) {

	$subActionsAdmin = array(
		"main",
		"maclar",
		"macekle",
		"oyunlar",
		"oyunekle",
		"takimlar",
		"stats",
		"specialbetekle",
		"specialbets"
		);

	if ( !isAdminLoggedIn() ) {
		include_once ACTIONS . "/public/main.php";
		exit();
	}
	if ( !isset( $actionB ) ) {
		include_once ACTIONS . "/admin/main.php";
		exit();
	}
	if ( in_array( $actionB, $subActionsAdmin ) ) {
		$file = ACTIONS . "/admin/{$actionB}.php";
		include_once is_file( $file ) ? $file : ACTIONS . "/admin/main.php";
		exit();
	}
	else {
		echo "**";
		include_once ACTIONS . "/admin/main.php";
		exit();
	}

	exit();
}

// Public Site
$actionsPublic = array(
	"main",
	"profile",
	"siralama",
	"bahis",
	"stream",
	"try",
	"register",
	"kupon"
	);
if ( in_array( $actionA, $actionsPublic ) ) {
	include_once ACTIONS . "/public/{$actionA}.php";
	exit();
} 
else {
	include_once ACTIONS . "/public/main.php";
	exit();
}



?>